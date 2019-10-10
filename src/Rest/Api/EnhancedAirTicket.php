<?php
namespace Tanvir\Sabre\Rest\Api;
use Tanvir\Sabre\Rest\Call;
class EnhancedAirTicket{
    public function __construct($pnr, $tax = 7)
    {
        // dd($params);
        $this->config = config('sabre')[config('sabre.env')];
        $this->path = '/v1.2.1/air/ticket';
        $this->pnr = $pnr;
        $this->tax = $tax;
        if(!$this->validateParams()){
            throw new \Exception("Error Processing Request. Required parameter not found!", 1);
        }
    }
    
    public function run()
    {
        $Call = new Call();
        // dd($this->getRequest());
        $result = $Call->executePostCall($this->path, $this->getRequest());
        return $result;
    }

    public function validateParams()
    {
    //   if (empty($this->params)) {
    //     return false;
    //   }
    //   if (empty($this->params['OriginDestinationInformation']) || empty($this->params['PassengerTypeQuantity'])) {
    //     return false;
    //   }

      return true;
    }


    private function getRequest() {
        $request = '
        {
            "AirTicketRQ": {
              "version": "1.2.1",
              "targetCity": "'.$this->config['group'].'",
              "DesignatePrinter": {
                "Printers": {
                  "Hardcopy":{
                    "LNIATA": "530FD5"
                  },
                  "Ticket": {
                    "CountryCode": "BD"
                  },
                  "InvoiceItinerary": {
                    "LNIATA": "530FD5"
                  }
                }
              },
              "Itinerary": {
                "ID": "'.$this->pnr.'"
              },
              "Ticketing": [
                {
                  "MiscQualifiers": {
                    "Commission": {
                      "Percent": 7
                    }
                  },
                  "PricingQualifiers": {
                    "PriceQuote": [
                      {
                        "Record": [
                          {
                            "Number": 1
                          }
                        ]
                      }
                    ]
                  }
                }
              ],
              "PostProcessing": {
                "EndTransaction": {
                  "Source": {
                    "ReceivedFrom": "SP WEB"
                  }
                }
              }
            }
          }
          
        ';
        return $request;
    }
}