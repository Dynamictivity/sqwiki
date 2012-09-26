<?php
class ArticleBehavior extends ModelBehavior {

	public function beforeValidate(Model $Model) {
		$Model->data[$Model->alias]['title'] = ucwords($Model->data[$Model->alias]['title']);
		$Model->data[$Model->ArticleRevision->alias][0]['is_current'] = true;
		$duplicateCount = $Model->ArticleRevision->find('count',
			array(
				'conditions' => array(
					'summary' => $Model->data[$Model->ArticleRevision->alias][0]['summary'],
					'content' => $Model->data[$Model->ArticleRevision->alias][0]['content'],
				)
			)
		);
		if ($duplicateCount < 1) {
			return true;
		}
		return false;
	}

}
