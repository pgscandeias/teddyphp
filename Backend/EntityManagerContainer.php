<?php
namespace Backend;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Configuration;


class EntityManagerContainer
{
    public static function get($connectionOptions = array(
        'driver'    => 'pdo_sqlite',
        'memory'    => true,
    ))
    {
        Setup::registerAutoloadDirectory(__DIR__ . "/../vendor/Doctrine/lib/vendor/doctrine-common/lib");
        
        $isDevMode = true;
        $entityNamespace = 'App\Entity\\';
        $entityPath = __DIR__ . '/Entity';
        $config = Setup::createAnnotationMetadataConfiguration(array($entityPath), $isDevMode);
        $em = EntityManager::create($connectionOptions, $config);
        
        return $em;
    }
}