<?php
namespace Tanvir\Sabre\Rest;

class Call {
    
    private $config;
    
    public function __construct() {
        $this->config = config('sabre')[config('sabre.env')];
    }
    
    public function executeGetCall($path, $request) {
        $result = curl_exec($this->prepareCall('GET', $path, $request));
        return json_decode($result);
    }
    
    public function executePostCall($path, $request) {
        // print($path);
        // print($request);
        $result = curl_exec($this->prepareCall('POST', $path, $request));
        return json_decode($result);
    }
    
    private function buildHeaders() {
        $headers = array(
            'Authorization: Bearer '.Token::getToken()->access_token,
            // 'Authorization: Bearer '.'T1RLAQJ+drM7lsPxai7p2/DI9Qcms+rtOBAUwVWDej8NL7Pw+uzkW7AEAADAEi6jC1K5yE0G/nn7qZa8OSud7JsIcBjKoSsXC+nWSJxpmkA8y+E6OuVOgqpHUnOg6vZ+bdAVm+i8gsCfwp424JqIoF79JfJLzHE4Ihej4alwMirOjvgO0JWEbJnVZfPqqLwll1EZZ+RudLSsa2P6mddtZZw0pJc8oQ2POqAjE/YypnioeGaunMaXSnjAOJybDercGQTAkrNuCp7NY6/q5ba3zJ46ThMtAXgP+bj2vVKUqzMlQUHI/TZ5jP24LIIW',
            'Accept: */*'
        );
        return $headers;
    }
    
    private function prepareCall($callType, $path, $request) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $callType);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = $this->buildHeaders();
        switch ($callType) {
        case 'GET':
            $url = $path;
            if ($request != null) {
                $url = $this->config['rest'].$path.'?'.http_build_query($request);
            }
            curl_setopt($ch, CURLOPT_URL, $url);
            break;
        case 'POST':
            curl_setopt($ch, CURLOPT_URL, $this->config['rest'].$path);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
            array_push($headers, 'Content-Type: application/json');
            break;
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        return $ch;
    }
}