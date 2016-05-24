<?php

class OwnableBehavior extends ModelBehavior
{

    public function beforeValidate(Model $Model, $options= array())
    {
        $userId = 1;
        if (AuthComponent::user('id')) {
            $userId = AuthComponent::user('id');
        }
        if (!$Model->id && empty($Model->data[$Model->alias]['user_id'])) {
            $Model->data[$Model->alias]['user_id'] = $userId;
        }
        if (!$Model->id && empty($Model->data[$Model->alias]['ip_address'])) {
            $Model->data[$Model->alias]['ip_address'] = $_SERVER['SERVER_ADDR'];;
        }
    }

}
