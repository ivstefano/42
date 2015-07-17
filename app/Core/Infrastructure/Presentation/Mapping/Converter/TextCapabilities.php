<?php
/**
 * Creator: Ivo Stefanov
 * Modifier: Ivo Stefanov
 * Date: 17/07/2015
 * Time: 00:30
 * Type:
 */

namespace Core\Infrastructure\Presentation\Mapping\Converter;

trait TextCapabilities {
	/**
	 * Converts string to lowercase
	 * @param $value
	 * @return string
	 */
	public function toLower($value) {
		return strtolower($value);
	}

	/**
	 * Converts string to uppercase
	 * @param $value
	 * @return string
	 */
	public function toUpper($value) {
		return strtoupper($value);
	}

}