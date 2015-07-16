<?php
/**
 * Creator: Ivo Stefanov
 * Modifier: Ivo Stefanov
 * Date: 16-07-2015
 * Time: 00:00
 */

// Let it blow ...
error_reporting(E_ALL);

// Configure directory constants ...
define('BASE_DIR',      __DIR__  . '/..');
define('APP_DIR',       BASE_DIR . '/app');
define('VENDOR_DIR',    BASE_DIR . '/vendor');
define('ROUTES_DIR',    APP_DIR  . '/routes');
define('CONFIG_DIR',    APP_DIR  . '/configs');
define('BOOTSTRAP_DIR', APP_DIR  . '/bootstrap');

// In Autoloader Veritas
require VENDOR_DIR . '/autoload.php';

// Lets start the ride of your life
require BOOTSTRAP_DIR . '/main.php';