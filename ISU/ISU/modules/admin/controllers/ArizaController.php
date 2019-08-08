<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Ariza;
use app\modules\admin\models\Journal;
use app\modules\admin\models\Persons;
use app\modules\admin\models\Users;
use app\modules\teacher\models\Teachers;
use Yii;

class ArizaController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $session=\Yii::$app->session;
        $session['tmp']='1';
        $session['id_kafedra']=Teachers::getIdkafedra(\Yii::$app->user->id);

        $arizaho=Ariza::find()->joinWith('teacher.person')->
        joinWith('lesson')->where('ariza.status=1 and ariza.tasdiq=5')->asArray()->all();

        
        return $this->render('index', compact('arizaho','session'));

    }

    public function actionSelect_ariza(){

        $id_ariza=Yii::$app->request->get('id');
        if($id_ariza > 0){
            $ariza=Ariza::find()->joinWith('teacher.person')->
            joinWith('lesson')->where(['ariza.id_ariza'=>$id_ariza, 'ariza.tasdiq'=>5,
                'ariza.status'=>1])->all();
           //debug($ariza);
           return $this->render('select_ariza', compact('ariza'));
        }
    }

    public function actionSave(){

        $id = Yii::$app->request->post('id_ariza');

        if($id > 0){

            $model = Ariza::find()->where('id_ariza='.$id)->one();
			$new_mark=$model['mark_new'];
            $journal = Journal::find()->where("journal.id_students=98 and journal.date='2017-09-25' and journal.id_mark_type=3")->one();
            
			$journal->mark=$new_mark;
			$journal->save();
			
			

            return $this->redirect(['index']);
        }
    }

}
