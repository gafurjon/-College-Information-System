<?php

namespace app\modules\students\controllers;

//use app\modules\admin\models\LessonsTable;
use app\modules\students\models\AnketaNatija;
use app\modules\students\models\AnketaSavol;
use app\modules\students\models\LessonsTable;

class AnketaController extends \yii\web\Controller
{
    public function actionIndex()
    {
	
        // $model=LessonsTable::find()->joinWith('teacher.person')->
        // joinWith('lesson')->where(['lessons_table.id_group'=>\Yii::$app->session['id_group']])->all();
        $model = LessonsTable::getlessons();
     // debug($model);
       return $this->render('index',compact('model'));
    }

    public function actionAnketa()
    {
        $AnketaNatija=AnketaNatija::find()->where(['id_lesson'=>\Yii::$app->request->post('id_lesson'),
            'id_teacher'=>\Yii::$app->request->post('id_teacher'),
            'id_students'=>\Yii::$app->session['id_students']])->all();

		if (!empty($AnketaNatija)) {
		$this->redirect('web/index.php?r=students/anketa/index');
	   }
        $id_lesson=\Yii::$app->request->post('id_lesson');
        $id_teacher=\Yii::$app->request->post('id_teacher');
        $fio=\Yii::$app->request->post('fio');
        $lesson=\Yii::$app->request->post('lesson_name');

        $model=AnketaSavol::find()->indexby('id_savol')->all();
		
      //debug($model);
	 
       return $this->render('anketa',compact('model','models','id_lesson','id_teacher','fio','lesson'));
		
	}

    public function actionSave()
    {
        
        // debug(\Yii::$app->request->post());
        
         $id_teacher=\Yii::$app->request->post('id_teacher');
         $id_lesson=\Yii::$app->request->post('id_lesson');

      
        
        for ($i=1; $i <=12 ; $i++) { 

           //echo \Yii::$app->request->post($i).'<br>';

        
        $models[$i]= New AnketaNatija();

        $models[$i]->id_teacher=$id_teacher;
        $models[$i]->id_lesson=$id_lesson;
        $models[$i]->id_students=\Yii::$app->session['id_students'];
        $models[$i]->id_savol=$i;

        //$models[$i]->javob_text='0'; 
        $models[$i]->javob_adad=\Yii::$app->request->post($i); 

             

        $models[$i]->save();

           

        }


        $this->redirect('web/index.php?r=students/anketa/index');
    }

}
