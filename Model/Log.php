<?php
App::uses('AppModel', 'Model');
/**
 * Log Model
 *
 * @property User $User
 * @property Record $Record
 */
class Log extends AppModel {

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
		'ip_address' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
			),
		),
		'model' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
			),
		),
		'action' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
			),
		),
		'record_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Record' => array(
			'className' => 'Record',
			'foreignKey' => 'record_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
