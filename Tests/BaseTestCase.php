<?php
namespace Tests;

use Backend\EntityManagerContainer;

class BaseTestCase extends \PHPUnit_Framework_TestCase
{
    protected function getUseCase($name)
    {
        $classname = '\App\UseCase\\'.$name;
        $usecase = new $classname();
    
        return $usecase;
    }
}