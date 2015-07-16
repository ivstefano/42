<?php
/**
 * Creator: Ivo Stefanov
 * Modifier: Ivo Stefanov
 * Date: 16-07-2015
 * Time: 00:00
 */

// Let it explode ...
error_reporting(E_ALL);

// Configure file constants ...
define('MAIN_FILE',        'main.php');
define('AUTOLOARDER_FILE', 'autoloader.php');

// Configure directory constants ...
define('BASE_DIR',      __DIR__  . DIRECTORY_SEPARATOR . '..');
define('APP_DIR',       BASE_DIR . DIRECTORY_SEPARATOR . 'app');
define('VENDOR_DIR',    BASE_DIR . DIRECTORY_SEPARATOR . 'vendor');
define('ROUTES_DIR',    APP_DIR  . DIRECTORY_SEPARATOR . 'routes');
define('CONFIG_DIR',    APP_DIR  . DIRECTORY_SEPARATOR . 'configs');
define('BOOTSTRAP_DIR', APP_DIR  . DIRECTORY_SEPARATOR . 'bootstrap');

// Configure existing environments ...
// TODO: make the environments more configurable (for example discoverable in the CONFIG_DIR)
$environmentConfigurationFiles = [
	Environment::DEVELOPMENT => 'dev.php',
	Environment::PRODUCTION => 'prod.php'
];


// In AutoLoader Veritas
require VENDOR_DIR . DIRECTORY_SEPARATOR . AUTOLOARDER_FILE;

// Lets start the ride of your life
require BOOTSTRAP_DIR . DIRECTORY_SEPARATOR . MAIN_FILE;