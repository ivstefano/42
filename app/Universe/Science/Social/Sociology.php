<?php
/**
 * Creator: Ivo Stefanov
 * Modifier: Ivo Stefanov
 * Date: 16-07-2015
 * Time: 00:00
 * Type: Value Object
 */
namespace Universe\Science\Social;
use Strength;

class Sociology extends Psychology {
	/**
	 * TODO: Change to Law object
	 * @var string
	 */
	private $law;

	/**
	 * TODO: Change to Ethics object
	 * @var string
	 */
	private $ethics;

	/**
	 * TODO: Change to Economics object
	 * @var string
	 */
	private $economics;

	/**
	 * Sociology constructor.
	 * @param string $law
	 * @param string $ethics
	 * @param string $economics
	 */
	public function __construct($law, $ethics, $economics) {
		// TODO: When the for the properties are implemented, add proper Strengths
		parent::__construct(Strength::NORMAL, Strength::NORMAL);
		$this->law = $law;
		$this->ethics = $ethics;
		$this->economics = $economics;
	}

	/**
	 * @return string
	 */
	public function getLaw() {
		return $this->law;
	}

	/**
	 * @return string
	 */
	public function getEthics() {
		return $this->ethics;
	}

	/**
	 * @return string
	 */
	public function getEconomics() {
		return $this->economics;
	}
}