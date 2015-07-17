<?php
/**
 * Creator: Ivo Stefanov
 * Modifier: Ivo Stefanov
 * Date: 16-07-2015
 * Time: 20:00
 * Type: Contract
 */
namespace Core\Infrastructure\Presentation\Mapping;

interface Mappable {
	/**
	 * Returns the array representing the mapping meta-data used for data translation
	 * @return array
	 */
	public function getMapping();

	/**
	 * Sets the array representing the mapping meta-data used for data translation
	 * @param array $mapping
	 */
	public function setMapping(array $mapping);

	/**
	 * Merges the current mapping meta-data with the provided one
	 * @param array $mapping
	 */
	public function mergeMappingWithoutOverwriting(array $mapping);

	/**
	 * Merges the current mapping meta-data with the provided one
	 * @param array $mapping
	 */
	public function mergeMappingWithOverwriting(array $mapping);

	/**
	 * Returns the translation mapping containing inputField => outputField
	 * @return array
	 */
	public function getBackToFrontBareMapping();

	/**
	 * Sets the translation mapping containing inputField => outputField
	 * @param array $cleanMapping
	 */
	public function setBackToFrontBareMapping(array $cleanMapping);


	/**
	 * Returns the parser functions for inputField => outputField conversion
	 * @return array
	 */
	public function getBackToFrontParsingFunctions();

	/**
	 * Sets the parser function for inputField => outputField conversion
	 * @param array $parsingFunctions
	 */
	public function setBackToFrontParsingFunctions(array $parsingFunctions);

	/**
	 * Returns the clean mapping containing outputField => inputField
	 * @return array
	 */
	public function getFrontToBackBareMapping();

	/**
	 * Sets the clean mapping containing outputField => inputField
	 * @param $cleanMapping
	 */
	public function setFrontToBackBareMapping(array $cleanMapping);

	/**
	 * Returns the parser functions for outputField => inputField conversion
	 * @return array
	 */
	public function getFrontToBackParsingFunctions();

	/**
	 * Sets the parser function for outputField => inputField conversion
	 * @param array $parsingFunctions
	 */
	public function setFrontToBackParsingFunctions(array $parsingFunctions);
}