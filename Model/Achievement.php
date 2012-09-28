<?php
App::uses('AppModel', 'Model');
/**
 * Achievement Model
 *
 */
class Achievement extends AppModel {

	public $actsAs = array('Loggable');

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'user_field' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'user_field_count' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
	);
}
