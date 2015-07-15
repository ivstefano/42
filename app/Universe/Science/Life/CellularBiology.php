<?php
/**
 * Creator: Ivo Stefanov
 * Modifier: Ivo Stefanov
 * Date: 16-07-2015
 * Time: 00:00
 * Type: Value Object
 */
namespace Universe\Science\Life;
use Universe\Science\Physical\Chemistry;
use Strength;

class CellularBiology extends Chemistry {
	/**
	 * TODO: Change to BioChemistry object
	 * @var string
	 */
	private $bioChemistry;

	/**
	 * TODO: Change to Evolutionary object
	 * @var string
	 */
	private $evolutionary;

	/**
	 * CellularBiology constructor.
	 * @param string $bioChemistry
	 * @param string $evolutionary
	 */
	public function __construct($bioChemistry, $evolutionary) {
		// TODO: When the for the properties are implemented, add proper Strengths
		parent::__construct(Strength::NORMAL, Strength::NORMAL);
		$this->bioChemistry = $bioChemistry;
		$this->evolutionary = $evolutionary;
	}

	/**
	 * @return string
	 */
	public function getBioChemistry() {
		return $this->bioChemistry;
	}

	/**
	 * @return string
	 */
	public function getEvolutionary() {
		return $this->evolutionary;
	}
}