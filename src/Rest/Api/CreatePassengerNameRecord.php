<?php
namespace Tanvir\Sabre\Rest\Api;
use Tanvir\Sabre\Rest\Call;
class CreatePassengerNameRecord{
    public function __construct($params)
    {
        // dd($params);
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
        $request = '
        {
            "CreatePassengerNameRecordRQ": {
              "version": "2.2.0",
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
                    foreach($this->params['passangerInfo'] as $key => $p){
                    $request .='{
                      "NameNumber": "1.1",
                      "NameReference": "ABC123",
                      "PassengerType": "'.$p['type'].'",
                      "GivenName": "'.$p['info']->first_name.'",
                      "Surname": "'.$p['info']->last_name.'"
                    }';
                    if($key < count($this->params['passangerInfo'])-1){ $request .= ','; }
                    }
                  $request .=']
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
                  foreach($this->params['flights'] as $key1 => $flight){
                    foreach($flight['scheduleDesc'] as $key2 => $schedule){
                      $date = $flight['departure_date'];
                      if(isset($flight['schedules'][$key2]['departureDateAdjustment'])){
                        $date = date('Y-m-d', strtotime($date. ' + '.$flight['schedules'][$key2]['departureDateAdjustment'].' days'));
                      }
                      
                      $request .='
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
                        if($key1 == count($this->params['flights'])-1 && $key2 == count($this->params['flights'][$key1]['scheduleDesc'])-1 ){ 
                          $request .= ' '; 
                        }else{$request .= ',';}
                      }
                    }
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
                        $count = 0;
                        foreach($this->params['passangers'] as $key=>$value){
                          $count ++;
                        $request .='
                          {
                            "Code": "'.$key.'",
                            "Quantity": "'.$value.'"
                          }';
                          if($count < count($this->params['passangers'])){ $request .= ','; }
                        }
                        $request .=']
                      }
                    }
                  }
                }
              ],
              "HotelBook": {
                "BookingInfo": {
                  "BookingKey": "80c8aac8-bc75-42f7-9266-339103f1258d",
                  "RequestorID": "SG000000"
                },
                "Rooms": {
                  "Room": [
                    {
                      "Guests": {
                        "Guest": [
                          {
                            "Contact": {
                              "Phone": "817-555-1212"
                            },
                            "FirstName": "MARCIN",
                            "LastName": "DZIK",
                            "Index": 1,
                            "LeadGuest": true,
                            "Type": 10,
                            "Email": "Witold.Petriczek@sabre.com"
                          }
                        ]
                      },
                      "RoomIndex": 1
                    }
                  ]
                },
                "PaymentInformation": {
                  "FormOfPayment": {
                    "PaymentCard": {
                      "PaymentType": "CC",
                      "CardCode": "VI",
                      "CardNumber": "4000000000006",
                      "ExpiryMonth": 6,
                      "ExpiryYear": "2021",
                      "FullCardHolderName": {
                        "FirstName": "MARCIN",
                        "LastName": "DZIK",
                        "Email": "Witold.Petriczek@sabre.com"
                      },
                      "CSC": "123",
                      "Address": {
                        "AddressLine": [
                          "Wadowicka 6"
                        ],
                        "CityName": "Krakow",
                        "StateProvince": {
                          "code": "KR"
                        },
                        "StateProvinceCodes": {
                          "Code": [
                            {
                              "content": "KR"
                            }
                          ]
                        },
                        "PostCode": "30-415",
                        "CountryCodes": {
                          "Code": [
                            {
                              "content": "PL"
                            }
                          ]
                        }
                      },
                      "Phone": {
                        "PhoneNumber": "817-555-1212"
                      }
                    }
                  },
                  "Type": "GUARANTEE"
                },
                "POS": {
                  "Source": {
                    "RequestorID": {
                      "Type": 5,
                      "Id": "12345678",
                      "IdContext": "IATA"
                    },
                    "AgencyAddress": {
                      "AddressLine1": "3150 SABRE DRIVE",
                      "CityName": {},
                      "CountryName": {
                        "Code": "US"
                      }
                    },
                    "AgencyName": "Really Trustworthy Agency",
                    "ISOCountryCode": "US",
                    "PseudoCityCode": "TM61"
                  }
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
                    "SecureFlight": [
                      {
                        "SegmentNumber": "A",
                        "PersonName": {
                          "DateOfBirth": "2001-01-01",
                          "Gender": "M",
                          "NameNumber": "1.1",
                          "GivenName": "MARCIN",
                          "Surname": "DZIK"
                        },
                        "VendorPrefs": {
                          "Airline": {
                            "Hosted": true
                          }
                        }
                      }
                    ],
                    "Service": [
                      {
                        "SSR_Code": "OTHS",
                        "Text": "CC MARCIN DZIK"
                      }
                    ]
                  }
                }
              },
              "PostProcessing": {
                "ARUNK": {},
                "EndTransaction": {
                  "Source": {
                    "ReceivedFrom": "SP TEST"
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