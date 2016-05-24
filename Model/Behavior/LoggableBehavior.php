<?php

class LoggableBehavior extends ModelBehavior
{

    public function afterSave(Model $Model, $created, $options= array())
    {
        $userId = 1;
        if (AuthComponent::user('id')) {
            $userId = AuthComponent::user('id');
        }
        $logData = array(
            'user_id' => $userId,
            'ip_address' => $Model->data[$Model->alias]['ip_address'] = $_SERVER['REMOTE_ADDR'],
            'action' => ($created ? 'created' : 'updated'),
            'model' => $Model->alias,
            'record_id' => $Model->id
        );
        $Log = ClassRegistry::init('Log');
        $Log->create();
        $Log->save($logData);
    }

    public function beforeDelete(Model $Model, $cascade = true)
    {
        $userId = 1;
        if (AuthComponent::user('id')) {
            $userId = AuthComponent::user('id');
        }
        $logData = array(
            'user_id' => $userId,
            'ip_address' => $Model->data[$Model->alias]['ip_address'] = $_SERVER['REMOTE_ADDR'],
            'action' => 'deleted',
            'model' => $Model->alias,
            'record_id' => $Model->id
        );
        $Log = ClassRegistry::init('Log');
        $Log->create();
        $Log->save($logData);
    }

}
