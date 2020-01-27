<?php

/**
 * Fron-controller: process almost every request.
 */

// Init Framework
use Symfony\Component\HttpFoundation\Request;
require_once '../src/Core/init.php';
require_once '../vendor/autoload.php';
//ToDo: delete
//Something for proper stream options only
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
$request = Request::createFromGlobals();
$app = new CoreClass();
$app->processRequest($request);