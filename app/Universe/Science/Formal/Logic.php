<?php
/**
 * Creator: Ivo Stefanov
 * Modifier: Ivo Stefanov
 * Date: 16-07-2015
 * Time: 00:00
 * Type: Value Object
 */
namespace Universe\Science\Formal;

class Logic {
	/**
	 * TODO: Change to Reasoning object
	 * @var string
	 */
	private $reasoning;

	/**
	 * TODO: Change to Philosophy object
	 * @var string
	 */
	private $philosophy;

	/**
	 * Logic constructor.
	 * @param string $reasoning
	 * @param string $philosophy
	 */
	public function __construct($reasoning, $philosophy) {
		$this->reasoning = $reasoning;
		$this->philosophy = $philosophy;
	}

	/**
	 * @return string
	 */
	public function getReasoning() {
		return $this->reasoning;
	}

	/**
	 * @return string
	 */
	public function getPhilosophy() {
		return $this->philosophy;
	}
}