<?php
require_once __DIR__ . "/../App/utils/autoload.php";

use Doctrine\ORM\Tools\SchemaTool;
use Backend\EntityManagerContainer;

class DoctrineWrapper {
    public static $em;
}
$em = DoctrineWrapper::$em = EntityManagerContainer::get();

$entityNamespace = '\App\Entity\\';
$entityPath = __DIR__ . '/../App/Entity';

$files = scandir($entityPath);
$classes = array();
foreach ($files as $file) {
    $info = pathinfo($file);
    if ($info['extension'] == 'php') {
        $classes[] = $em->getClassMetadata($entityNamespace . $info['filename']);
    }
}

$tool = new SchemaTool($em);
$tool->dropSchema($classes);
$tool->createSchema($classes);