<?php
namespace Tanvir\Sabre\Rest\Api;
use Tanvir\Sabre\Rest\Call;
class CreatePassengerNameRecord{
    public function __construct($origin, $destination, $departureDate)
    {
        $this->path = '/v1/offers/shop';
        $this->origin = $origin;
        $this->destination = $destination;
        $this->departureDate = $departureDate;
    }
    
    public function run()
    {
        $Call = new Call();
        $result = $Call->executePostCall($this->path, $this->getRequest());
        return $result;
    }
}