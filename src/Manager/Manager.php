<?php

namespace App\Manager;

use Doctrine\ORM\EntityManagerInterface;

abstract class Manager
{
    protected $_oEM;

    final public function setEntityManager(EntityManagerInterface $oEM)
    {
        $this->_oEM = $oEM;
    }

    final protected function _persist($oEntity)
    {
        $this->_oEM->persist($oEntity);
    }

    final public function flush()
    {
        $this->_oEM->flush();
    }
}
