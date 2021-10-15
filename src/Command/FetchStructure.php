<?php

namespace App\Command;

use App\Service\RequestSender;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchStructure extends Command
{
    protected static $defaultName = 'app:fetch-structure';

    private $_oRequestSender;

    public function __construct(RequestSender $oRequestSender)
    {
        $this->_oRequestSender = $oRequestSender;

        parent::__construct();
    }

    protected function configure(): void
    {
        
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $output->writeln('<info>Start fetching data...</info>');

        $this->_oLogger->info('Fetching data from a structure');

        $response = $this->_oRequestSender->fetchData('/structure?uuid=d513b7d3-3736-4967-b302-e1eac4d541cd');

        $output->writeln(print_r($response, true));

        $this->_oLogger->info('Data fetched :' . json_encode($response));

        return Command::SUCCESS;
    }
}