<?php
App::uses('ArticleRevisionReview', 'Model');

/**
 * ArticleRevisionReview Test Case
 *
 */
class ArticleRevisionReviewTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.article_revision_review',
		'app.article_revision',
		'app.article',
		'app.user',
		'app.comment',
		'app.revision'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ArticleRevisionReview = ClassRegistry::init('ArticleRevisionReview');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ArticleRevisionReview);

		parent::tearDown();
	}

}
