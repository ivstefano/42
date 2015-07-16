<?php
/**
 * Creator: Ivo Stefanov
 * Modifier: Ivo Stefanov
 * Date: 16-07-2015
 * Time: 00:00
 */
require CONFIG_DIR . DIRECTORY_SEPARATOR . MAIN_FILE;

// Initializing components ...
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

// Loading environment ...
$envVar = EnvironmentVariables::ENVIRONMENT;
$environment = getEnvironmentVar($envVar);
if(!isset($environmentConfigurationFiles[$environment])) {
	throw new Exception(
		"Oops! Bootstrap: It looks like $envVar = $environment is an improper environment value (Allowed: development, production)."
	);
}

// Loading the environment config file (development, production) ...
$fileName = $environmentConfigurationFiles[$environment];
$selectedConfigFile = CONFIG_DIR . DIRECTORY_SEPARATOR . $fileName;
$configuration = require($selectedConfigFile);

require ROUTES_DIR . DIRECTORY_SEPARATOR . MAIN_FILE;