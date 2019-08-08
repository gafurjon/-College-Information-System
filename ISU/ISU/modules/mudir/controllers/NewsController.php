<?php

namespace app\modules\mudir\controllers;

use app\models\Users;
use app\modules\admin\models\News;
use app\modules\admin\models\Teachers;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;


class NewsController extends Controller
{
    public function actionIndex(){

        $teachers = Teachers::find()->joinWith('person')->asArray()->
        orderBy(['surname' => SORT_ASC, 'name' => SORT_ASC, 'middle_name' => SORT_ASC])->
        all();

        $users = Users::find()->asArray()->indexBy('user_id')->all();

        $model = new News();
        if(Yii::$app->request->post()){
            if( $model->load( Yii::$app->request->post() )){


                $model->picture = UploadedFile::getInstance($model,'picture');

                $post=Yii::$app->request->post('News');

                if($model->picture){
                    $dir = 'image/news/';
                    $path = $model->picture->baseName.'.'.$model->picture->extension;
                    $model->picture->saveAs($dir.md5($path).".".$model->picture->extension);
                    $model->picture=$dir.md5($path).".".$model->picture->extension;
                }
                $model->news = $post['news'];
                $model->name = $post['name'];
                $model->id_teacher=Yii::$app->request->post('teacher');
                $model->user_id=Yii::$app->request->post('status');
                $model->date=date('Y-m-d');
                $model->save();




            }
            $model->save();
            if($model->save()){
                $save = 1;
            }
        }


        return $this->render('index',compact('model','save','users','teachers'));
    }


}
