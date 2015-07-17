<?php
/**
 * Creator: Ivo Stefanov
 * Modifier: Ivo Stefanov
 * Date: 17/07/2015
 * Time: 01:21
 * Type:
 */
namespace Store\Infrastructure\Presentation;

use Core\Infrastructure\Presentation\Mapping\Map;
use Core\Infrastructure\Presentation\Mapping\Converter\TextCapabilities;
use Core\Infrastructure\Presentation\Mapping\Converter\BooleanCapabilities;
use Core\Infrastructure\Presentation\Mapping\Converter\AbsoluteNumberCapabilities;

class ItemMap extends Map {
	use AbsoluteNumberCapabilities, TextCapabilities, BooleanCapabilities;

	public $mapping = [
		'item_id' => 'id',
		'item_name' => [
			'name' => [
				'toUpper',
				'toBackConverter' => 'toLower'
			]
		],
		'item_price' => [
			'price' => 'absoluteValue'
		],
		'item_available' => [
			'available' => 'toBool'
		],
	];
}