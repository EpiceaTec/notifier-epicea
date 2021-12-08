<?php

namespace App\Manager;

use App\Entity\Data;
use App\Repository\DataRepository;
use Psr\Log\LoggerInterface;

class DataManager extends Manager
{
    private $_oDataRepository;
    private $_oLogger;

    public function __construct(DataRepository $oDataRepository, LoggerInterface $oLogger)
    {
        $this->_oDataRepository = $oDataRepository;
        $this->_oLogger = $oLogger;
    }

    public function create(int $masquesAttente, int $masquesTotal, bool $bFlush = false) {
        $oData = new Data();

        $oData->setMasquesAttente(0);
        $oData->setMasquesTotal(0);

        $this->save($oData, $bFlush);
    }

    public function update(array $data) {

        $oData = $this->_oDataRepository->findOneById(1);

        if($data) {
            $nbMasques = $data[1];
            $dernierReleve = $data[0];
        }

        $nbMasquesActuel = $oData->getMasquesAttente();
        $nbMasquesTotal = $oData->getMasquesTotal();

        $oData->setMasquesTotal($nbMasquesTotal + $nbMasques);

        if ($nbMasquesActuel == 1000) {
            $nbMasquesActuel = 0;
        } else if ($nbMasquesActuel >= 1000) {
            $nbMasquesActuel = $nbMasquesActuel - 1000;
        }

        $oData->setMasquesAttente($nbMasquesActuel + $nbMasques);
        $oData->setDernierReleve($dernierReleve);

        $this->save($oData, true);
    }

    public function save(Data $oData, bool $bFlush): void {
        $this->_persist($oData);

        if ($bFlush) {
            $this->flush();
        }
    }
}