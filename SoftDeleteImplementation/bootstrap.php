<?php
// bootstrap.php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

$entities = array("Entities");
$yml = array(__DIR__."/config/yml");
// Create a simple "default" Doctrine ORM configuration for Annotations

$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration($entities, $isDevMode, null, null, false);

/*  
 * This uses simple annotation reader and returns "no metadata found"
 
 $isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration($entities, $isDevMode);
 */ 
// or if you prefer yaml or XML
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
//$config = Setup::createYAMLMetadataConfiguration($yml, $isDevMode);


// The connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'Testing',
);

// Obtaining the entity manager
$em = EntityManager::create($dbParams, $config);
