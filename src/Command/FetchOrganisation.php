<?php

namespace App\Command;

use App\Service\RequestSender;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchOrganisation extends Command
{
    protected static $defaultName = 'app:fetch-orga';

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

        $response = $this->_oRequestSender->fetchData();

        $output->writeln(json_encode($response));

        return Command::SUCCESS;
    }
}