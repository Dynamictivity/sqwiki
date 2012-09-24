<?php
class OwnableBehavior extends ModelBehavior {

	public function beforeSave(Model $Model) {
		if (empty($Model->data[$Model->alias]['user_id'])) {
			$Model->data[$Model->alias]['user_id'] = AuthComponent::user('id');
		}
	}

}
