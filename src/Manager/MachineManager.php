<?php

namespace App\Manager;

use App\Entity\Machine;
use App\Repository\MachineRepository;
use Psr\Log\LoggerInterface;

class MachineManager extends Manager 
{
    private $_oMachineRepository;
    private $_oLogger;

    public function __construct(MachineRepository $oMachineRepository, LoggerInterface $oLogger)
    {
        $this->_oMachineRepository = $oMachineRepository;
        $this->_oLogger = $oLogger;
    }

    public function create(string $nom, string $uuid, string $structureUuid, string $gatewayUuid, string $type, string $sampling, bool $bFlush = false) 
    {
        $oMachine = new Machine();

        $oMachine->setNom($nom);
        $oMachine->setUuid($uuid);
        $oMachine->setStructureUuid($structureUuid);
        $oMachine->setGatewayUuid($gatewayUuid);
        $oMachine->setType($type);
        $oMachine->setSampling($sampling);

        $this->save($oMachine, $bFlush);

        return $oMachine;
    }

    public function save(Machine $oMachine, bool $bFlush = false): void
    {
        $this->_persist($oMachine);

        if ($bFlush) {
            $this->flush();
        }
    }
}