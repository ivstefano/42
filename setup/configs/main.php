<?php
/**
 * Creator: Ivo Stefanov
 * Modifier: Ivo Stefanov
 * Date: 16-07-2015
 * Time: 00:00
 */

interface ConfigurationVariables {
	const DATABASE = 'database';
}

interface EnvironmentVariables {
	const ENVIRONMENT = 'fourtytwo.environment';

	const DEVELOPMENT_HOST = 'fourtytwo.development.host';
	const DEVELOPMENT_DBNAME = 'fourtytwo.development.dbname';
	const DEVELOPMENT_USERNAME = 'fourtytwo.development.username';
	const DEVELOPMENT_PASSWORD = 'fourtytwo.development.password';

	const PRODUCTION_HOST = 'fourtytwo.production.host';
	const PRODUCTION_DBNAME = 'fourtytwo.production.dbname';
	const PRODUCTION_USERNAME = 'fourtytwo.production.username';
	const PRODUCTION_PASSWORD = 'fourtytwo.production.password';
}

interface Environment {
	const DEVELOPMENT = 'development';
	const PRODUCTION = 'production';
}

/**
 * @param $envVar string The required configuration option
 * @return string The configuration option value
 * @throws Exception When the option is not found in the environment
 */
function getEnvironmentVar($envVar) {
	if(($v = getenv($envVar)) !== false) {
		return $v;
	}
	throw new Exception("Oops! Config: It looks like your variable '$envVar' is not yet added to the environment variables.");
}