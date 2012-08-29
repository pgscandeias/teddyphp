<?php
#
# Autoloader
#
set_include_path(get_include_path() 
    . PATH_SEPARATOR . __DIR__."/../../vendor/"
    . PATH_SEPARATOR . __DIR__."/../../vendor/Doctrine/lib/"
    . PATH_SEPARATOR . __DIR__."/../../vendor/Doctrine/lib/vendor/doctrine-common/lib/"
    . PATH_SEPARATOR . __DIR__."/../../vendor/Doctrine/lib/vendor/doctrine-dbal/lib/"
);
require_once "SplClassLoader.php";

function app_autoloader($classname) {
    $splClassLoader = new SplClassLoader();
    $splClassLoader->loadClass($classname);
}

spl_autoload_register('app_autoloader');