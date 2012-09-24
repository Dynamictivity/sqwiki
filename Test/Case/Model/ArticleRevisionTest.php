<?php
App::uses('ArticleRevision', 'Model');

/**
 * ArticleRevision Test Case
 *
 */
class ArticleRevisionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.article_revision',
		'app.article',
		'app.user',
		'app.comment',
		'app.revision',
		'app.article_revision_review'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ArticleRevision = ClassRegistry::init('ArticleRevision');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ArticleRevision);

		parent::tearDown();
	}

}
