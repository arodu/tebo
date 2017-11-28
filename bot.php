<?php

define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);
define('ROOT', dirname(__FILE__));


ini_set('include_path',
  ini_get('include_path').
  ROOT.DS."lib".DS.PS.
  ROOT.DS."commands".DS.PS
);

//echo ini_get('include_path');  exit();

require_once "config.php";
require_once "lib/Router.php";
require_once "lib/Request.php";
require_once "lib/Response.php";
require_once "lib/Command.php";

$router = new Router();
$router->excecuteCommand();
$router->end();
