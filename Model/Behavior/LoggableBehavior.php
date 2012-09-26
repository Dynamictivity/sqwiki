<?php
class LoggableBehavior extends ModelBehavior {

	public function afterSave(Model $Model, $created) {
		$logData = array(
			'user_id' => AuthComponent::user('id'),
			'ip_address' => $Model->data[$Model->alias]['ip_address'] = $_SERVER['SERVER_ADDR'],
			'action' => ($created ? 'created' : 'updated'),
			'model' => $Model->alias,
			'record_id' => $Model->id
		);
		$Log = ClassRegistry::init('Log');
		$Log->create();
		$Log->save($logData);
	}

	public function beforeDelete(Model $Model) {
		$logData = array(
			'user_id' => AuthComponent::user('id'),
			'ip_address' => $Model->data[$Model->alias]['ip_address'] = $_SERVER['SERVER_ADDR'],
			'action' => 'deleted',
			'model' => $Model->alias,
			'record_id' => $Model->id
		);
		$Log = ClassRegistry::init('Log');
		$Log->create();
		$Log->save($logData);
	}

}
