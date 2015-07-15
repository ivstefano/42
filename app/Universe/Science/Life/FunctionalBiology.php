<?php
/**
 * Creator: Ivo Stefanov
 * Modifier: Ivo Stefanov
 * Date: 16-07-2015
 * Time: 00:00
 * Type: Value Object
 */
namespace Universe\Science\Life;
use Strength;

class FunctionalBiology extends CellularBiology {
	/**
	 * TODO: Change to Physiology object
	 * @var string
	 */
	private $physiology;

	/**
	 * TODO: Change to Medicine object
	 * @var string
	 */
	private $medicine;

	/**
	 * TODO: Change to Ecology object
	 * @var string
	 */
	private $ecology;

	/**
	 * FunctionalBiology constructor.
	 * @param string $physiology
	 * @param string $medicine
	 * @param string $ecology
	 */
	public function __construct($physiology, $medicine, $ecology) {
		// TODO: When the for the properties are implemented, add proper Strengths
		parent::__construct(Strength::NORMAL, Strength::NORMAL);
		$this->physiology = $physiology;
		$this->medicine = $medicine;
		$this->ecology = $ecology;
	}

	/**
	 * @return string
	 */
	public function getPhysiology() {
		return $this->physiology;
	}

	/**
	 * @return string
	 */
	public function getMedicine() {
		return $this->medicine;
	}

	/**
	 * @return string
	 */
	public function getEcology() {
		return $this->ecology;
	}
}