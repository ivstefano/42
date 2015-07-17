<?php
/**
 * Creator: Ivo Stefanov
 * Modifier: Ivo Stefanov
 * Date: 16-07-2015
 * Time: 20:12
 * Type: Worker
 */
namespace Core\Infrastructure\Presentation\Mapping;

class Mapper {
	/**
	 * The key used to define front to back parser functions
	 */
	const FRONT_TO_BACK_KEY_NAME = 'toBackConverter';

	/**
	 * The key used to define default value for parsing using the mapping
	 */
	const DEFAULT_VALUE_KEY_NAME = 'defaultValue';

	/**
	 * The map containing the meta-data translations
	 * @var Mappable
	 */
	protected $map;

	/**
	 * Creates a new mapper using the provided Mappable map
	 * @param Mappable $map
	 */
	public function __construct(Mappable $map = null) {
		$this->setMap($map);
	}

	/**
	 * @param Mappable $map
	 */
	public function setMap($map) {
		$this->map = $map;
	}

	/**
	 * @return Mappable
	 */
	public function getMap() {
		return $this->map;
	}

	/**
	 * @return array The meta-data mapping array
	 */
	public function getMapping() {
		return $this->getMap()->getMapping();
	}

	/**
	 * Gets the mapping from the Map Object and separates the parsing functions from the Mapping and sets them in the Map
	 * @param Mappable $map
	 */
	private function extractMappingFunctions(Mappable $map) {
		$parsingFunctions = [];
		$parsingFunctionsReversed = [];

		foreach ($map->getMapping() as $dbField => $mappedContent) {
			if (is_array($mappedContent)) {
				$content = reset($mappedContent); // Take the first element

				if (is_string($content)) { // Only Back -> Front function name provided
					$parsingFunctions[$dbField] = array($content);
				} else if (is_array($content)) { // The content is an array with Back -> Front functions. Might include Front -> Back functions
					$parsingFunctions[$dbField] = $content;
					if (array_key_exists(self::FRONT_TO_BACK_KEY_NAME, $content)) {
						// There is Front -> Back list with key 'backFn'
						$parsingFunctionsReversed[$dbField] = is_array($content[self::FRONT_TO_BACK_KEY_NAME]) ?
							$content[self::FRONT_TO_BACK_KEY_NAME] :
							array($content[self::FRONT_TO_BACK_KEY_NAME]);

						// Remove the Front -> Back part from the Back -> Front list
						unset($parsingFunctions[$dbField][self::FRONT_TO_BACK_KEY_NAME]);
					}
				}
			}
		}

		$map->setBackToFrontParsingFunctions($parsingFunctions);
		$map->setFrontToBackParsingFunctions($parsingFunctionsReversed);
	}

	/**
	 * Returns the parsing functions from the map. If they don't exist, it extracts them using extractMappingFunctions
	 * @return array
	 */
	public function getBackToFrontParsingFunctions() {
		if (is_null($this->getMap()->getBackToFrontParsingFunctions())) {
			$this->extractMappingFunctions($this->getMap());
		}

		return $this->getMap()->getBackToFrontParsingFunctions();
	}

	/**
	 * Returns the parsing functions from the map. If they don't exist, it extracts them using extractMappingFunctions
	 * @return array
	 */
	public function getFrontToBackParsingFunctions() {
		if (is_null($this->getMap()->getFrontToBackParsingFunctions())) {
			$this->extractMappingFunctions($this->getMap());
		}

		return $this->getMap()->getFrontToBackParsingFunctions();
	}

	/**
	 * Generates clean mapping consisting of data source field => output field
	 * @return array
	 */
	private function extractBackToFrontBareMapping() {
		$cleanMapping = [];
		foreach ($this->map->getMapping() as $dbField => $frontField) {
			if (is_array($frontField)) {
				$frontField = key($frontField);
			}
			$cleanMapping[$dbField] = $frontField;
		}

		return $cleanMapping;
	}

	/**
	 * Returns the clean mapping using the class map
	 * If the clean mapping does not exist, the mapper generates it
	 * @return array
	 */
	public function getBackToFrontBareMapping() {
		if (is_null($this->map->getBackToFrontBareMapping())) {
			$this->map->setBackToFrontBareMapping(
				$this->extractBackToFrontBareMapping()
			);
		}
		return $this->map->getBackToFrontBareMapping();
	}

	/**
	 * Returns the reversed clean mapping using the class map
	 * If the reversed clean mapping does not exist, the mapper generates it
	 * @return array
	 */
	public function getFrontToBackBareMapping() {
		if (is_null($this->map->getFrontToBackBareMapping())) {
			if (!is_null($this->map->getBackToFrontBareMapping())) {
				$cleanMapping = $this->map->getBackToFrontBareMapping();
			} else {
				$cleanMapping = $this->extractBackToFrontBareMapping();
			}
			$this->map->setFrontToBackBareMapping(
				array_flip(
					$cleanMapping
				)
			);
		}
		return $this->map->getFrontToBackBareMapping();
	}

	/**
	 * Parses backend fields to frontend using the default values and parsing functions
	 * @param $row
	 * @return array
	 */
	public function parseRowToFront($row) {
		$parsedRow = [];
		$mapping = $this->map->getMapping();
		$parsingFunctions = $this->getBackToFrontParsingFunctions();

		// For each data column extract the corresponding field
		foreach ($row as $dbField => $rowValue) {
			// If the mapped value is not an array, assign the value directly to the key
			if (array_key_exists($dbField, $mapping)) {
				// If the mapping value is an array, parsing has to be commenced (since there are parsing functions)
				if (is_array($mapping[$dbField])) {
					$frontFieldName = key($mapping[$dbField]);
					$processedValue = $rowValue;

					foreach ($parsingFunctions[$dbField] as $fnType => $backToFrontFn) {
						if ($fnType === self::DEFAULT_VALUE_KEY_NAME) {
							// Only if the currently processed value is null or an empty string
							// NOTE: Don't use empty: 0 def value is considered empty
							if (is_null($processedValue) || $processedValue === '') {
								// backToFrontFn keeps the default value when $fnType = 'defaultValue
								$processedValue = $backToFrontFn;
							}
						} else {
							$processedValue = $this->runCustomMethodIfExists($backToFrontFn, $processedValue, $row);
						}
					}
					$parsedRow[$frontFieldName] = $processedValue;
				} else {
					$parsedRow[$mapping[$dbField]] = $rowValue;
				}
			}
		}

		return $parsedRow;
	}

	/**
	 * Returns back to front data parsed as an object
	 * @param $row
	 * @return array
	 */
	public function toFront($row) {
		return $this->parseRowToFront($row);
	}

	/**
	 * Parses data from frontend to backend using backFn values in the map
	 * @param  $row
	 * @return null
	 */
	public function parseRowToBack(array $row) {
		$parsedRow = [];
		$cleanMappingReversed = $this->getFrontToBackBareMapping();
		$parsingFunctionsReversed = $this->getFrontToBackParsingFunctions();

		// For each data column extract the corresponding field
		foreach ($row as $frontField => $rowValue) {
			// If the mapped value is not an array, assign the value directly to the key
			if (array_key_exists($frontField, $cleanMappingReversed)) {
				// If the mapping value is an array, parsing has to be commenced (since there are parsing functions)
				$dbField = $cleanMappingReversed[$frontField];
				$processedValue = $rowValue;

				if (isset($parsingFunctionsReversed[$dbField]) && is_array($parsingFunctionsReversed[$dbField])) {
					foreach ($parsingFunctionsReversed[$dbField] as $backToFrontFn) {
						$processedValue = $this->runCustomMethodIfExists($backToFrontFn, $processedValue, $row);
					}
				}
				$parsedRow[$dbField] = $processedValue;
			}
		}

		return $parsedRow;
	}

	/**
	 * Returns front to back data parsed as an object
	 * @param array $row
	 * @return array
	 */
	public function toBack(array $row) {
		return $this->parseRowToBack($row);
	}

	/**
	 * Internal method used to run custom methods, the value is run through the Map custom parsing function
	 * If no such is found the value is run through the default Mapper parsing functions defined in App_Data_MappingFunctions
	 * If the function is not found the method returns the $value without parsing it
	 * @param $method
	 * @param $value
	 * @param null $row
	 * @return mixed
	 */
	private function runCustomMethodIfExists($method, $value, $row = null) {
		// Check if the parsing method is defined in the Map
		if (method_exists($this->map, $method)) {
			$value = call_user_func(array($this->map, $method), $value, $row);
		}

		return $value;
	}
}
