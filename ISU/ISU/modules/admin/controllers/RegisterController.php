<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Teachers;
use app\modules\admin\models\TeachersDay;

use Yii;

class RegisterController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $max_id = TeachersDay::find()->
        where(['date' => date('Y-m-d'), 'id_teacher' => Yii::$app->request->get('id')])->max('id_teacher_day');

        $model = TeachersDay::find()->
        where(['date' => date('Y-m-d'), 'id_teacher' => Yii::$app->request->get('id'), 'id_teacher_day' => $max_id])->one();


        if (!empty(Yii::$app->request->get()) && Yii::$app->request->get('oper') == 'in') {

            $teachers_day = new TeachersDay();

            if (!$model) {

                $teachers_day->id_teacher = Yii::$app->request->get('id');
                $teachers_day->date = date('Y-m-d');
                $teachers_day->time_in = date('H:i:s');
                $teachers_day->time_out = date('H:i:s');
                $teachers_day->count = 1;
                $teachers_day->save();
            }
        }

        if (!empty(Yii::$app->request->get()) && Yii::$app->request->get('oper') == 'out') {
            if ($model == true) {

                $model->time_out = date('H:i:s');
                $model->count = 2;
                $model->save();

            }
        }

        if ($model['count'] == 2) {

            if (!empty(Yii::$app->request->get()) && Yii::$app->request->get('oper') == 'in') {

                $teachers_day = new TeachersDay();

                $teachers_day->id_teacher = Yii::$app->request->get('id');
                $teachers_day->date = date('Y-m-d');
                $teachers_day->time_in = date('H:i:s');
                $teachers_day->time_out = date('H:i:s');
                $teachers_day->count = 1;
                $teachers_day->save();
            }
        }

        if ($model['count'] == 1) {
            if (!empty(Yii::$app->request->get()) && Yii::$app->request->get('oper') == 'out') {

                $model->time_out = date('H:i:s');
                $model->count = 2;
                $model->save();
            }
        }

        $data = Teachers::find()
            ->joinWith('person')
            ->orderBy(['surname' => SORT_ASC])
            ->all();
        return $this->render('register', compact('data', 'teachers_day'));
    }//Шудаги 100%

}
