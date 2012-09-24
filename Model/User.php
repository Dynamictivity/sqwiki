<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Role $Role
 * @property ArticleRevisionReview $ArticleRevisionReview
 * @property ArticleRevision $ArticleRevision
 * @property Article $Article
 * @property Comment $Comment
 */
class User extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'ip_address' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'role_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
	public $displayField = 'username';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Role' => array(
			'className' => 'Role',
			'foreignKey' => 'role_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ArticleRevisionReview' => array(
			'className' => 'ArticleRevisionReview',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ArticleRevision' => array(
			'className' => 'ArticleRevision',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Article' => array(
			'className' => 'Article',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	public function beforeSave() {
		if (empty($this->data['User']['id'])) {
			$this->data['User']['token'] = String::uuid();
		}
		if (!empty($this->data['User']['new_password'])) {
			if ($this->data['User']['new_password'] !== $this->data['User']['confirm_password']) {
				return;
			}
			$this->data['User']['password'] = $this->data['User']['new_password'];
			unset($this->data['User']['new_password']);
			unset($this->data['User']['confirm_password']);
		}
		if (!empty($this->data['User']['password'])) {
			$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		}
		return true;
	}
	
	public function saveNewUser($newUser, $returnExistingUser = true) {
		if (empty($newUser['User'])) {
			$newUser['User'] = $user;
		}
		$existingUser = $this->findByEmail($newUser['User']['email']);
		if (!empty($existingUser['User']['email'])) {
			if ($returnExistingUser) {
				return $existingUser;
			}
			return false;
		}
		if (empty($newUser['User']['role_id'])) {
			$newUser['User']['role_id'] = 3;
		}
		$this->create();
		$this->save($newUser);
		$newAccount = $this->findById($this->id);
		if (empty($newAccount)) {
			return false;
		}
		return $newAccount;
	}

}
