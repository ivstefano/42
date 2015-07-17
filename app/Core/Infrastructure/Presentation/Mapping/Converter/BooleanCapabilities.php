<?php
/**
 * Creator: Ivo Stefanov
 * Modifier: Ivo Stefanov
 * Date: 16/07/2015
 * Time: 22:27
 * Type:
 */
namespace Core\Infrastructure\Presentation\Mapping\Converter;

trait BooleanCapabilities {
	/**
	 * Converts the value to boolean
	 * @param $value
	 * @return bool
	 */
	public function toFrontBool($value) {
		return $value === true || $value === 'true' || $value === 1;
	}

	/**
	 * Converts the value to boolean
	 * @param $value
	 * @return bool
	 */
	public function toBackBool($value) {
		return $value === true || $value === 'true' || $value === 1;
	}
}