<?php

namespace App\Command;

use App\Service\RequestSender;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchGateway extends Command
{
    protected static $defaultName = 'app:fetch-gateway';

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

        $response = $this->_oRequestSender->fetchData('/gateway?uuid=e25bd388-cdd3-4d16-bd96-ca2575abd446');

        $output->writeln(print_r($response, true));

        return Command::SUCCESS;
    }
}