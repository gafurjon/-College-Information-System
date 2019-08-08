<?php

namespace app\modules\bakaydgiri\controllers;

use app\modules\admin\models\Kafedra;
use app\modules\admin\models\LessonCategory;
use app\modules\admin\models\Profession;
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
       //debug(\Yii::$app->request->post());
//        exit;

        
        if (!empty(\Yii::$app->request->post())) {

            

            $lesson= new lesson();

            $lesson->name=\Yii::$app->request->post('name');
            $lesson-> save();

            $lesson_sv = Yii::$app->db->createCommand('SELECT max(id_lesson) FROM `lesson`')->queryOne();

            

             $lesson_sv['max(id_lesson)'];

            


		$model= new Lessons();
            $model->id_profession = \Yii::$app->request->post('profession');
            $model->id_kafedra = \Yii::$app->request->post('kafedra');
            $model->category_id = \Yii::$app->request->post('kategoriya');
            $model->id_lesson = $lesson_sv['max(id_lesson)'];
            $model->lesson_kredit = \Yii::$app->request->post('kredit');
            $model->year=date(Y);
            $model->smestr = \Yii::$app->request->post('smestr');
            $model->code_lessons=\Yii::$app->request->post('code_lesson');
            $model->save();
        
		if ($model->save()) {
            $save = 1;
        }
		}
        


        return $this->render('index', compact('model','profession','categoriya','kafedra','save'));
    }

}
