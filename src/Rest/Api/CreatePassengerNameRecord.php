<?php
namespace Tanvir\Sabre\Rest\Api;
use Tanvir\Sabre\Rest\Call;
class CreatePassengerNameRecord{
    public function __construct($params)
    {
        $this->path = '/v2.2.0/passenger/records?mode=create';
        $this->params = $params;
        if(!$this->validateParams()){
            throw new \Exception("Error Processing Request. Required parameter not found!", 1);
        }
    }
    
    public function run()
    {
        $Call = new Call();
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
              "targetCity": "TM61",
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
                  "PersonName": [
                    {
                      "NameNumber": "1.1",
                      "NameReference": "ABC123",
                      "PassengerType": "ADT",
                      "GivenName": "MARCIN",
                      "Surname": "DZIK"
                    }
                  ]
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
                  "FlightSegment": [
                    {
                      "ArrivalDateTime": "2019-09-15T23:01:00",
                      "DepartureDateTime": "2019-09-15T18:15:00",
                      "FlightNumber": "2609",
                      "NumberInParty": "1",
                      "ResBookDesigCode": "Y",
                      "Status": "NN",
                      "DestinationLocation": {
                        "LocationCode": "DFW"
                      },
                      "MarketingAirline": {
                        "Code": "AA",
                        "FlightNumber": "2609"
                      },
                      "OriginLocation": {
                        "LocationCode": "LAS"
                      }
                    }
                  ]
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
                        "PassengerType": [
                          {
                            "Code": "ADT",
                            "Quantity": "1"
                          }
                        ]
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