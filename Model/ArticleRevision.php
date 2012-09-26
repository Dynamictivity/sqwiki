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
			'foreignKey' => 'reviewed_by_user_id',
			'counterCache' => true
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'counterCache' => true
		)
	);

	public function afterSave($created) {
		if ($created) {
			$this->updateAll(array($this->alias . '.is_current' => false), array($this->alias . '.article_id' => $this->data[$this->alias]['article_id'], $this->alias . '.id <>' => $this->id));
		}
	}

}
