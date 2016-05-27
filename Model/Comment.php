<?php
App::uses('AppModel', 'Model');

/**
 * Comment Model
 *
 * @property User $User
 * @property Article $Article
 */
class Comment extends AppModel
{

    public $actsAs = array('Ownable', 'Loggable');

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'comment' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Comment must not be empty.'
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
