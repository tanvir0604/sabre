<?php
namespace Tanvir\Sabre\Rest;
use Tanvir\Sabre\Rest\Api\BargainFinderMax;
use Tanvir\Sabre\Rest\Call;
class Api{

    public function call($path, $request)
    {
        $Call = new Call();
        $result = $Call->executePostCall($path, $request);
        return $result;
    }
    public function bergainFinderMax($origin, $destination, $departureDate)
    {
        $BargainFinderMax = new BargainFinderMax($origin, $destination, $departureDate);
        return $BargainFinderMax->run();
    }
}