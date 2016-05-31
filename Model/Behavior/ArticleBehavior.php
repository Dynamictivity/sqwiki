<?php

class ArticleBehavior extends ModelBehavior
{

    public function beforeValidate(Model $Model, $options= array())
    {
        $Model->data[$Model->alias]['title'] = ucwords($Model->data[$Model->alias]['title']);
        if (!$Model->id || empty($Model->data[$Model->ArticleRevision->alias][0]['is_active'])) {
            $Model->data[$Model->ArticleRevision->alias][0]['is_active'] = Configure::read('Sqwiki.auto_activate_pending_revisions');
        }
        $duplicateCount = $Model->ArticleRevision->find('count',
            array(
                'conditions' => array(
                    'summary' => $Model->data[$Model->ArticleRevision->alias][0]['summary'],
                    'content' => $Model->data[$Model->ArticleRevision->alias][0]['content'],
                )
            )
        );
        // Don't save duplicates
        if ($duplicateCount >= 1) {
            unset($Model->data[$Model->ArticleRevision->alias]);
        }
        return true;
    }

}
