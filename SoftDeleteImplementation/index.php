<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/entities/Product.php';
require_once __DIR__ . '/SoftDeleteable.php';


use Entity\Article;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Filters\SoftDeleteable;

$config = new \Doctrine\ORM\Configuration();

// The connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'Testing',
);
$entities = array("Entities");
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration($entities, $isDevMode, null, null, false);

// set up proxy configuration
$config->setProxyDir(__DIR__ . 'Proxies');
$config->setProxyNamespace('Proxies');


//add filters
$config->addFilter("soft-deleteable" , "\Filters\SoftDeleteable");

// Obtaining the entity manager
$em = EntityManager::create($dbParams, $config);

// enable filter
$filter = $em->getFilters()->enable("soft-deleteable");


//get all the records
$filter->setParameter('deleted_at', '0');


/* add new product with deleted_at field set to 1 i.e deleted */
$product = new Entities\Product();
$product->setName('Laptop');
$product->setDeletedAt(1);

$em->persist($product);
$em->flush();

/*query records */ 
$repo = $em->getRepository('Entities\Product');
$laptop = $repo->findOneBy(array(
    'name' => 'Laptop'
));
var_dump($laptop);
