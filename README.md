# headerparser
Parses content of $http_response_header for easy access

Example:

```php
$parser = new \HeaderParser\Parser($http_response_header);

$size = $parser->getHeaderValue('content-length');
$type = $parser->getHeaderValue('content-type');
```
