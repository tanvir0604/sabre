<?php
namespace Tanvir\Sabre\Rest;
class Auth{

    public function __construct() {
        $this->config = config('sabre')[config('sabre.env')];
        $this->url = $this->config['rest'].'/v2/auth/token';
        // $this->url = 'https://api.havail.sabre.com/v2/auth/token';
        // dd($this->url);
    }

    public function callForToken() {
        $ch = curl_init($this->url);
        $vars = "grant_type=client_credentials";
        $headers = array(
            'Authorization: Basic '.$this->buildCredentials(),
            'Accept: */*',
            'Content-Type: application/x-www-form-urlencoded',
            'grant_type=client_credentials'
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        // dd($result);
        return json_decode($result);
    }
    
    private function buildCredentials() {
        $credentials = $this->config["formatVersion"].":".
                $this->config["userId"].":".
                $this->config["group"].":".
                $this->config["domain"];

        $b64Credentials = base64_encode($credentials);        
        $secret = $this->config["clientSecret"];
        $b64Secret = base64_encode($secret);
        $token = $b64Credentials.":".$b64Secret;
        $b64Token = base64_encode($token);
        // dd($credentials, $b64Credentials, $secret, $b64Secret, $token, $b64Token);
        return $b64Token;
    }

}