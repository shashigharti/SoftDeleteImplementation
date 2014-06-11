<?php
// cli-config.php
require_once __DIR__."/bootstrap.php";
use \Doctrine\ORM\Tools\Console\ConsoleRunner;

return ConsoleRunner::createHelperSet($em);
//return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($em);