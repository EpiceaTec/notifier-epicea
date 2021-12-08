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

    public function fetchData($uri,$uid = null)
    {
        $response = self::_callUrl($uri, [
            
        ],$uid);

        return $response;
    }

    private static function _callUrl($uri, $data, $uid) {
        $response = null;

        $host = $_ENV['EWATTCH_URL'];
        $key = $_ENV['EWATTCH_API_KEY'];
        $userId = $_ENV['EWATTCH_USER_ID'];

        if($uid == null) {
            $data = [
                'dates'             =>  ["now-1h", "now"],
                'sampling'          =>  ["live"],
                'datapoint_uuids'   =>  ["87903d15-8ffb-4b4d-b356-e0e20665c65d"],
                'type'              =>  ["PULSE"]
            ];
        }else {
            $data = [
                'dates'             =>  ["now-1h", "now"],
                'sampling'          =>  ["live"],
                'datapoint_uuids'   =>  ["7d1c320d-ee30-448e-906d-d69400009048"],
                'type'              =>  ["MACHINE_STATE"]
            ];
        }
        
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