<?php

namespace Elminson\MultiProccessingCurlRequests;

require __DIR__ . '/vendor/autoload.php';

$data = [
	['url' => 'https://www.google.com']
];
$call = new MultiProccessingCurlRequests();
$call->setIsPost(false);
$r = $call->multiRequest($data);
$result = strip_tags($r[0]);
print_r($result);