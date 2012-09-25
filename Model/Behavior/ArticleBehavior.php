<?php
class ArticleBehavior extends ModelBehavior {

	public function beforeValidate(Model $Model) {
		$Model->data[$Model->alias]['title'] = ucwords($Model->data[$Model->alias]['title']);
		return true;
	}

}
