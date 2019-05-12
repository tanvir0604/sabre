<?php
return [
    'env' => env('SABRE_ENV', 'test'),
    'test' => [
        'soap' => 'https://sws-crt.cert.havail.sabre.com',
        'rest' => 'https://api-crt.cert.havail.sabre.com',
        'userId' => 'ctyk3ou66mgrtghg',
        'group' => 'DEVCENTER',
        'domain' => 'EXT',
        'clientSecret' => 'Hs26JuSi',
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
        'userId' => 'ctyk3ou66mgrtghg',
        'group' => 'DEVCENTER',
        'domain' => 'EXT',
        'clientSecret' => 'Hs26JuSi',
        'formatVersion' => 'V1',
        'OTA_PingRQVersion' => '1.0.0',
        'TravelItineraryReadRQVersion' => '3.6.0',
        'PassengerDetailsRQVersion' => '3.2.0',
        'IgnoreTransactionLLSRQVersion' => '2.0.0',
        'BargainFinderMaxRQVersion' => '1.9.2',
        'EnhancedAirBookRQVersion' => '3.2.0'
    ],
];