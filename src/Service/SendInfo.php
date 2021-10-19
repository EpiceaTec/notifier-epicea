<?php

namespace App\Service;

use PDO;
use PDOException;
use Psr\Log\LoggerInterface;

class SendInfo 
{
    private $_oLogger;

    public function __construct(LoggerInterface $oLogger)
    {
        $this->_oLogger = $oLogger;
    }
    public function connectToAzure() {

        try {
            $conn = new PDO('sqlsrv:server = tcp:epicea-test-azure.database.windows.net,1433; Database = notifier-epicea', 'serge', 'Epiceatest&');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        
        catch (PDOException $e) {
            $this->_oLogger->error($e);
            die(print_r($e));
        }

        return $conn;
    }
}