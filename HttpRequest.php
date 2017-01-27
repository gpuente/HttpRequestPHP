<?php
 //namespace App\Library; Se puede habilitar un namespace si es necesario

  class HttpRequest {

    /**
     * Ejecuta un request a la url especificada, retornando un array asociativo con la respuesta.
     *
     * @author                Guillermo Puente
     *
     * @param  string $method [GET; POST; PUT; DELETE] método utilizado para enviar la solicitud a la URL.
     * @param  string $url    ruta adicional de la application
     * @param  array  $data   array con los parametros necesarios para enviar al servidor
     * @return array          array con la respuesta del servidor
     */
    public static function sendRequest($method = "GET", $url = "", $data = array(), $timeout = 30){
      /*
        Se configura la dirección url de la API
      */
      $api_request_url = $url;

      /*
        Se configura el verbo html a utilizar
      */
      $method_name = $method;

      /*
        Se configuran los parametros que se desean enviar en la solicitud
      */
      $api_request_parameters = $data;

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);

      if ($method_name == 'DELETE')
      {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($api_request_parameters));
      }

      if ($method_name == 'GET')
      {
        $api_request_url .= '?' . http_build_query($api_request_parameters);
      }

      if ($method_name == 'POST')
      {
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($api_request_parameters));
      }

      if ($method_name == 'PUT')
      {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($api_request_parameters));
      }

      /*
        Se configura el contenido de la respuesta, se puede modificar por:
        application/json, application/xml, text/html, text/plain, etc
      */
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));


      curl_setopt($ch, CURLOPT_URL, $api_request_url);


      curl_setopt($ch, CURLOPT_HEADER, TRUE);


      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

      /*
        Se obtiene la respuesta
      */
      $api_response = curl_exec($ch);


      /*
        se obtiene información de la respuesta
      */
      $api_response_info = curl_getinfo($ch);



      /*
        Se separa la información Header y Body de la respuesta
      */
      $api_response_header = trim(substr($api_response, 0, $api_response_info['header_size']));
      $api_response_body = substr($api_response, $api_response_info['header_size']);

      /*
        Se convierte respuesta a Array y se retorna
      */
      $response['header'] = json_decode($api_response_header, true);
      $response['body'] = json_decode($api_response_body, true);
      return $response;
    }

  }
?>
