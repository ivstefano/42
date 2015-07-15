<?php
/**
 * Creator: Ivo Stefanov
 * Modifier: Ivo Stefanov
 * Date: 16-07-2015
 * Time: 00:00
 * Type: Value Object
 */
namespace Universe\Science\Earth;
use Universe\Science\Physical\Physics;
use Strength;

// TODO: Should have behavior from Chemistry + Functional Biology
class Geo extends Physics {
	/**
	 * TODO: Change to Climate object
	 * @var string
	 */
	private $climate;

	/**
	 * TODO: Change to Geology object
	 * @var string
	 */
	private $geology;

	/**
	 * TODO: Change to Oceanography object
	 * @var string
	 */
	private $oceanography;

	/**
	 * Geo constructor.
	 * @param string $climate
	 * @param string $geology
	 * @param string $oceanography
	 */
	public function __construct($climate, $geology, $oceanography) {
		// TODO: When the for the properties are implemented, add proper Strengths
		parent::__construct(Strength::NORMAL, Strength::NORMAL);
		$this->climate = $climate;
		$this->geology = $geology;
		$this->oceanography = $oceanography;
	}

	/**
	 * @return string
	 */
	public function getClimate() {
		return $this->climate;
	}

	/**
	 * @return string
	 */
	public function getGeology() {
		return $this->geology;
	}

	/**
	 * @return string
	 */
	public function getOceanography() {
		return $this->oceanography;
	}
}