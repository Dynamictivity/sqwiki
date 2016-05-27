<?php
App::uses('AppModel', 'Model');

/**
 * Achievement Model
 *
 */
class Achievement extends AppModel
{

    public $actsAs = array('Loggable');

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'name' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Name must not be empty.'
            ),
            'isUnique' => array(
                'rule' => array('isUnique'),
                'message' => 'Name must be unique.'
            ),
        ),
        'user_field' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'User Field must not be empty.'
            ),
        ),
        'user_field_count' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'User Field Count must not be empty.'
            ),
        ),
    );
}
