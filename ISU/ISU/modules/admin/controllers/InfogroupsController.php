<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\GroupStudents;

class InfogroupsController extends \yii\web\Controller
{
    public function actionIndex(){

         $model = new GroupStudents();

         $data = GroupStudents::getId_group();

//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';
         return $this->render('index', compact('data', 'model'));
     }

}
