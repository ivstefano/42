<?php
/**
 * Creator: Ivo Stefanov
 * Modifier: Ivo Stefanov
 * Date: 17/07/2015
 * Time: 01:54
 * Type:
 */
namespace Examples;

use Core\Infrastructure\Presentation\Mapping\Mappable;
use Core\Infrastructure\Presentation\Mapping\Mapper;

class ItemMappingExample {
	/**
	 * @var Mappable
	 */
	private $itemMap;

	/**
	 * @var Mapper
	 */
	private $mapper;

	/**
	 * ItemMappingExample constructor.
	 * @param Mappable $itemMap
	 * @param Mapper $mapper
	 */
	public function __construct(Mappable $itemMap, Mapper $mapper) {
		$this->itemMap = $itemMap;
		$this->mapper = $mapper;
	}

	public function runBackToFront() {
		$this->mapper->setMap($this->itemMap);

		$item = [
			'item_id' => 1,
			'item_name' => 'CoMpUtEr',
			'item_price' => -1200,
			'item_available' => 'true'
		];

		$output = $this->mapper->toFront($item);

		print_r($output);
	}

	public function runFrontToBack() {
		$this->mapper->setMap($this->itemMap);

		$item = [
			'id' => 1,
			'name' => 'CoMpUtEr',
			'price' => -1200,
			'available' => 'true'
		];

		$input = $this->mapper->toBack($item);

		print_r($input);
	}
}