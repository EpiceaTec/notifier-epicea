<?php

namespace App\Command;

use Psr\Log\LoggerInterface;
use App\Service\RequestSender;
use App\Manager\MachineManager;
use App\Manager\ReleveManager;
use App\Service\SendInfo;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchDatapoint extends Command
{
    protected static $defaultName = 'app:fetch-data';

    private $_oRequestSender;
    private $_oMachineManager;
    private $_oReleveManager;
    private $_oSendInfo;
    private $_oLogger;

    public function __construct(RequestSender $oRequestSender/*, MachineManager $oMachineManager, ReleveManager $oReleveManager*/, SendInfo $oSendInfo, LoggerInterface $oLogger)
    {
        $this->_oRequestSender = $oRequestSender;
        //$this->_oMachineManager = $oMachineManager;
        //$this->_oReleveManager = $oReleveManager;
        $this->_oSendInfo = $oSendInfo;
        $this->_oLogger = $oLogger;

        parent::__construct();
    }

    protected function configure(): void
    {
        
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $output->writeln('<info>Start fetching data...</info>');

        $this->_oLogger->info('Fetching data from a datapoint');

        $response = $this->_oRequestSender->fetchData('/datafetch?');

        $response = $response[0]['series'];

        foreach ($response as $oResponse) {
            $output->writeln($oResponse);
        }

        //$output->writeln(print_r($response, true));

        $this->_oLogger->info('Data fetched :' . json_encode($response));

        //$conn = $this->_oSendInfo->connectToAzure();

        //$oMachine = $this->_oMachineManager->create($response[0]['name'], $response[0]['uuid'], $response[0]['structure_uuid'], $response[0]['gateway_uuid'], $response[0]['type'], $response[0]['sampling'], true);
        //$this->_oReleveManager->create($response[0]["series"][0][1], $response[0]["series"][0][0], $oMachine, true);

        return Command::SUCCESS;
    }
}