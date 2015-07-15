<?php
/**
 * Creator: Ivo Stefanov
 * Modifier: Ivo Stefanov
 * Date: 16-07-2015
 * Time: 00:00
 * Type: Value Object
 */
namespace Universe\Science\Physical;
use Strength;

class Chemistry extends Physics {
	/**
	 * TODO: Change to Materials object
	 * @var string
	 */
	private $materials;

	/**
	 * TODO: Change to Reactions object
	 * @var string
	 */
	private $reactions;

	/**
	 * Chemistry constructor.
	 * @param string $materials
	 * @param string $reactions
	 */
	public function __construct($materials, $reactions) {
		// TODO: When the for the properties are implemented, add proper Strengths
		parent::__construct(Strength::NORMAL, Strength::NORMAL);
		$this->materials = $materials;
		$this->reactions = $reactions;
	}

	/**
	 * @return string
	 */
	public function getMaterials() {
		return $this->materials;
	}

	/**
	 * @return string
	 */
	public function getReactions() {
		return $this->reactions;
	}
}