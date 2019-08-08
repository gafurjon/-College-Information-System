<?php

namespace app\modules\mudir\controllers;

use app\modules\admin\models\Ariza;
use app\modules\admin\models\Persons;
use app\modules\admin\models\Users;
use app\modules\teacher\models\Teachers;
use Yii;

class ArizaController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $session=\Yii::$app->session;
        $session['tmp']='6';
        $session['id_kafedra']=Teachers::getIdkafedra(\Yii::$app->user->id);

        $arizaho=Ariza::find()->joinWith('teacher.person')->
        joinWith('lesson')->where('ariza.status=1 and ariza.tasdiq=1')->asArray()->all();

        return $this->render('index', compact('arizaho','session'));

    }

    public function actionSelect_ariza(){

        $id_ariza=Yii::$app->request->get('id');
        if($id_ariza > 0){
            $ariza=Ariza::find()->joinWith('teacher.person')->
            joinWith('lesson')->where(['ariza.id_ariza'=>$id_ariza, 'ariza.tasdiq'=>1,
                'ariza.status'=>1])->all();
           //debug($ariza);
           return $this->render('select_ariza', compact('ariza'));
        }
    }

    public function actionSave(){

        $id = Yii::$app->request->post('id_ariza');

        if($id > 0){

            $model = Ariza::find()->where('id_ariza='.$id)->one();
            $model->tasdiq=2;
            $model->status=1;
            $model->user_id=8;
            $model->save();

            return $this->redirect(['index']);
        }
    }

}
