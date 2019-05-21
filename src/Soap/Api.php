<?php
namespace Tanvir\Sabre\Soap;
use Tanvir\Sabre\Soap\Call;
use Tanvir\Sabre\Soap\Api\BargainFinderMax;
class Api{

    public function call($action, $request)
    {
        $soapClient = new Call($action);
        $soapClient->setLastInFlow(false);
        $result = $soapClient->doCall($request);
        return $result;
    }
    public function bergainFinderMax($origin, $destination, $departureDate)
    {
        $BargainFinderMax = new BargainFinderMax($origin, $destination, $departureDate);
        return json_decode(json_encode($BargainFinderMax->run()), TRUE);
    }
}