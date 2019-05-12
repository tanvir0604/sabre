<?php
namespace Tanvir\Sabre\Rest\Api;
use Tanvir\Sabre\Rest\Call;
class BargainFinderMax{
    
    public function __construct($origin, $destination, $departureDate)
    {
        $this->path = '/v2.1.0/passenger/records';
        $this->origin = $origin;
        $this->destination = $destination;
        $this->departureDate = $departureDate;
    }
    
    public function run()
    {
        $Call = new Call();
        $result = $Call->executePostCall($this->path.'?mode=create', $this->getRequest());
        return $result;
    }


    private function getRequest() {
        $request = '{
          "CreatePassengerNameRecordRQ": {
            "version": "2.1.0",
            "targetCity": "G7HE",
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
                    "ArrivalDateTime": "2019-05-12T21:48:00",
                    "DepartureDateTime": "2019-05-12T20:25:00",
                    "FlightNumber": "2697",
                    "NumberInParty": "1",
                    "ResBookDesigCode": "Y",
                    "Status": "NN",
                    "DestinationLocation": {
                      "LocationCode": "LAX"
                    },
                    "MarketingAirline": {
                      "Code": "AA",
                      "FlightNumber": "2697"
                    },
                    "OriginLocation": {
                      "LocationCode": "DFW"
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
              "RedisplayReservation": true,
              "ARUNK": "",
              "EndTransaction": {
                "Source": {
                  "ReceivedFrom": "SP TEST"
                }
              }
            }
          }
        }';
        return $request;
    }
}