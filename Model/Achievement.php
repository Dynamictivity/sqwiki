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
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Name must not be empty.'
            ),
            'isUnique' => array(
                'rule' => array('isUnique'),
                'message' => 'Name must be unique.'
            ),
        ),
        'user_field' => array(
            'notempty' => array(
                'rule' => array('notempty'),
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
