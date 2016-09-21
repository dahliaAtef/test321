<?php

namespace backend\controllers;

class UsersController extends base\UsersController {
    public $model = '\common\models\custom\User';
    public $searchModel = '\common\models\custom\search\User';
}
