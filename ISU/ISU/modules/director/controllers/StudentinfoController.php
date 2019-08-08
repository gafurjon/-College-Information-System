<?php

namespace app\modules\director\controllers;

use app\modules\admin\models\Students;

class StudentinfoController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $students = Students::find()->joinWith('group')->joinWith('person')
            ->joinWith('group.faculty')
            ->joinWith('group.profession')
            ->orderBy(['profession' => SORT_DESC, 'surname' => SORT_ASC])
            ->all();


        return $this->render('index', compact('students'));
    }

    //Шудаги

}
