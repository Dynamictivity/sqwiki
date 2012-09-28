<?php
App::uses('AppModel', 'Model');
/**
 * ArticleRevision Model
 *
 * @property Article $Article
 * @property Revision $Revision
 * @property User $User
 * @property ArticleRevisionReview $ArticleRevisionReview
 */
class ArticleRevision extends AppModel {

	public $actsAs = array('Ownable', 'Loggable');

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'article_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'revision_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'summary' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'content' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Article' => array(
			'className' => 'Article',
			'foreignKey' => 'article_id',
			'counterCache' => true
		),
		'ReviewedByUser' => array(
			'className' => 'User',
			'foreignKey' => 'reviewed_by_user_id'
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'counterCache' => true
		)
	);

	public function approve($approved = true) {
		$articleRevisionData = array(
			'reviewed_by_user_id' => AuthComponent::user('id'),
			'is_active' => $approved
		);
		return $this->save($articleRevisionData);
	}

	public function getPreviousActiveRevision() {
		$currentArticleId = $this->field('article_id');
		$previousArticleRevision = $this->find('first',
			array(
				'conditions' => array(
					'ArticleRevision.article_id' => $currentArticleId,
					'ArticleRevision.is_active' => true,
					'ArticleRevision.id <' => $this->id
				),
				'order' => 'ArticleRevision.id DESC'
			)
		);
		return $previousArticleRevision;
	}

}
