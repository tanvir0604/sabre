<?php
namespace Tanvir\Sabre\Soap\Api;
use Tanvir\Sabre\Soap\XMLSerializer;

use Tanvir\Sabre\Soap\Call;

class GetCurrencyConversion {

    private $config;
    
    public function __construct(String $params) {
        $this->config = config('sabre')[config('sabre.env')];
        $this->params = $params;
        if(!$this->validateParams()){
          throw new \Exception("Error Processing Request. Required parameter not found!", 1);
          
        }
    }


    public function validateParams()
    {
      if (empty($this->params)) {
        return false;
      }
      return true;
    }
    
    public function run() {
        $soapClient = new Call("DisplayCurrencyLLSRQ");
        $soapClient->setLastInFlow(false);
        $xmlRequest = $this->getRequest();
        // dd($xmlRequest);
        $result = $soapClient->doCall($xmlRequest);
        // dd($result);
        return $result;
        // $sharedContext->addResult("BargainFinderMaxRQ", $xmlRequest);
        // $sharedContext->addResult("BargainFinderMaxRS", $soapClient->doCall($sharedContext, $xmlRequest));
        // return new PassengerDetailsNameOnlyActivity();
    }

    private function getRequest() {
        $request = array("DisplayCurrencyRQ" => array(
                "_attributes" => array("Version" => '2.1.0', "ReturnHostCommand" => 'false', "TimeStamp" => date('Y-m-d').'T'.date('H:i:s').'+00:00'),
                "_namespace" => "http://webservices.sabre.com/sabreXML/2011/10",
                
                "CountryCode" => $this->params,
                "CurrencyCode" => 'CUR',
            )
        );
        return XMLSerializer::generateValidXmlFromArray($request);
    }

}