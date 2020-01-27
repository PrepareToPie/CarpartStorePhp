<?php
/**
 * Initializing of framework
 */
$output_buffer = 0;
// For authorization etc
session_start();
// Main constants
define('CORE_PATH', realpath(__DIR__));
define('SITE_PATH', realpath(CORE_PATH . '/../site'));
define('PUBLIC_PATH', realpath(CORE_PATH . '/../../web'));

// Defaults
define('MVC_DEFAULT_CONTROLLER', 'carpart'); // Default request will be /main/index
define('MVC_DEFAULT_ACTION', 'list'); // Default request will be /main/index
define('MVC_DEFAULT_PARAM', 'in_stock'); // Default request will be /main/index

// Include libraries and framework parts
require_once CORE_PATH . '/CoreClass.php';
require_once CORE_PATH . '/CommonClass.php';
require_once CORE_PATH . '/DbClass.php';
require_once SITE_PATH . '/Models/Car.php';
require_once SITE_PATH . '/Models/Carpart.php';
require_once SITE_PATH . '/Models/User.php';
require_once SITE_PATH . '/Models/Shopcart.php';