<?php
namespace Tanvir\Sabre\Soap;
use Tanvir\Sabre\Soap\Api\BargainFinderMax;
class Api{
    public function bergainFinderMax($origin, $destination, $departureDate)
    {
        $BargainFinderMax = new BargainFinderMax($origin, $destination, $departureDate);
        return $BargainFinderMax->run();
    }
}