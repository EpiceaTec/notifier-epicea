<?php

namespace App\Manager;

use App\Entity\Machine;
use App\Entity\Releve;
use App\Repository\ReleveRepository;
use Psr\Log\LoggerInterface;

class ReleveManager extends Manager 
{
    private $_oReleveRepository;
    private $_oLogger;

    public function __construct(ReleveRepository $oReleveRepository, LoggerInterface $oLogger)
    {
        $this->_oReleveRepository = $oReleveRepository;
        $this->_oLogger = $oLogger;
    }

    public function create(int $valeur, string $date ,Machine $machine, bool $bFlush = false) 
    {
        $oReleve = new Releve();

        $oReleve->setValeur($valeur);
        $oReleve->setDate($date);
        
        $oReleve->setMachine($machine);

        $this->save($oReleve, $bFlush);
    }

    public function save(Releve $oReleve, bool $bFlush = false): void
    {
        $this->_persist($oReleve);

        if ($bFlush) {
            $this->flush();
        }
    }
}