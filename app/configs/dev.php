<?php
/**
 * Creator: Ivo Stefanov
 * Modifier: Ivo Stefanov
 * Date: 16-07-2015
 * Time: 00:00
 */

return [
	ConfigurationVariables::DATABASE => function () {
		$host     = getEnvironmentVar(EnvironmentVariables::DEVELOPMENT_HOST);
		$dbName   = getEnvironmentVar(EnvironmentVariables::DEVELOPMENT_DBNAME);
		$username = getEnvironmentVar(EnvironmentVariables::DEVELOPMENT_USERNAME);
		$password = getEnvironmentVar(EnvironmentVariables::DEVELOPMENT_PASSWORD);
		return new DBConfig($host, $dbName, $username, $password);
	}
];
