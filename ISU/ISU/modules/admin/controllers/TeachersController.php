<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Teachers;

class TeachersController extends \yii\web\Controller
{
    public function actionTeachers()
    {

        $teacher = Teachers::find()->asArray()
        ->joinWith('person')
        ->orderBy(['persons.surname' => SORT_ASC])
            ->all();


        
//
        return $this->render('teachers', compact('teacher'));
    } //Шудаги 50%
}
