<?php

namespace app\modules\director\controllers;

use app\modules\admin\models\Ariza;
use yii\web\Controller;
use app\modules\admin\models\GroupStudents;
use app\modules\admin\models\Teachers;
use app\models\User;
use app\modules\admin\models\News;
use app\modules\admin\models\LessonCategory;
use app\modules\admin\models\Students;
use app\modules\admin\models\Kafedra;
use app\modules\admin\models\Week;
use app\modules\admin\models\TimeLesson;
use app\modules\admin\models\LessonTime;
use app\modules\admin\models\lessonsTable;
use Yii;


/**
 * Default controller for the `Director` module
 */


class DefaultController extends Controller
{
   

    public function actionIndex()
    {
        $user = User::find()->where('id_persons='.\Yii::$app->user->id)->one();
        $session=\Yii::$app->session;
        $session['tmp']='4';
        $session['is_online']=\Yii::$app->db->createCommand('UPDATE persons SET is_online=1 WHERE id_persons='.\Yii::$app->user->id)
            ->execute();

        $news=News::find()->where(['user_id'=>$user['user_id']])->asArray()->all();


        return $this->render('index', compact('news'));
    }





    public function actionShow()
    {

        $teacher=Teachers::find()
            ->joinWith('person')
            ->joinWith('teacher')
            ->where(['date' => date('Y-m-d') ])
            ->orderBy(['surname' => SORT_ASC,])
            ->all();

        return $this->render('teachers_day', compact('teacher'));
    }// Øóäàãè



    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
