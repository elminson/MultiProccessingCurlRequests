<?php
/**
 * Created by PHPProjectGen.
 * User: edeoleo@gmail.com
 * Date: 10/09/2018
 * Time: 11:39 PM
 */

namespace Elminson\MultiProccessingCurlRequests;

/**
 *
 *
 */
class MultiProccessingCurlRequests
{
    private $isJson = false;

    private $isDebug = false;

    /**
     * PHPProjectGen constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param $data
     * @param array $options
     * @return array
     */
    function multiRequest($data, $options = array())
    {

        // array of curl handles
        $curly = array();
        // data to be returned
        $result = array();

        // multi handle
        $mh = curl_multi_init();

        // loop through $data and create curl handles
        // then add them to the multi-handle
        foreach ($data as $id => $d) {
            $curly[$id] = curl_init();

            $url = (is_array($d) && !empty($d['url'])) ? $d['url'] : $d;
            curl_setopt($curly[$id], CURLOPT_URL, $url);
            curl_setopt($curly[$id], CURLOPT_HEADER, 0);
            curl_setopt($curly[$id], CURLOPT_RETURNTRANSFER, 1);
            if ($this->isDebug) {
                curl_setopt($curly[$id], CURLOPT_VERBOSE, true);
            }

            // post?
            if (is_array($d)) {
                if (!empty($d['post'])) {
                    curl_setopt($curly[$id], CURLOPT_POST, 1);
                    curl_setopt($curly[$id], CURLOPT_POSTFIELDS, $d['post']);
                }
            }

			// json?
			 else if (!empty($d['payload'])) {
				//attach encoded JSON string to the POST fields
				curl_setopt($curly[$id], CURLOPT_POSTFIELDS, $d['payload']);
				//set the content type to application/json
				curl_setopt($curly[$id], CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

			}

            // extra options?
            if (!empty($options)) {
                curl_setopt_array($curly[$id], $options);
            }

            curl_multi_add_handle($mh, $curly[$id]);
        }

        // execute the handles
        $running = null;
        do {
            curl_multi_exec($mh, $running);
        } while ($running > 0);

        // get content and remove handles
        foreach ($curly as $id => $c) {
            if ($this->isJson) {
                json_decode(curl_multi_getcontent($c));
                if (json_last_error() === JSON_ERROR_NONE) {
                    $result[$id] = json_decode(curl_multi_getcontent($c), true);
                } else {
                    $result[$id] = curl_multi_getcontent($c);
                }
            } else {
                $result[$id] = curl_multi_getcontent($c);
            }
            curl_multi_remove_handle($mh, $c);
        }
        // all done
        curl_multi_close($mh);

        return $result;
    }

    /**
     * @param bool $isJson
     */
    public function setIsJson($isJson)
    {
        $this->isJson = $isJson;
    }

    /**
     * @return bool
     */
    public function isJson()
    {
        return $this->isJson;
    }

    /**
     * @return bool
     */
    public function isDebug()
    {
        return $this->isDebug;
    }

    /**
     * @param bool $isDebug
     */
    public function setIsDebug($isDebug)
    {
        $this->isDebug = $isDebug;
    }


}
