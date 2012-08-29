<?php
namespace Tests;

use Backend\EntityManagerContainer;

class BaseTestCase extends \PHPUnit_Framework_TestCase
{
    protected $em;
    
    public function setUp()
    {
        $this->em = \DoctrineWrapper::$em;
    }
    
    protected function getUseCase($name)
    {
        $classname = '\App\UseCase\\'.$name;
        $usecase = new $classname($this->em);
    
        return $usecase;
    }
    
    protected function getRepo($entityName)
    {
        return $this->em->getRepository('\App\Entity\\'.$entityName);
    }
}