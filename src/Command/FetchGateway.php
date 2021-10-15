<?php

namespace App\Command;

use App\Service\RequestSender;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchGateway extends Command
{
    protected static $defaultName = 'app:fetch-gateway';

    private $_oRequestSender;
    private $_oLogger;

    public function __construct(RequestSender $oRequestSender, LoggerInterface $oLogger)
    {
        $this->_oRequestSender = $oRequestSender;
        $this->_oLogger = $oLogger;
        parent::__construct();
    }

    protected function configure(): void
    {
        
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $output->writeln('<info>Start fetching data...</info>');

        $this->_oLogger->info('Fetching data from a gateway');

        $response = $this->_oRequestSender->fetchData('/gateway?uuid=e25bd388-cdd3-4d16-bd96-ca2575abd446');

        $output->writeln(print_r($response, true));

        $this->_oLogger->info('Data fetched :' . json_encode($response));

        return Command::SUCCESS;
    }
}