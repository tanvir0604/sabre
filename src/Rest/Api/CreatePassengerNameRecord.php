<?php
namespace Tanvir\Sabre\Rest\Api;
use Tanvir\Sabre\Rest\Call;
class CreatePassengerNameRecord{
    public function __construct($params)
    {
        // dd($params);
        $this->config = config('sabre')[config('sabre.env')];
        $this->path = '/v2.2.0/passenger/records?mode=create';
        $this->params = $params;
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

      $personName = [];
      foreach($this->params['passangerInfo'] as $key => $p){
        $personName[] = '{
          "NameNumber": "'.($key+1).'.1",
          "NameReference": "'.$p['indicator'].'",
          "PassengerType": "'.$p['type'].'",
          "GivenName": "'.$p['info']->first_name.'",
          "Surname": "'.$p['info']->last_name.'",
          "Infant": '.($p['type']=='INF'?'true':'false').'
        }';
      }

      $personNameWithoutInfant = [];
      foreach($this->params['passangerInfo'] as $key => $p){
        if($p['type'] != 'INF'){
          $personNameWithoutInfant[]=' {
            "SegmentNumber": "A",
            "PersonName": {
              "DateOfBirth": "'.(date('Y-m-d', strtotime($p['info']->dob))).'",
              "Gender": "M",
              "NameNumber": "'.($key+1).'.1",
              "GivenName": "'.$p['info']->first_name.'",
              "Surname": "'.$p['info']->last_name.'"
            },
            "VendorPrefs": {
              "Airline": {
                "Hosted": true
              }
            }
          }';
      
        }
      }

      $service = [];
      
      foreach($this->params['passangerInfo'] as $key => $p){
        if($p['type'] == 'INF'){
          $service[] ='
            {
              "PersonName": {
                  "NameNumber": "'.$key.'.1"
              },
              "SSR_Code": "INFT",
              "Text": "'.$p['info']->last_name.'/'.$p['info']->first_name.'/'.(date('jMy', strtotime($p['info']->dob))).'"
            }
          ';      
        }
      }


      $flightSegment = [];
      foreach($this->params['flights'] as $key1 => $flight){
        foreach($flight['scheduleDesc'] as $key2 => $schedule){
          $date = $flight['departure_date'];
          if(isset($flight['schedules'][$key2]['departureDateAdjustment'])){
            $date = date('Y-m-d', strtotime($date. ' + '.$flight['schedules'][$key2]['departureDateAdjustment'].' days'));
          }
          
          $flightSegment[] ='
            {
              "ArrivalDateTime": "'.$date.'T'.date("H:i:s", strtotime(substr($schedule['arrival']['time'], 0, 8))).'",
              "DepartureDateTime": "'.$date.'T'.date("H:i:s", strtotime(substr($schedule['departure']['time'], 0, 8))).'",
              "FlightNumber": "'.$schedule['carrier']['marketingFlightNumber'].'",
              "NumberInParty": "1",
              "ResBookDesigCode": "Y",
              "Status": "NN",
              "DestinationLocation": {
                "LocationCode": "'.$schedule['arrival']['airport'].'"
              },
              "MarketingAirline": {
                "Code": "'.$schedule['carrier']['marketing'].'",
                "FlightNumber": "'.$schedule['carrier']['marketingFlightNumber'].'"
              },
              "OriginLocation": {
                "LocationCode": "'.$schedule['departure']['airport'].'"
              }
            }';
          }
        }

        $passengerType = [];
        foreach($this->params['passangers'] as $key => $p){
          $passengerType[] ='{
            "Code": "'.$key.'",
            "Quantity": "'.$p.'"
          }';        
        }

        $request = '
        {
            "CreatePassengerNameRecordRQ": {
              "version": "2.2.0",
              "targetCity": "'.$this->config['group'].'",
              "haltOnAirPriceError": false,
              "TravelItineraryAddInfo": {
                "AgencyInfo": {
                  "Address": {
                    "AddressLine": "SABRE TRAVEL",
                    "CityName": "SOUTHLAKE",
                    "CountryCode": "US",
                    "PostalCode": "76092",
                    "StateCountyProv": {
                      "StateCode": "TX"
                    },
                    "StreetNmbr": "3150 SABRE DRIVE"
                  },
                  "Ticketing": {
                    "TicketType": "7TAW"
                  }
                },
                "CustomerInfo": {
                  "ContactNumbers": {
                    "ContactNumber": [
                      {
                        "NameNumber": "1.1",
                        "Phone": "817-555-1212",
                        "PhoneUseType": "H"
                      }
                    ]
                  },
                  "PersonName": [';
                    $request .= implode(',', $personName);
                  $request .=']
                }
              },



              "SpecialReqDetails": {
                "AddRemark": {
                  "RemarkInfo": {
                    "FOP_Remark": {
                      "Type": "CHECK"
                    }
                  }
                },
                "SpecialService": {
                  "SpecialServiceInfo": {
                    "SecureFlight": [';
                    $request .= implode(',', $personNameWithoutInfant);
                  $request .='],
                    "Service": [';
                    $request .= implode(',', $service);
                  $request .=']
                  }
                }
              },




              

              "AirBook": {
                "HaltOnStatus": [
                  {
                    "Code": "HL"
                  },
                  {
                    "Code": "KK"
                  },
                  {
                    "Code": "LL"
                  },
                  {
                    "Code": "NN"
                  },
                  {
                    "Code": "NO"
                  },
                  {
                    "Code": "UC"
                  },
                  {
                    "Code": "US"
                  }
                ],
                "OriginDestinationInformation": {
                  "FlightSegment": [';
                  $request .= implode(',', $flightSegment);
                  $request .= ']
                },
                "RedisplayReservation": {
                  "NumAttempts": 10,
                  "WaitInterval": 300
                }
              },



              "AirPrice": [
                {
                  "PriceRequestInformation": {
                    "Retain": true,
                    "OptionalQualifiers": {
                      "FOP_Qualifiers": {
                        "BasicFOP": {
                          "Type": "CK"
                        }
                      },
                      "PricingQualifiers": {
                        "PassengerType": [';
                        $request .= implode(',', $passengerType);
                        $request .=']
                      }
                    }
                  }
                }
              ],
              
              
              "PostProcessing": {
                
                "EndTransaction": {
                  "Source": {
                    "ReceivedFrom": "SP WEB"
                  }
                },
                "RedisplayReservation": {
                  "waitInterval": 100
                }
              }
            }
          }
        ';
        return $request;
    }
}