<?php
/**
 * Creator: Ivo Stefanov
 * Modifier: Ivo Stefanov
 * Date: 16-07-2015
 * Time: 00:00
 * Type: Value Object
 */
namespace Universe\Science\Social;
use Universe\Science\Life\FunctionalBiology;
use Strength;

class Psychology extends FunctionalBiology {
	/**
	 * TODO: Change to Developmental object
	 * @var string
	 */
	private $developmental;

	/**
	 * TODO: Change to Cognitive object
	 * @var string
	 */
	private $cognitive;

	/**
	 * Psychology constructor.
	 * @param string $developmental
	 * @param string $cognitive
	 */
	public function __construct($developmental, $cognitive) {
		// TODO: When the for the properties are implemented, add proper Strengths
		parent::__construct(Strength::NORMAL, Strength::NORMAL, Strength::NORMAL);
		$this->developmental = $developmental;
		$this->cognitive = $cognitive;
	}

	/**
	 * @return string
	 */
	public function getDevelopmental() {
		return $this->developmental;
	}

	/**
	 * @return string
	 */
	public function getCognitive() {
		return $this->cognitive;
	}
}