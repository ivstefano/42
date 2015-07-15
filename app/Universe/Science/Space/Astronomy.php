<?php
/**
 * Creator: Ivo Stefanov
 * Modifier: Ivo Stefanov
 * Date: 16-07-2015
 * Time: 00:00
 * Type: Value Object
 */
namespace Universe\Science\Earth;
use Strength;

// TODO: Should have behavior from Chemistry + Functional Biology
class Astronomy extends Geo {
	/**
	 * TODO: Change to Planetary object
	 * @var string
	 */
	private $planetary;

	/**
	 * TODO: Change to Cosmology object
	 * @var string
	 */
	private $cosmology;

	/**
	 * Astronomy constructor.
	 * @param string $planetary
	 * @param string $cosmology
	 */
	public function __construct($planetary, $cosmology) {
		// TODO: When the for the properties are implemented, add proper Strengths
		parent::__construct(Strength::NORMAL, Strength::NORMAL, Strength::NORMAL);
		$this->planetary = $planetary;
		$this->cosmology = $cosmology;
	}

	/**
	 * @return string
	 */
	public function getPlanetary() {
		return $this->planetary;
	}

	/**
	 * @return string
	 */
	public function getCosmology() {
		return $this->cosmology;
	}
}