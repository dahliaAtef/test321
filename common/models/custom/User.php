<?php

namespace common\models\custom;

class User extends \common\models\base\User {


    public function getName(){
        return $this->username;
    }

    public function getAuthclient()
    {
        return $this->hasMany(Authclient::className(), ['user_id' => 'id']);
    }
}
