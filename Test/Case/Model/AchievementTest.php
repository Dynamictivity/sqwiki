<?php
App::uses('Achievement', 'Model');

/**
 * Achievement Test Case
 *
 */
class AchievementTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.achievement'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Achievement = ClassRegistry::init('Achievement');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Achievement);

		parent::tearDown();
	}

}
