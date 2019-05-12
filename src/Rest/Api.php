<?php
namespace Tanvir\Sabre\Rest;
use Tanvir\Sabre\Rest\Api\BargainFinderMax;
class Api{
    public function bergainFinderMax($origin, $destination, $departureDate)
    {
        $BargainFinderMax = new BargainFinderMax($origin, $destination, $departureDate);
        return $BargainFinderMax->run();
    }
}