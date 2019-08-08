<?php

namespace app\modules\dekanifakultet\controllers;

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
        $session['tmp']='8';
        $session['id_kafedra']=Teachers::getIdkafedra(\Yii::$app->user->id);

        $arizaho=Ariza::find()->joinWith('teacher.person')->
        joinWith('lesson')->where('ariza.status=1 and ariza.tasdiq=2')->asArray()->all();

        //debug($arizaho);
        return $this->render('index', compact('arizaho','session'));

    }

    public function actionSelect_ariza(){

        $id_ariza=Yii::$app->request->get('id');
        if($id_ariza > 0){
            $ariza=Ariza::find()->joinWith('teacher.person')->
            joinWith('lesson')->where(['ariza.id_ariza'=>$id_ariza, 'ariza.tasdiq'=>2,
                'ariza.status'=>1])->all();
           //debug($ariza);
           return $this->render('select_ariza', compact('ariza'));
        }
    }

    public function actionSave(){

        $id = Yii::$app->request->post('id_ariza');

        if($id > 0){

            $model = Ariza::find()->where('id_ariza='.$id)->one();
            $model->tasdiq=3;
            $model->status=1;
            $model->user_id=5;
            $model->save();

            return $this->redirect(['index']);
        }
    }

}
