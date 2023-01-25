# MultiProccessingCurlRequests
```
composer require elminson/multiproccessingcurlrequests
```
### Proccessing Multiple cURL requests in PHP faster


```php
<?php
namespace Elminson\MultiProccessingCurlRequests;

require __DIR__ . '/vendor/autoload.php';

        $data = [
          ['url' => 'https://jsonplaceholder.typicode.com/todos/1'],
          ['url' => 'https://jsonplaceholder.typicode.com/users']
        ];
        $call = new MultiProccessingCurlRequests();
        $call->setIsJson(true);
        $r = $call->multiRequest($data);
        var_dump($r);

```

### Send Request in json format

```php
<?php
namespace Elminson\MultiProccessingCurlRequests;

require __DIR__ . '/vendor/autoload.php';

    	$payloadArray = array("name" => "John", "phone" => "555-555-5555");
        $data = [
          ['url' => 'https://jsonplaceholder.typicode.com/todos/1', 'payload' => json_encode($payloadArray)],
          ['url' => 'https://jsonplaceholder.typicode.com/users', 'payload' => json_encode($payloadArray)]
        ];
        $call = new MultiProccessingCurlRequests();
        $call->setIsJson(true);
        $r = $call->multiRequest($data);
        var_dump($r);

```

### Send Request in json and post format

```php
<?php

namespace Elminson\MultiProccessingCurlRequests;

require __DIR__ . '/vendor/autoload.php';
        $payloadArray = array("name" => "John", "phone" => "555-555-5555");
		$data = [
			['url' => 'https://jsonplaceholder.typicode.com/todos/1', 'payload' => json_encode($payloadArray)],
			['url' => 'https://jsonplaceholder.typicode.com/users', 'payload' => json_encode($payloadArray)],
			['url' => 'https://jsonplaceholder.typicode.com/todos/1', 'post' => $payloadArray],
			['url' => 'https://jsonplaceholder.typicode.com/users', 'post' => $payloadArray]
		];
		$call = new MultiProccessingCurlRequests();
		$call->setIsJson(true);
		$r = $call->multiRequest($data);
		var_dump($r);
```

### Send Request in json and post format with custom headers

```php
<?php

namespace Elminson\MultiProccessingCurlRequests;

require __DIR__ . '/vendor/autoload.php';
        $payloadArray = array("name" => "John", "phone" => "555-555-5555");
        $headersMulticall = [
            'Content-Type: application/json',
            'Authorization: Basic username:password' // some basic auth need to be base64 encoded
        ];
		$data = [
			['url' => 'https://jsonplaceholder.typicode.com/todos/1', 'payload' => json_encode($payloadArray)],
			['url' => 'https://jsonplaceholder.typicode.com/users', 'payload' => json_encode($payloadArray)],
			['url' => 'https://jsonplaceholder.typicode.com/todos/1', 'post' => $payloadArray],
			['url' => 'https://jsonplaceholder.typicode.com/users', 'post' => $payloadArray]
		];
		$call = new MultiProccessingCurlRequests();
		$call->setHeaders($headersMulticall);
		$call->setIsJson(true);
		$call->setIsPost(true);
		$r = $call->multiRequest($data);
		var_dump($r);


```

### Send Request in json and put format with custom headers

```php
<?php

namespace Elminson\MultiProccessingCurlRequests;

require __DIR__ . '/vendor/autoload.php';
        $payloadArray = array("name" => "John", "phone" => "555-555-5555");
        $headersMulticall = [
            'Content-Type: application/json',
            'Authorization: Basic username:password' // some basic auth need to be base64 encoded
        ];
		$data = [
			['url' => 'https://jsonplaceholder.typicode.com/todos/1', 'payload' => json_encode($payloadArray)],
			['url' => 'https://jsonplaceholder.typicode.com/users', 'payload' => json_encode($payloadArray)],
			['url' => 'https://jsonplaceholder.typicode.com/todos/1', 'post' => $payloadArray],
			['url' => 'https://jsonplaceholder.typicode.com/users', 'post' => $payloadArray]
		];
		$call = new MultiProccessingCurlRequests();
		$call->setHeaders($headersMulticall);
		$call->setIsJson(true);
		$call->setIsPut(true);
		$r = $call->multiRequest($data);
		var_dump($r);


```