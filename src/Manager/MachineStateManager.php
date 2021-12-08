<?php

namespace App\Manager;

use App\Entity\MachineState;
use App\Manager\Manager;
use App\Repository\MachineStateRepository;
use Psr\Log\LoggerInterface;

class MachineStateManager extends Manager
{
    private $_oMachineStateRepository;
    private $_oLogger;

    public function __construct(MachineStateRepository $oMachineStateRepository, LoggerInterface $oLogger)
    {
        $this->_oMachineStateRepository = $oMachineStateRepository;
        $this->_oLogger = $oLogger;
    }

    public function create(int $stateCode, string $state, string $dateReleve)
    {
        $oMachineState = new MachineState();

        $oMachineState->setStateCode($stateCode);
        $oMachineState->setState($state);
        $oMachineState->setDateReleve($dateReleve);

        $this->save($$oMachineState, $bFlush);
    }

    public function update(array $aData) {
        $state = "";

        $oMachineState = $this->_oMachineStateRepository->findOneById(1);

        switch ($aData[1]) {
            case '10':
                $state = 'Veille';
            break;
            case '20':
                $state = 'Demarrage';
            break;
            case '30':
                $state = 'Production';
            break;
            case '102.0':
                $state = 'Eteint';
            break;
            default:
                $state = 'Erreur';
            break;
        }

        $oMachineState->setStateCode($aData[1]);
        $oMachineState->setState($state);
        $oMachineState->setDateReleve($aData[0]);

        $this->save($oMachineState, true);

    }

    public function save(MachineState $oData, bool $bFlush): void {
        $this->_persist($oData);

        if ($bFlush) {
            $this->flush();
        }
    }
}