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

    public function call($param1, $param2)
    {
        return $this->api->call($param1, $param2);
    }

    public function BargainFinderMax($params)
    {
        return $this->api->BargainFinderMax($params);
    }
    public function AirlineLookup(Array $params)
    {
        return $this->api->AirlineLookup($params);
    }
    public function AlternateAirportShop(Array $params)
    {
        //rest and soap
        return $this->api->AlternateAirportShop($params);
    }
    public function CreatePassengerNameRecord(Array $params)
    {
        //rest only
        return $this->api->CreatePassengerNameRecord($params);
    }
    public function EnhancedAirTicket(String $params)
    {
        //rest only
        return $this->api->EnhancedAirTicket($params);
    }
    public function GetCurrencyConversion(String $params)
    {
        //soap only
        return $this->api->GetCurrencyConversion($params);
    }

    public function GetETicketDetails(String $ticket)
    {
        //soap only
        return $this->api->GetETicketDetails($ticket);
    }
}