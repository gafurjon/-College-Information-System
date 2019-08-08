<?php

namespace app\modules\admin\controllers;
use app\modules\admin\models\Persons;
use Yii;

class ScurityController extends \yii\web\Controller
{
    public function actionIndex()
    {

		$login=\Yii::$app->request->post('login');
        $new_password=\Yii::$app->request->post('new_password');
        $double_new_password=\Yii::$app->request->post('new_password_double');

        $model = new Persons();
        
        if(!empty(\Yii::$app->request->post())){
        	$persons=Persons::find()->where(['login'=>$login])->all();

        // debug( $persons);
        // exit;
        }
        
        

        
        if(empty($login)){
            $save = 3;
            return $this->render('index',compact('model','save'));
        }

        foreach ($persons as $persons){

            $parol_universal='$2y$13$nRS7XcSPNa.h6ww7oX/pp.avORnug2MzHxivU27SqTPpOE059Ov5C';
            if($persons['login']==true){

                if($new_password==$double_new_password){

                
                    $persons->password= \Yii::$app->getSecurity()->generatePasswordHash($double_new_password);
                    $persons->save();

                    if ($persons->save()) {
                        $save = 1;
                    }

                }
                else
                {
                    $save = 2;
                }
            }

        }
        return $this->render('index',compact('model','save'));
    }



    

}
