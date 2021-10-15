<?php

namespace App\Manager;

use App\Entity\Machine;
use App\Repository\MachineRepository;

class MachineManager extends Manager 
{
    private $_oMachineRepository;

    public function __construct(MachineRepository $oMachineRepository)
    {
        $this->_oMachineRepository = $oMachineRepository;
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
    }

    public function save(Machine $oMachine, bool $bFlush = false): void
    {
        $this->_persist($oMachine);

        if ($bFlush) {
            $this->flush();
        }
    }
}