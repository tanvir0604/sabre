<?php
namespace Tanvir\Sabre\Soap\Api;
use Tanvir\Sabre\Soap\XMLSerializer;

use Tanvir\Sabre\Soap\Call;

class BargainFinderMax {

    private $config;
    
    public function __construct(Array $params) {
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
      if (empty($this->params['OriginDestinationInformation']) || empty($this->params['PassengerTypeQuantity'])) {
        return false;
      }

      return true;
    }
    
    public function run() {
        $soapClient = new Call("BargainFinderMaxRQ");
        $soapClient->setLastInFlow(false);
        $xmlRequest = $this->getRequest();
        $result = $soapClient->doCall($xmlRequest);
        return $result;
        // $sharedContext->addResult("BargainFinderMaxRQ", $xmlRequest);
        // $sharedContext->addResult("BargainFinderMaxRS", $soapClient->doCall($sharedContext, $xmlRequest));
        // return new PassengerDetailsNameOnlyActivity();
    }

    private function getRequest() {
        $request = array("OTA_AirLowFareSearchRQ" => array(
            "_attributes" => array("Version" => $this->config['BargainFinderMaxRQVersion']),
            "_namespace" => "http://www.opentravel.org/OTA/2003/05",
            "POS" => array(
                "Source" => array(
                    "_attributes" => array("PseudoCityCode"=>"7TZA"),
                    "RequestorID" => array(
                        "_attributes" => array("ID"=>"1", "Type"=>"1"),
                        "CompanyName" => array(
                            "_attributes" => array("Code"=>"TN")
                        )
                    )
                )
            ),
            "OriginDestinationInformation" => array(
                "DepartureDateTime" => '2019-07-20T00:00:00',
                "OriginLocation" => array("_attributes" => array("LocationCode"=> "LHR")),
                "DestinationLocation" => array("_attributes" => array("LocationCode"=> "BOM")),
                "TPA_Extensions" => array(
                    "SegmentType" => array("_attributes" => array("Code" => "O"))
                )
            ),
            "TravelPreferences" => array(
                "_attributes" => array("ValidInterlineTicket" => "true"),
                "CabinPref" => array("_attributes" => array("Cabin"=>"Y", "PreferLevel"=>"Preferred"))
            ),
            "TravelerInfoSummary" => array(
                "SeatsRequested" => 1,
                "AirTravelerAvail" => array(
                    "PassengerTypeQuantity" => array("_attributes" => array("Code" => "ADT", "Quantity" => "1"))
                )
            ),
            "TPA_Extensions" => array(
                "IntelliSellTransaction" => array(
                    "RequestType" => array("_attributes" => array("Name" => "50ITINS"))
                )
                
            )
        )
        );
        return XMLSerializer::generateValidXmlFromArray($request);
    }

}