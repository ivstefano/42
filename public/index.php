<?php
/**
 * Creator: Ivo Stefanov
 * Modifier: Ivo Stefanov
 * Date: 16-07-2015
 * Time: 00:00
 */

// Let it explode ...
error_reporting(E_ALL);

// Configure shortcuts ...
define('SLASH',        DIRECTORY_SEPARATOR);

// Configure file constants ...
define('MAIN_FILE',     'main.php');
define('AUTOLOAD_FILE', 'autoload.php');

// Configure directory constants ...
define('BASE_DIR',      __DIR__   . SLASH . '..');
define('APP_DIR',       BASE_DIR  . SLASH . 'app');
define('SETUP_DIR',     BASE_DIR  . SLASH . 'setup');
define('VENDOR_DIR',    BASE_DIR  . SLASH . 'vendor');
define('ROUTES_DIR',    SETUP_DIR . SLASH . 'routes');
define('CONFIG_DIR',    SETUP_DIR . SLASH . 'configs');
define('BOOTSTRAP_DIR', SETUP_DIR . SLASH . 'bootstrap');

// In AutoLoader Veritas
require VENDOR_DIR . SLASH . AUTOLOAD_FILE;

// It is always good to have some configurations added
require CONFIG_DIR . SLASH . MAIN_FILE;

// Configure existing environments ...
// TODO: make the environments more configurable (for example discoverable in the CONFIG_DIR)
$environmentConfigurationFiles = [
	Environment::DEVELOPMENT => 'dev.php',
	Environment::PRODUCTION => 'prod.php'
];

// Bootstrap the application
require BOOTSTRAP_DIR . SLASH . MAIN_FILE;