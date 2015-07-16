<?php
/**
 * Creator: Ivo Stefanov
 * Modifier: Ivo Stefanov
 * Date: 16-07-2015
 * Time: 00:00
 */
require CONFIG_DIR . '/main.php';

// Initializing components ...
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

// Loading environment ...
$envVar = EnvironmentVariables::ENVIRONMENT;
$environment = getEnvironmentVar($envVar);
switch($environment) {
	case Environment::DEVELOPMENT: $fileName = 'dev.php';break;
	case Environment::PRODUCTION:  $fileName = 'prod.php';break;
	default: throw new Exception(
		"Oops! Bootstrap: It looks like $envVar = $environment is an improper environment value (Allowed: development, production)."
	);
}

// Loading the environment config file (development, production) ...
$selectedConfigFile = CONFIG_DIR . "/$fileName";
$configuration = require($selectedConfigFile);

require ROUTES_DIR . "/main.php";