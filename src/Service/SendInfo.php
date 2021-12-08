<?php

namespace App\Service;

use PDO;
use PDOException;
use Psr\Log\LoggerInterface;
use App\Manager\DataManager;
use App\Manager\MachineStateManager;

class SendInfo 
{
    private $_oLogger;
    private $_oDataManager;
    private $_oMachineStateManager;

    public function __construct(DataManager $oDataManager, LoggerInterface $oLogger, MachineStateManager $oMachineStateManager)
    {
        $this->_oDataManager = $oDataManager;
        $this->_oLogger = $oLogger;
        $this->_oMachineStateManager = $oMachineStateManager;
    }
    /*public function connectToAzure() {

        try {
            $conn = new PDO('sqlsrv:server ='.$_ENV['SQLSRV_SERVER'].'; Database = '.$_ENV['DATABASE'], $_ENV['DATABASE_ID'], $_ENV['DATABASE_PASSWORD']);
            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        
        catch (PDOException $e) {
            $this->_oLogger->error($e);
            die(print_r($e));
        }

        return $conn;
    }*/

    public function sendInfo(array $data) 
    {
        $this->_oDataManager->update($data);
    }

    public function sendStateMachine(array $data)
    {
        $this->_oMachineStateManager->update($data);
    }
}