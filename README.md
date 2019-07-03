#MultiProccessingCurlRequests
```
composer require elminson/multiproccessingcurlrequests
```
Proccessing Multiple cURL requests in PHP faster


```php
namespace Elminson\MultiProccessingCurlRequests;

require __DIR__ . '/../vendor/autoload.php';

$data = [
          ['url' => 'https://jsonplaceholder.typicode.com/todos/1'],
          ['url' => 'https://jsonplaceholder.typicode.com/users']
        ];
        $call = new MultiProccessingCurlRequests();
        $call->setIsJson(true);
        $r = $call->multiRequest($data);
        var_dump($r);

```
