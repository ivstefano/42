<?php
/**
 * Creator: Ivo Stefanov
 * Modifier: Ivo Stefanov
 * Date: 16-07-2015
 * Time: 20:07
 * Type: Meta Data
 */
namespace Core\Infrastructure\Presentation\Mapping;

abstract class Map implements Mappable {
	/**
	 * Contains bare mapping in the form of DataField => OutputField
	 * @var array
	 */
	protected $backToFrontBareMapping;
	/**
	 * Contains functions used when parsing from DataField => OutputField
	 * @var array
	 */
	protected $backToFrontParsingFunctions;

	/**
	 * Contains clean mapping in the form of InputField => DataField
	 * @var array
	 */
	protected $frontToBackBareMapping;

	/**
	 * Contains functions used when parsing from InputField => DataField
	 * @var array
	 */
	protected $frontToBackParsingFunctions;

	/**
	 * The mapping metadata used to store the translations of aw data
	 * @var array
	 */
	protected $mapping = [];

	/**
	 * @return array
	 */
	public function getMapping() {
		return $this->mapping;
	}

	/**
	 * Sets the array representing the mapping of mata-data
	 * @param $mapping
	 * @return $this
	 */
	public function setMapping(array $mapping) {
		$this->mapping = $mapping;
		return $this;
	}

	/**
	 * Merges the current mapping with the one provided in the arguments.
	 * Provided mapping values do not overwrite the meta-data mapping.
	 * @param array $mapping
	 * @return $this
	 */
	public function mergeMappingWithoutOverwriting(array $mapping) {
		$this->setMapping(array_merge($this->mapping, $mapping));

		return $this;
	}

	/**
	 * Merges the current mapping with the one provided in the arguments.
	 * Provided mapping overwrites existing values in the existing meta-data mapping.
	 * @param array $mapping
	 * @return $this
	 */
	public function mergeMappingWithOverwriting(array $mapping) {
		$this->setMapping(array_merge($mapping, $this->mapping));

		return $this;
	}

	/**
	 * Returns the clean mapping containing inputField => outputField
	 * @return mixed
	 */
	public function getBackToFrontBareMapping() {
		return $this->backToFrontBareMapping;
	}

	/**
	 * Sets the clean mapping containing inputField => outputField
	 * @param $cleanMapping
	 */
	public function setBackToFrontBareMapping(array $cleanMapping) {
		$this->backToFrontBareMapping = $cleanMapping;
	}

	/**
	 * Returns the clean mapping containing outputField => inputField
	 * @return mixed
	 */
	public function getFrontToBackBareMapping() {
		return $this->frontToBackBareMapping;
	}

	/**
	 * Sets the clean mapping containing outputField => inputField
	 * @param $cleanMapping
	 */
	public function setFrontToBackBareMapping(array $cleanMapping) {
		$this->frontToBackBareMapping = $cleanMapping;
	}

	/**
	 * Returns the parser functions for inputField => outputField conversion
	 * @return array
	 */
	public function getBackToFrontParsingFunctions() {
		return $this->backToFrontParsingFunctions;
	}

	/**
	 * Sets the parser function for inputField => outputField conversion
	 * @param array $parsingFunctions
	 */
	public function setBackToFrontParsingFunctions(array $parsingFunctions) {
		$this->backToFrontParsingFunctions = $parsingFunctions;
	}

	/**
	 * Returns the parser functions for outputField => inputField conversion
	 * @return array
	 */
	public function getFrontToBackParsingFunctions() {
		return $this->frontToBackParsingFunctions;
	}

	/**
	 * Sets the parser function for outputField => inputField conversion
	 * @param $parsingFunctions
	 */
	public function setFrontToBackParsingFunctions(array $parsingFunctions) {
		$this->frontToBackParsingFunctions = $parsingFunctions;
	}
}
