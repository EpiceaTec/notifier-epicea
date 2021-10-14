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

    public function fetchData()
    {
        $response = self::_callUrl('/gateway?uuid=e25bd388-cdd3-4d16-bd96-ca2575abd446', [
            
        ]);

        /*$this->_oLogger->info('Affichage de la réponse');
        $this->_oLogger->info(json_encode($response));*/

        return $response;
    }

    private static function _callUrl($uri, $data) {
        $response = null;

        $host = $_ENV['EWATTCH_URL'];
        $key = $_ENV['EWATTCH_API_KEY'];
        $userId = $_ENV['EWATTCH_USER_ID'];

        if ($host && $key && $userId) {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $host.$uri);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $headers = [];

            if($data) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                $headers[] = 'Content-Type: application/json';
                $headers[] = 'APIKEY: '.$key;
                $headers[] = 'USERID: '.$userId;
                curl_setopt($ch, CURLOPT_HEADER, $headers);
            } else {
                $headers[] = 'Content-Type: application/json';
                $headers[] = 'APIKEY: '.$key;
                $headers[] = 'USERID: '.$userId;
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            }

            $response = json_decode(curl_exec($ch), true);

            curl_close($ch);

        }

        return $response;
    }
}