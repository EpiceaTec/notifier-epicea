<?php

namespace App\Command;

use Psr\Log\LoggerInterface;
use App\Service\RequestSender;
use App\Service\SendInfo;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchDatapointWithout extends Command
{
    protected static $defaultName = 'app:fetch-data-without';

    private $_oRequestSender;
    private $_oSendInfo;
    private $_oLogger;

    public function __construct(RequestSender $oRequestSender, SendInfo $oSendInfo, LoggerInterface $oLogger)
    {
        $this->_oRequestSender = $oRequestSender;
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

        //$output->writeln(print_r($response, true));

        $output->writeln(end($response)[0]);
        $output->writeln(end($response)[1]);


        $this->_oLogger->info('Data fetched :' . json_encode($response));
        

        return Command::SUCCESS;
    }
}