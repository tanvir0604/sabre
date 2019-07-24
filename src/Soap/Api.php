<?php
namespace Tanvir\Sabre\Soap;
use Tanvir\Sabre\Soap\Call;
use Tanvir\Sabre\Soap\Api\BargainFinderMax;
use Tanvir\Sabre\Soap\Api\AlternateAirportShop;

class Api{

    public function call($action, $request)
    {
        $soapClient = new Call($action);
        $soapClient->setLastInFlow(false);
        $result = $soapClient->doCall($request);
        return $result;
    }
    public function BargainFinderMax(Array $params)
    {
        $BargainFinderMax = new BargainFinderMax($params);
        return json_decode(json_encode($BargainFinderMax->run()), TRUE);
    }
    public function AlternateAirportShop(Array $params)
    {
        $AlternateAirportShop = new AlternateAirportShop($params);
        return json_decode(json_encode($AlternateAirportShop->run()), TRUE);
    }
}