<?php

namespace app\modules\director\controllers;

use app\modules\admin\models\Ariza;
use app\modules\admin\models\Persons;
use app\modules\admin\models\Users;
use Yii;

class ArizaController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $session=\Yii::$app->session;
        $session['tmp']='4';

        $arizaho=Ariza::find()->joinWith('teacher.person')->
        joinWith('lesson')->where('ariza.status=1 and ariza.tasdiq >= 4')->indexBy('id_ariza')->all();


       //debug($arizaho);

        return $this->render('index', compact('arizaho'));

    }

    public function actionSelect_ariza(){

        $id_ariza=Yii::$app->request->get('id');
        if($id_ariza > 0){
            $ariza=Ariza::find()->joinWith('teacher.person')->
            joinWith('lesson')->where(['ariza.id_ariza'=>$id_ariza, 'ariza.tasdiq'=>4,
                'ariza.status'=>1])->all();
           //debug($ariza);
           return $this->render('select_ariza', compact('ariza'));
        }
    }

    public function actionSave(){

        $id = Yii::$app->request->post('id_ariza');

        if($id > 0){

            $model = Ariza::find()->where('id_ariza='.$id)->one();
            $model->tasdiq=5;
            $model->status=0;
            $model->user_id=0;
            $model->save();

            //return $this->render('index');
        }

        $arizaho=Ariza::find()->joinWith('teacher.person')->
        joinWith('lesson')->where('ariza.status=1 and ariza.tasdiq=4')->indexBy('id_ariza')->all();


        //debug($arizaho);

        return $this->render('index', compact('arizaho'));

    }

}
