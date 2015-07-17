<?php
/**
 * Creator: Ivo Stefanov
 * Modifier: Ivo Stefanov
 * Date: 16-07-2015
 * Time: 20:16
 * Type: Worker
 */
namespace Core\Infrastructure\Presentation\Mapping;

use ArrayAccess;

class App_Data_Collection implements ArrayAccess {
	/**
	 * @var Mapper The mapper used for parsing the raw data
	 */
	protected $mapper;

	/**
	 * @var array[] The parsed raw data rows
	 */
	protected $parsedDataRows = [];

	/**
	 * @var array raw data as it comes from the data source/input
	 */
	protected $rawDataRows;

	/**
	 * Instantiate a Collection with a Map or a Mapper
	 * @param array $rows
	 * @param Mapper|Mappable $map
	 */
	public function __construct($map, $rows) {
		if ($map instanceof Mappable) {
			$mapper = new Mapper($map);
		} else {
			$mapper = $map;
		}

		$this->mapper = $mapper;
		$this->rawDataRows = $rows;
	}

	/**
	 * Changes the map of the collection mapper
	 * @param Mappable $map
	 */
	public function setMap(Mappable $map) {
		$this->mapper->setMap($map);
	}

	/**
	 * Returns the map of the collection mapper
	 * @return Mappable
	 */
	public function getMap() {
		return $this->mapper->getMap();
	}

	/**
	 * Allows the collection to use different mapper to parse the information
	 * @param Mapper $mapper
	 */
	public function setMapper(Mapper $mapper) {
		$this->mapper = $mapper;
	}

	/**
	 * Returns the mapper of the collection mapper
	 * @return Mapper
	 */
	public function getMapper() {
		return $this->mapper;
	}

	/**
	 * Sets new raw data to the collection and resets the already parsed information
	 * @param array $rows
	 */
	public function setDataRows($rows) {
		$this->rawDataRows = $rows;
		$this->parsedDataRows = [];
	}

	/**
	 * Parses the raw collection data to front end arrays
	 * @return array[]
	 */
	public function toFront() {

		foreach ($this->rawDataRows as $row) {
			$this->parsedDataRows[] = $this->mapper->toFront($row);
		}
		return $this->parsedDataRows;
	}

	/**
	 * Parses the raw collection data to front end arrays
	 * @return array[]
	 */
	public function toBack() {
		foreach ($this->rawDataRows as $row) {
			$this->parsedDataRows[] = $this->mapper->toBack($row);
		}

		return $this->parsedDataRows;
	}

	/**
	 * Whether a offset exists
	 * @param mixed $offset
	 * @return bool Whether a offset exists
	 */
	public function offsetExists($offset) {
		return isset($this->parsedDataRows[$offset]);
	}

	/**
	 * Offset to retrieve
	 * @param mixed $offset The offset to retrieve.
	 * @return mixed Offset to retrieve
	 */
	public function offsetGet($offset) {
		return isset($this->parsedDataRows[$offset]) ? $this->parsedDataRows[$offset] : null;
	}

	/**
	 * Offset to set
	 * @param mixed $offset The offset to assign the value to.
	 * @param mixed $value The value to set.
	 */
	public function offsetSet($offset, $value) {
		if (is_null($offset)) {
			$this->parsedDataRows[] = $value;
		} else {
			$this->parsedDataRows[$offset] = $value;
		}
	}

	/**
	 * Offset to unset
	 * @param mixed $offset The offset to unset.
	 */
	public function offsetUnset($offset) {
		unset($this->parsedDataRows[$offset]);
	}

	/**
	 * Converts the collection to an array
	 * @return array[]
	 */
	public function toArray() {
		return $this->parsedDataRows;
	}

	/**
	 * @return int
	 */
	public function count() {
		return count($this->parsedDataRows);
	}
}