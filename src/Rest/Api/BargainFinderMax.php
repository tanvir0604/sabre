<?php
namespace Tanvir\Sabre\Rest\Api;
use Tanvir\Sabre\Rest\Call;
class BargainFinderMax{
    
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


    private function getRequest() {
        $request = '
          {
            "OTA_AirLowFareSearchRQ": {
              "OriginDestinationInformation": [
                {
                  "DepartureDateTime": "'.$this->departureDate.'T00:00:00",
                  "DestinationLocation": {
                    "LocationCode": "'.$this->destination.'"
                  },
                  "OriginLocation": {
                    "LocationCode": "'.$this->origin.'"
                  },
                  "RPH": "0"
                }
              ],
              "POS": {
                "Source": [
                  {
                    "PseudoCityCode": "F9CE",
                    "RequestorID": {
                      "CompanyName": {
                        "Code": "TN"
                      },
                      "ID": "1",
                      "Type": "1"
                    }
                  }
                ]
              },
              "TPA_Extensions": {
                "IntelliSellTransaction": {
                  "RequestType": {
                    "Name": "200ITINS"
                  }
                }
              },
              "TravelPreferences": {
                "TPA_Extensions": {
                  "DataSources": {
                    "ATPCO": "Enable",
                    "LCC": "Disable",
                    "NDC": "Disable"
                  },
                  "NumTrips": {}
                }
              },
              "TravelerInfoSummary": {
                "AirTravelerAvail": [
                  {
                    "PassengerTypeQuantity": [
                      {
                        "Code": "ADT",
                        "Quantity": 1
                      }
                    ]
                  }
                ],
                "SeatsRequested": [
                  1
                ]
              },
              "Version": "1"
            }
          }';
        return $request;
    }
}