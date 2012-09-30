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

	public $actsAs = array('Loggable');

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'email' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Email address is required.'
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'Email address already registered.'
			),
		),
	);
	
	public $displayField = 'username';

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Role' => array(
			'className' => 'Role',
			'foreignKey' => 'role_id',
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ArticleRevision' => array(
			'className' => 'ArticleRevision',
			'foreignKey' => 'user_id',
			'dependent' => false,
		),
		'Article' => array(
			'className' => 'Article',
			'foreignKey' => 'user_id',
			'dependent' => false,
		),
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'user_id',
			'dependent' => false,
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
