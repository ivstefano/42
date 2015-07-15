<?php
/**
 * Creator: Ivo Stefanov
 * Modifier: Ivo Stefanov
 * Date: 16-07-2015
 * Time: 00:00
 * Type: Value Object
 */
namespace Universe\Science\Formal;
use Strength;

class Mathematics extends Logic {
	/**
	 * TODO: Change to Statistics object
	 * @var string
	 */
	private $statistics;

	/**
	 * TODO: Change to ComputerScience object
	 * @var string
	 */
	private $computerScience;

	/**
	 * Mathematics constructor.
	 * @param string $statistics
	 * @param string $computerScience
	 */
	public function __construct($statistics, $computerScience) {
		// TODO: When the for the properties are implemented, add proper Strengths
		parent::__construct(Strength::NORMAL, Strength::NORMAL);
		$this->statistics = $statistics;
		$this->computerScience = $computerScience;
	}

	/**
	 * @return string
	 */
	public function getStatistics() {
		return $this->statistics;
	}

	/**
	 * @return string
	 */
	public function getComputerScience() {
		return $this->computerScience;
	}
}