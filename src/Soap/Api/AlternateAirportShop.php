<?php
namespace Tanvir\Sabre\Soap\Api;
use Tanvir\Sabre\Soap\XMLSerializer;

use Tanvir\Sabre\Soap\Call;

class AlternateAirportShop {

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
        $soapClient = new Call("BargainFinderMax_ASRQ");
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
        <OTA_AirLowFareSearchRQ xmlns="http://www.opentravel.org/OTA/2003/05" Version="5.1.0" ResponseType="OTA" ResponseVersion="5.1.0">
        <POS>
            <Source PseudoCityCode="PCC">
                <RequestorID ID="1" Type="1">
                    <CompanyName Code="TN">TN</CompanyName>
                </RequestorID>
            </Source>
        </POS>
        <OriginDestinationInformation RPH="1">
            <DepartureDateTime>2019-07-20T00:00:00</DepartureDateTime>
            <OriginLocation LocationCode="LHR"/>
            <DestinationLocation LocationCode="BOM"/>
            <TPA_Extensions>
                
                <SegmentType Code="O"/>
                <CabinPref Cabin="Y" PreferLevel="Preferred"/>
            </TPA_Extensions>
        </OriginDestinationInformation>
        <OriginDestinationInformation RPH="2">
            <DepartureDateTime>2019-07-24T00:00:00</DepartureDateTime>
            <OriginLocation LocationCode="BOM"/>
            <DestinationLocation LocationCode="LHR"/>
            <TPA_Extensions>
                
                <SegmentType Code="O"/>
            </TPA_Extensions>
        </OriginDestinationInformation>
        <TravelerInfoSummary>
            <SeatsRequested>1</SeatsRequested>
            <AirTravelerAvail>
                <PassengerTypeQuantity Code="ADT" Quantity="1"/>
            </AirTravelerAvail>
            <PriceRequestInformation CurrencyCode="USD"/>
        </TravelerInfoSummary>
        <TPA_Extensions>
            <IntelliSellTransaction>
            </IntelliSellTransaction>
        </TPA_Extensions>
    </OTA_AirLowFareSearchRQ>
        ';
    }


    private function stringRequest() {

        // dd($this->params);

        $request = '<OTA_AirLowFareSearchRQ xmlns="http://www.opentravel.org/OTA/2003/05" Version="5.1.0" ResponseType="OTA" ResponseVersion="5.1.0">
                    <POS>
                        <Source PseudoCityCode="PCC">
                            <RequestorID ID="1" Type="1">
                                <CompanyName Code="TN">TN</CompanyName>
                            </RequestorID>
                        </Source>
                    </POS>';
                    foreach ($this->params['OriginDestinationInformation'] as $key => $value) {
                        $request .= '<OriginDestinationInformation RPH="'.$key.'">
                                    <DepartureDateTime>"'.$value['DepartureDateTime'].'T00:00:00"</DepartureDateTime>
                                    <OriginLocation LocationCode="'.$value['OriginLocation'].'"/>
                                    <DestinationLocation LocationCode="'.$value['DestinationLocation'].'"/>
                                    <TPA_Extensions>
                                        
                                        <SegmentType Code="O"/>
                                        <CabinPref Cabin="Y" PreferLevel="Preferred"/>
                                    </TPA_Extensions>
                                </OriginDestinationInformation>';
                    }
                    '<TravelerInfoSummary>
                        <SeatsRequested>1</SeatsRequested>
                        <AirTravelerAvail>';
                        foreach ($this->params['PassengerTypeQuantity'] as $key => $value) {
                            $request .= '<PassengerTypeQuantity Code="'.$value['Code'].'" Quantity="'.$value['Quantity'].'"/>';
                        }
                            
                        '</AirTravelerAvail>
                        <PriceRequestInformation CurrencyCode="BDT"/>
                    </TravelerInfoSummary>
                    <TPA_Extensions>
                        <IntelliSellTransaction>
                        </IntelliSellTransaction>
                    </TPA_Extensions>
                </OTA_AirLowFareSearchRQ>';
            return $request;
    }

    private function getRequest() {


        


        $AirTravelerAvail = [];
        foreach ($this->params['PassengerTypeQuantity'] as $key => $value) {
            $AirTravelerAvail[] = ["PassengerTypeQuantity" => array("_attributes" => array("Code" => $value['Code'], "Quantity" => $value['Quantity']))];
        }
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


            
            // "OriginDestinationInformation" => array(
            //     "DepartureDateTime" => $this->departureDate.'T00:00:00',
            //     "OriginLocation" => array("_attributes" => array("LocationCode"=> $this->origin)),
            //     "DestinationLocation" => array("_attributes" => array("LocationCode"=> $this->destination)),
            //     "TPA_Extensions" => array(
            //         "SegmentType" => array("_attributes" => array("Code" => "O")),
            //         // "SisterOriginLocation" => array("_attributes" => array("LocationCode" => "LTN")),
            //         // "SisterOriginLocation" => array("_attributes" => array("LocationCode" => "LGW")),
            //         "CabinPref" => array("_attributes" => array("Cabin" => "Y", "PreferLevel" => "Preferred"))
            //     )
            // ),

            // [
            //     "OriginDestinationInformation" => array(
                
            //         "DepartureDateTime" => 'T00:00:00',
            //         "OriginLocation" => array("_attributes" => array("LocationCode"=> '')),
            //         "DestinationLocation" => array("_attributes" => array("LocationCode"=> '')),
            //         "TPA_Extensions" => array(
            //             "SegmentType" => array("_attributes" => array("Code" => "O")),
            //             // "SisterOriginLocation" => array("_attributes" => array("LocationCode" => "LTN")),
            //             // "SisterOriginLocation" => array("_attributes" => array("LocationCode" => "LGW")),
            //             "CabinPref" => array("_attributes" => array("Cabin" => "Y", "PreferLevel" => "Preferred"))
            //         )
            //     ),
            //     "OriginDestinationInformation" => array(
                
            //         "DepartureDateTime" => 'T00:00:00',
            //         "OriginLocation" => array("_attributes" => array("LocationCode"=> '')),
            //         "DestinationLocation" => array("_attributes" => array("LocationCode"=> '')),
            //         "TPA_Extensions" => array(
            //             "SegmentType" => array("_attributes" => array("Code" => "O")),
            //             // "SisterOriginLocation" => array("_attributes" => array("LocationCode" => "LTN")),
            //             // "SisterOriginLocation" => array("_attributes" => array("LocationCode" => "LGW")),
            //             "CabinPref" => array("_attributes" => array("Cabin" => "Y", "PreferLevel" => "Preferred"))
            //         )
            //     ),
            // ],


            "TravelPreferences" => array(
                "_attributes" => array("ValidInterlineTicket" => "true"),
                "CabinPref" => array("_attributes" => array("Cabin"=>"Y", "PreferLevel"=>"Preferred"))
            ),
            "TravelerInfoSummary" => array(
                "SeatsRequested" => $this->params['SeatsRequested'],
                "AirTravelerAvail" => $AirTravelerAvail,
                "PriceRequestInformation" => array("_attributes" => array("CurrencyCode" => "BDT"))
            ),
            "TPA_Extensions" => array(
                "IntelliSellTransaction" => array(
                    "RequestType" => array("_attributes" => array("Name" => "50ITINS"))
                )
                
            )
        )


        


        );


        // foreach ($this->params['OriginDestinationInformation'] as $key => $value) {
        //     array_push($request['OTA_AirLowFareSearchRQ'], ['OriginDestinationInformation' => 'sdfsd']);
        // }

        // dd($request);
        return XMLSerializer::generateValidXmlFromArray($request);
    }

}