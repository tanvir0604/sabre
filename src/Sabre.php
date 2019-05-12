<?php
namespace Tanvir\Sabre;
class Sabre{
    function __construct($type = 'rest')
    {   
        $this->api = new \Tanvir\Sabre\Rest\Api();
        if($type == 'soap'){
            $this->api = new \Tanvir\Sabre\Soap\Api();
        }
        
    }
    public function bergainFinderMax($origin, $destination, $departureDate)
    {
        return $this->api->bergainFinderMax($origin, $destination, $departureDate);
    }
}