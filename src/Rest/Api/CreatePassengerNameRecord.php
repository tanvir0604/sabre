<?php
namespace Tanvir\Sabre\Rest\Api;
use Tanvir\Sabre\Rest\Call;
class CreatePassengerNameRecord{
    public function __construct($params)
    {
        $this->path = '/v2.2.0/passenger/records';
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
            { "CreatePassengerNameRecordRQ": { "targetCity": "3QND", "Profile": { "UniqueID": { "ID": "ABCD1EF" } }, "AirBook": { "OriginDestinationInformation": { "FlightSegment": [{ "ArrivalDateTime": "2017-04-30", "DepartureDateTime": "2019-07-30T13:55", "FlightNumber": "309", "NumberInParty": "1", "ResBookDesigCode": "V", "Status": "NN", "DestinationLocation": { "LocationCode": "KHI" }, "MarketingAirline": { "Code": "PK", "FlightNumber": "309" }, "MarriageGrp": "O", "OriginLocation": { "LocationCode": "ISB" } }] } }, "AirPrice": { "PriceRequestInformation": { "OptionalQualifiers": { "MiscQualifiers": { "TourCode": { "Text": "TEST1212" } }, "PricingQualifiers": { "PassengerType": [{ "Code": "CNN", "Quantity": "1" }] } } } }, "MiscSegment": { "DepartureDateTime": "2019-07-30", "NumberInParty": 1, "Status": "NN", "Type": "OTH", "OriginLocation": { "LocationCode": "ISB" }, "Text": "TEST", "VendorPrefs": { "Airline": { "Code": "PK" } } }, "SpecialReqDetails": { "AddRemark": { "RemarkInfo": { "FOP_Remark": { "Type": "CHECK", "CC_Info": { "Suppress": true, "PaymentCard": { "AirlineCode": "PK", "CardSecurityCode": "1234", "Code": "VI", "ExpireDate": "2012-12", "ExtendedPayment": "12", "ManualApprovalCode": "123456", "Number": "4123412341234123", "SuppressApprovalCode": true } } }, "FutureQueuePlaceRemark": { "Date": "12-21", "PrefatoryInstructionCode": "11", "PseudoCityCode": "IPCC1", "QueueIdentifier": "499", "Time": "06:00" }, "Remark": [{ "Type": "Historical", "Text": "TEST HISTORICAL REMARK" }, { "Type": "Invoice", "Text": "TEST INVOICE REMARK" }, { "Type": "Itinerary", "Text": "TEST ITINERARY REMARK" }, { "Type": "Hidden", "Text": "TEST HIDDEN REMARK" }] } }, "AirSeat": { "Seats": { "Seat": [{ "NameNumber": "1.1", "Preference": "AN", "SegmentNumber": "0" }, { "NameNumber": "2.1", "Preference": "AN", "SegmentNumber": "1" }, { "NameNumber": "3.1", "Preference": "AN", "SegmentNumber": "1" }] } }, "SpecialService": { "SpecialServiceInfo": { "Service": [{ "SSR_Code": "OSI", "PersonName": { "NameNumber": "testing" #}, "Text": "TEST1", "VendorPrefs": { "Airline": { "Code": "PK" } } }] } } }, "PostProcessing": { "RedisplayReservation": true, "ARUNK": "", "QueuePlace": { "QueueInfo": { "QueueIdentifier": [{ "Number": "100", "PrefatoryInstructionCode": "11" }] } }, "EndTransaction": { "Source": { "ReceivedFrom": "SWS TEST" } } } } }
        ';
        return $request;
    }
}