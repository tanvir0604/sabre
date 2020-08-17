<?php
return [
    'env' => env('SABRE_ENV', 'test'),
    'test' => [
        'soap' => 'https://sws-crt.cert.havail.sabre.com',
        'rest' => 'https://api-crt.cert.havail.sabre.com',
        'userId' => '386027', //ERP
        'group' => 'D6ZK', //pcc
        'domain' => 'EXT',
        'clientSecret' => 'nur1313', //client secret
        'formatVersion' => 'V1',
        'OTA_PingRQVersion' => '1.0.0',
        'TravelItineraryReadRQVersion' => '3.6.0',
        'PassengerDetailsRQVersion' => '3.2.0',
        'IgnoreTransactionLLSRQVersion' => '2.0.0',
        'BargainFinderMaxRQVersion' => '1.9.2',
        'EnhancedAirBookRQVersion' => '3.2.0'
    ],
    'production' => [
        'soap' => 'https://webservices.havail.sabre.com',
        'rest' => 'https://api.havail.sabre.com',
        'userId' => '386027', //ERP
        'group' => 'D6ZK', //pcc
        'domain' => 'EXT',
        'clientSecret' => 'nur1313', //client secret
        'formatVersion' => 'V1',
        'OTA_PingRQVersion' => '1.0.0',
        'TravelItineraryReadRQVersion' => '3.6.0',
        'PassengerDetailsRQVersion' => '3.2.0',
        'IgnoreTransactionLLSRQVersion' => '2.0.0',
        'BargainFinderMaxRQVersion' => '1.9.2',
        'EnhancedAirBookRQVersion' => '3.2.0'
    ],
];



// PCC: D6ZK
// EPR: 386027
// Password: nur1313