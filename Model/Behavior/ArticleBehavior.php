<?php
class ArticleBehavior extends ModelBehavior {

	public function beforeValidate(Model $Model) {
		$Model->data[$Model->alias]['title'] = ucwords($Model->data[$Model->alias]['title']);
		if (!$Model->id && empty($Model->data[$Model->alias]['id'])) {
			$Model->data[$Model->alias]['is_active'] = true;
			$Model->data[$Model->ArticleRevision->alias][0]['is_active'] = true;
		}
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
