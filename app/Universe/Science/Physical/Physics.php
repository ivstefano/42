<?php
/**
 * Creator: Ivo Stefanov
 * Modifier: Ivo Stefanov
 * Date: 16-07-2015
 * Time: 00:00
 * Type: Value Object
 */
namespace Universe\Science\Physical;
use Universe\Science\Formal\Mathematics;
use Strength;

class Physics extends Mathematics {
	/**
	 * TODO: Change to Thermodynamics object
	 * @var string
	 */
	private $thermodynamics;

	/**
	 * TODO: Change to Particle object
	 * @var string
	 */
	private $particle;

	/**
	 * Physics constructor.
	 * @param string $thermodynamics
	 * @param string $particle
	 */
	public function __construct($thermodynamics, $particle) {
		// TODO: When the for the properties are implemented, add proper Strengths
		parent::__construct(Strength::NORMAL, Strength::NORMAL);
		$this->thermodynamics = $thermodynamics;
		$this->particle = $particle;
	}

	/**
	 * @return string
	 */
	public function getThermodynamics() {
		return $this->thermodynamics;
	}

	/**
	 * @return string
	 */
	public function getParticle() {
		return $this->particle;
	}
}