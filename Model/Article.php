<?php
App::uses('AppModel', 'Model');

/**
 * Article Model
 *
 * @property User $User
 * @property ArticleRevision $ArticleRevision
 * @property Comment $Comment
 */
class Article extends AppModel
{

    public $actsAs = array('Containable', 'Article', 'Ownable', 'Sluggable' => array('slug_separator' => '_', 'lowercase' => false), 'Loggable');

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'title' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Title must not be empty.'
            ),
            'isUnique' => array(
                'rule' => array('isUnique'),
                'message' => 'Title must be unique.'
            ),
            /*
            'alphaNumeric' => array(
                'rule' => array('alphaNumeric'),
                'message' => 'Title must be alphanumeric.'
            )
             */
        ),
    );

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Role' => array(
            'className' => 'Role',
            'foreignKey' => 'role_id'
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'counterCache' => true
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
            'foreignKey' => 'article_id',
            'dependent' => true
        ),
        'Comment' => array(
            'className' => 'Comment',
            'foreignKey' => 'article_id',
            'dependent' => true
        )
    );

    public function getCurrentVersion($id, $options = array())
    {
        $options = array_merge(
            array(
                'merge' => true
            ),
            $options
        );
        $article = $this->find('first',
            array(
                'contain' => array(
                    'ArticleRevision' => array(
                        'conditions' => array(
                            'is_active' => true,
//                            'NOT' => array(
//                                'ArticleRevision.reviewed_by_user_id' => false
//                            )
                        ),
                        'order' => 'ArticleRevision.id DESC'
                    )
                ),
                'conditions' => array(
                    'Article.id' => $id
                )
            )
        );
        if (!empty($article['ArticleRevision'][0])) {
            if ($options['merge']) {
                $article['ArticleRevision'] = $article['ArticleRevision'][0];
            }
            return $article;
        }
        return false;
    }

}
