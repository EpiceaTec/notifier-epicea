<?php

namespace App\Service;

use Psr\Log\LoggerInterface;

class RequestSender 
{
    private $_oLogger;

    public function __construct(LoggerInterface $oLogger)
    {
        $this->_oLogger = $oLogger;
    }

    public function fetchData($uri)
    {
        $response = self::_callUrl($uri, [
            
        ]);

        return $response;
    }

    private static function _callUrl($uri, $data) {
        $response = null;

        $host = $_ENV['EWATTCH_URL'];
        $key = $_ENV['EWATTCH_API_KEY'];
        $userId = $_ENV['EWATTCH_USER_ID'];

        $data = [
            'dates'             =>  ["now-1w", "now"],
            'sampling'          =>  ["day"],
            'datapoint_uuids'   =>  ["92b55202-49bb-43ac-b300-c9b5addd0689"],
            'type'              =>  ["PULSE"]
        ];

        if ($host && $key && $userId) {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $host.$uri);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $headers = [];

            switch ($uri) {
                case '/organisation':
                    $headers[] = 'Content-Type: application/json';
                    $headers[] = 'APIKEY: '.$key;
                    $headers[] = 'USERID: '.$userId;
                    curl_setopt($ch, CURLOPT_HEADER, $headers);
                break;
                case '/structure?uuid=d513b7d3-3736-4967-b302-e1eac4d541cd':
                    $headers[] = 'Content-Type: application/json';
                    $headers[] = 'APIKEY: '.$key;
                    $headers[] = 'USERID: '.$userId;
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                break;
                case '/gateway?uuid=e25bd388-cdd3-4d16-bd96-ca2575abd446':
                    $headers[] = 'Content-Type: application/json';
                    $headers[] = 'APIKEY: '.$key;
                    $headers[] = 'USERID: '.$userId;
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                break;
                case '/datafetch?':
                    $headers[] = 'Content-Type: application/json';
                    $headers[] = 'APIKEY: '.$key;
                    $headers[] = 'USERID: '.$userId;
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                break;
            }

            $response = json_decode(curl_exec($ch), true);

            curl_close($ch);

        }

        return $response;
    }
}