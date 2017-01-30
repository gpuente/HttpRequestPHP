# HttpRequestPHP
This is a simple class written in php that bring you an easy way make to http request to an API (or any http service) and handle the response.

This class contents an static function that allow send a request to a server and handle the response as a php array.

### How to use:
* import the class in your php file.
* set a variable with the url that you need send the request.
* set a variable with the method (HTTP verb) that you need use (Optional).
* set an array "key-value" with the parameters that you need send in the request (Optional).
* set a variable with the maximum time in seconds that you allow the libcurl transfer operation (Optional).
* call to class and the method with the parameters defined.
* catch the response in a variable.

```php
  $url = 'http://www.example.com/api/getsomedata';
  $method = 'GET'; //you can use: POST, GET, PUT, DELETE
  $data['param_1'] = 'example64@email.com';
  $data['param_2'] = 'apple';
  $data['param_3'] = '123456';
  //...... you can define as many params as you need.
  
  $response = HttpRequest::sendRequest($method, $url, $data);
  
  var_dump($response);
```

*if you need help, you can contact me by email: guillermo.ps09@gmail.com*
