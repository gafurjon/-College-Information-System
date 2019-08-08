<?php

namespace app\modules\bakaydgiri\controllers;

use app\modules\admin\models\Teachers;

class insert_teacher_lessonsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $teachers_persons=Teachers::find()->joinWith('persons')->all();
        debug($teachers_persons);
        exit;
        return $this->render('index');
    }

}
