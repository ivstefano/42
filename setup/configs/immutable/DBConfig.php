<?php
/**
 * Creator: Ivo Stefanov
 * Modifier: Ivo Stefanov
 * Date: 16-07-2015
 * Time: 00:00
 * Type: Value Object
 */

class DBConfig {
	/**
	 * @var string Database hostname
	 */
	private $host;

	/**
	 * @var string Database name
	 */
	private $databaseName;

	/**
	 * @var string Database username
	 */
	private $username;

	/**
	 * @var string Database password
	 */
	private $password;

	/**
	 * DBConfig keeps configuration for the database.
	 * @param string $host
	 * @param string $databaseName
	 * @param string $username
	 * @param string $password
	 */
	public function __construct($host, $databaseName, $username, $password) {
		$this->host = $host;
		$this->databaseName = $databaseName;
		$this->username = $username;
		$this->password = $password;
	}

	/**
	 * @return string
	 */
	public function getHost() {
		return $this->host;
	}

	/**
	 * @return string
	 */
	public function getDatabaseName() {
		return $this->databaseName;
	}

	/**
	 * @return string
	 */
	public function getUsername() {
		return $this->username;
	}

	/**
	 * @return string
	 */
	public function getPassword() {
		return $this->password;
	}
}