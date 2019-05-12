<?php
namespace Tanvir\Sabre\Rest;
class Auth{

    public function __construct() {
        $this->config = config('sabre')[config('sabre.env')];
        $this->url = $this->config['rest'].'/v2/auth/token';
        $this->clientId = "V1:ctyk3ou66mgrtghg:DEVCENTER:EXT";
        $this->password = "Hs26JuSi";
    }

    public function callForToken() {
        $ch = curl_init($this->url);
        $vars = "grant_type=client_credentials";
        $headers = array(
            'Authorization: Basic '.$this->buildCredentials(),
            'Accept: */*',
            'Content-Type: application/x-www-form-urlencoded'
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result);
    }
    
    private function buildCredentials() {
        $credentials = $this->config["formatVersion"].":".
                $this->config["userId"].":".
                $this->config["group"].":".
                $this->config["domain"];
        $secret = base64_encode($this->config["clientSecret"]);
        return base64_encode(base64_encode($credentials).":".$secret);
    }

}