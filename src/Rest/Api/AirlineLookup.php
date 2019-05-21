<?php
namespace Tanvir\Sabre\Rest\Api;
use Tanvir\Sabre\Rest\Call;
class AirlineLookup{
    
    public function __construct(Array $params)
    {
        $this->path = '/v1/lists/utilities/airlines';
        $this->params = implode(',', $params);
    }
    
    public function run()
    {
        $Call = new Call();
        $result = $Call->executeGetCall($this->path, ['airlinecode' => $this->params]);
        return $result;
    }
}