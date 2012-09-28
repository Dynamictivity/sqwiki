<?php
class OwnableBehavior extends ModelBehavior {

	public function beforeValidate(Model $Model) {
		if (!$Model->id && empty($Model->data[$Model->alias]['user_id'])) {
			$Model->data[$Model->alias]['user_id'] = AuthComponent::user('id');
		}
		if (!$Model->id && empty($Model->data[$Model->alias]['ip_address'])) {
			$Model->data[$Model->alias]['ip_address'] = $_SERVER['SERVER_ADDR'];;
		}
	}

}
