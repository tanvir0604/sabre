<?php
namespace Tanvir\Sabre\Rest;
use Tanvir\Sabre\Rest\Api\BargainFinderMax;
use Tanvir\Sabre\Rest\Api\AlternateAirportShop;
use Tanvir\Sabre\Rest\Api\AirlineLookup;
use Tanvir\Sabre\Rest\Call;
class Api{

    public function call($path, $request)
    {
        $Call = new Call();
        $result = $Call->executePostCall($path, $request);
        return $result;
    }
    public function BargainFinderMax(Array $params)
    {
        $BargainFinderMax = new BargainFinderMax($params);
        return $BargainFinderMax->run();
    }
    public function AlternateAirportShop(Array $params)
    {
        $BargainFinderMax = new AlternateAirportShop($params);
        return $BargainFinderMax->run();
    }
    public function AirlineLookup(Array $params)
    {
        $AirlineLookup = new AirlineLookup($params);
        return $AirlineLookup->run();
    }
}