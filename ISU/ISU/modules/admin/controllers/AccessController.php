<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Users;
use \yii\web\Controller;

class AccessController extends Controller
{
    public function actionIndex()
    {
        $status = Users::find()->joinWith('persons')->joinWith('menu')->asArray()->
        indexBy('user_id')->all();
        $user = Users::find()->all();


        return $this->render('index', compact('status', 'user'));
    }



}
