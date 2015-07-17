<?php
/**
 * Creator: Ivo Stefanov
 * Modifier: Ivo Stefanov
 * Date: 17/07/2015
 * Time: 00:18
 * Type:
 */
namespace Core\Infrastructure\Presentation\Mapping\Converter;

trait AbsoluteNumberCapabilities {

	/**
	 * Returns an absolute value of a number
	 * @param $value
	 * @return number
	 */
	public function absoluteValue($value) {
		return abs($value);
	}
}