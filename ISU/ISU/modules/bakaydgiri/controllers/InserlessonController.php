<?php

namespace app\modules\bakaydgiri\controllers;

use app\modules\admin\models\Kafedra;
use app\modules\admin\models\LessonCategory;
use app\modules\admin\models\Profession;
use app\modules\admin\models\Settings;
use app\modules\bakaydgiri\models\Lessons;
use app\modules\bakaydgiri\models\Lesson;
use Yii;


class InserlessonController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $profession= Profession::find()->asArray()->all();
        $categoriya= LessonCategory::find()->asArray()-> all();
        $kafedra = Kafedra::find()->asArray()->all();

        $lesson=Lesson::getLesname();
        //$settings=Settings::find()->all();


       // debug($settings);
       // exit;

        
        if (!empty(\Yii::$app->request->post())) {

            

            // $lesson= new lesson();
            // $lesson->name=\Yii::$app->request->post('name');
            // $lesson-> save();
            // $lesson_sv = Yii::$app->db->createCommand('SELECT max(id_lesson) FROM `lesson`')->queryOne();       
           //  $lesson_sv['max(id_lesson)'];
            // debug(\Yii::$app->request->post());
            // exit;
            


		$model= new Lessons();

        $stadies_year=Settings::find()->all();
        
            $model->id_profession = \Yii::$app->request->post('profession');
            $model->id_kafedra = \Yii::$app->request->post('kafedra');
            $model->category_id = \Yii::$app->request->post('kategoriya');
            $model->id_lesson = \Yii::$app->request->post('name');
            $model->lesson_kredit = \Yii::$app->request->post('kredit');
            $model->studies_year=$stadies_year['0']['studies_year'];
            $model->smestr = \Yii::$app->request->post('smestr');
            $model->code_lessons=\Yii::$app->request->post('code_lesson');
            $model->kmd=\Yii::$app->request->post('kmd');
            $model->save();
        
		if ($model->save()) {
            $save = 1;
        }
		}
        


        return $this->render('index', compact('model','profession','categoriya','kafedra','save','lesson'));
    }

}
