<?php

namespace app\modules\teacher\controllers;

use app\models\User;
use app\models\Users;
use app\modules\admin\models\File;
use app\modules\admin\models\Teachers;
use Yii;
use yii\data\Sort;
use yii\helpers\Url;
use yii\web\Response;
use yii\web\UploadedFile;

class FileController extends \yii\web\Controller
{
    public function actionIndex()
    {
		 $session=\Yii::$app->session;
        $session['tmp']='2';
		
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
		
		$user_id=Yii::$app->user->identity['user_id'];
		
		if($user_id <> 2){
		$user_id=2;
		
		}
		else $user_id=Yii::$app->user->identity['user_id'];
		
		
//        $myfile=File::find()->joinWith('user')->where('file.id_teacher='.Yii::$app->session['id_teacher'].' OR file.id_teacher=0 AND file.`user_id`='.$user_id.' OR file.`user_id`=0')->
//        joinWith('teacher.person')->joinWith('personsave')->orderBy(['file.date'=>SORT_DESC])->all();

        $personsave=File::find()->where('file.id_teacher='.Yii::$app->session['id_teacher'].' OR file.id_teacher=0 AND file.`user_id`='.$user_id.' OR file.`user_id`=0')->joinWith('personsave')->all();

       return $this->render('myfile', compact('myfile','personsave'));
    }
	
	
	
	public function actionStatus(){

       $id_file=Yii::$app->request->get('id_file');

        if($id_file > 0 ){

            $model=File::find()->where(['id_file'=>$id_file])->one();
            $model->status=0;
            $model->save();

           return $this->redirect(['index']);

            //echo Url::toRoute('file/index');

        }

       }

}