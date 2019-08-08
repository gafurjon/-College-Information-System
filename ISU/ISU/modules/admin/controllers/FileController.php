<?php

namespace app\modules\admin\controllers;

use app\models\User;
use app\models\Users;
use app\modules\admin\models\File;
use app\modules\admin\models\Teachers;
use Yii;
use yii\web\UploadedFile;

class FileController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $session=\Yii::$app->session;
        $session['tmp']='1';


        $teachers = Teachers::find()->joinWith('person')->asArray()->
        orderBy(['surname' => SORT_ASC, 'name' => SORT_ASC, 'middle_name' => SORT_ASC])->
        all();

        $users = Users::find()->asArray()->indexBy('user_id')->all();

        $model = new File();
        if (Yii::$app->request->post()) {

            if ($model->load(Yii::$app->request->post())) {


                $model->file = UploadedFile::getInstance($model, 'file');

                $post = Yii::$app->request->post('File');

                if ($model->file) {
                    $dir = 'files/';
                    $path = $model->file->baseName . '.' . $model->file->extension;
                    $model->file->saveAs($dir . md5($path) . "." . $model->file->extension);
                    $model->file = $dir . md5($path) . "." . $model->file->extension;
                }
                $model->text = $post['text'];
                $model->name = $post['name'];
                $model->id_teacher = Yii::$app->request->post('teacher');
                $model->user_id = Yii::$app->request->post('status');
                $model->date = date('Y-m-d');
                $model->id_person=Yii::$app->user->id;
                $model->status=1;
                $model->save();


            }
            $model->save();
            if ($model->save()) {
                $save = 1;
            }
        }

        return $this->render('index', compact('model', 'save', 'users', 'teachers'));

    }


    public function actionMyfile(){
        $user = User::gettmp();

        $myfile=File::find()->joinWith('user')->where(['file.user_id'=> $user['user_id']])->
        joinWith('teacher.person')->all();

        $personsave=File::find()->joinWith('personsave')->all();

		//echo $user['user_id'];
        //debug($personsave);
        return $this->render('myfile', compact('myfile','personsave'));
    }

}