<?php
namespace Tanvir\Sabre\Soap\Api;
use Tanvir\Sabre\Soap\XMLSerializer;

use Tanvir\Sabre\Soap\Call;

class GetETicketDetails {

    private $config;
    
    public function __construct(String $ticket) {
        $this->config = config('sabre')[config('sabre.env')];
        $this->ticket = $ticket;
        if(!$this->validateParams()){
          throw new \Exception("Error Processing Request. Required parameter not found!", 1);
          
        }
    }

    public function validateParams()
    {
      if (empty($this->ticket)) {
        return false;
      }

      return true;
    }
    
    public function run() {
        $soapClient = new Call("eTicketCouponLLSRQ");
        $soapClient->setLastInFlow(false);
        // $xmlRequest = $this->getRequest();
        $xmlRequest = $this->stringReq();
        // dd($xmlRequest);
        $result = $soapClient->doCall($xmlRequest);
        return $result;
        // $sharedContext->addResult("BargainFinderMaxRQ", $xmlRequest);
        // $sharedContext->addResult("BargainFinderMaxRS", $soapClient->doCall($sharedContext, $xmlRequest));
        // return new PassengerDetailsNameOnlyActivity();
    }


    private function stringReq(){
        return '
        <eTicketCouponRQ Version="2.0.0">
            <Ticketing eTicketNumber="'.$this->ticket.'"/>
        </eTicketCouponRQ>
        ';
    }

}