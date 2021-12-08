<?php

namespace App\Command;

use Psr\Log\LoggerInterface;
use App\Service\RequestSender;
use App\Service\SendInfo;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
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
        $this
        ->addArgument('uuid', InputArgument::OPTIONAL, 'Uuid to send request'); 
    }

protected function execute(InputInterface $input, OutputInterface $output): int
{

    $output->writeln('<info>Start fetching data...</info>');

    $this->_oLogger->info('Fetching data from a datapoint');

    $uuid = $input->getArgument('uuid');

    if(empty($uuid)) {
        $output->writeln('<info>Fetch S1 data</info>');

        $response = $this->_oRequestSender->fetchData('/datafetch?');

        $response = $response[0]['series'];

        $output->writeln(end($response)[0]);
        $output->writeln(end($response)[1]);
        
        $conn = $this->_oSendInfo->sendInfo(end($response));
    } else {
        $output->writeln('<info>Fetch S1 state data</info>');

        $response = $this->_oRequestSender->fetchData('/datafetch?', $uuid);

        $response = $response[0]['series'];

        $output->writeln(end($response)[0]);
        $output->writeln(end($response)[1]);

        $conn = $this->_oSendInfo->sendInfo(end($response));
    }

    

    //$output->writeln(print_r($response, true));


    $this->_oLogger->info('Data fetched :' . json_encode($response));
    

    return Command::SUCCESS;
}
}