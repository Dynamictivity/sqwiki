<?php
App::uses('AppModel', 'Model');
/**
 * Comment Model
 *
 * @property User $User
 * @property Article $Article
 */
class Comment extends AppModel {

	public $actsAs = array('Ownable', 'Loggable');

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'article_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'comment' => array(
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'counterCache' => true
		),
		'Article' => array(
			'className' => 'Article',
			'foreignKey' => 'article_id',
			'counterCache' => true
		)
	);
}
