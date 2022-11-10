Installation
```shell script
composer require php-dto/uri
```

Usage
```php
<?php

$uri = new \PhpDto\Uri\Uri('https://foo@test.example.com:42?query#');

echo $uri->get(); //will print https://foo@test.example.com:42?query#
echo (string) $uri; //will print https://foo@test.example.com:42?query#

print_r($uri->getComponents());
//will print
array(
  'scheme' => 'https',           // the URI scheme component
  'user' => 'foo',              // the URI user component
  'pass' => null,               // the URI pass component
  'host' => 'test.example.com', // the URI host component
  'port' => 42,                 // the URI port component
  'path' => '',                 // the URI path component
  'query' => 'query',           // the URI query component
  'fragment' => '',             // the URI fragment component
);

new \PhpDto\Uri\Uri('http://test.com', ['https',]); //will throw \PhpDto\Uri\Exception\UriException (allows only `https` scheme)
```