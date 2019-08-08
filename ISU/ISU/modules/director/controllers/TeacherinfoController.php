<?php

namespace app\modules\director\controllers;

use app\modules\admin\models\Teachers;

class TeacherinfoController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $teacher=Teachers::find()->asArray()->joinWith('person')->joinWith('kafedra.faculty')
            ->orderBy(['persons.surname' => SORT_ASC])
            ->all();



        return $this->render('index', compact('teacher'));
    } //Øóäàãè 50%

}
