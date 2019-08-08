<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\GroupStudents;
use app\modules\admin\models\LessonGroup;
use app\modules\admin\models\Lessons;
use app\modules\admin\models\LessonsTable;
use app\modules\admin\models\Lesson;
use app\modules\admin\models\Settings;
use app\modules\admin\models\ExamList;
use app\modules\admin\models\ListVedemost;
use Yii;

use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\Html;

class PrintController extends \yii\web\Controller
{
    public function actionIndex()
    {

         $model = new GroupStudents();
         $data = GroupStudents::getId_group();

         sort($data);

         // $group=ExamList::find()->joinWith('students.person')->all();
         // //asort( $group);
            
         //    debug($group);
         //    exit;


        return $this->render('index', compact('data', 'model','group'));
    } //Shud

    



     public function actionAbc($id_group){

        $groups = GroupStudents::find()->where(['id_group' => $id_group])->joinWith('profession')->all();
        
        // debug($groups);
        // exit;

       if(!empty($groups )){
        $model = new Lesson();
        $lessons = Lesson::getlesson($groups['0']['id_group'], $groups['0']['course']);

            // debug($lessons);
        //sort($lessons);
            // exit;

        echo ' <div id="select_lesson">
                <div class="input-group">
                     <span class="input-group-addon">
                        <i class="ace-icon fa fa-check"> Фанро интихоб намоед</i>
                     </span>';

                      if($id_group==''){

                     echo '<select class="form-control"  name="lesson" id="form-field-select-1"  disabled="disabled">';

                      } else {
                     echo '<select class="form-control"  name="lesson" id="form-field-select-1" onchange = "$.get("index.php?r=admin/print/index&id_lesson="+$(this).val(), function(data){$("#select_lesson").html(data);})">';  }

                       echo ' <option value="">Фанро интихоб намоед...</option>';

                       foreach ($lessons as $lesson) {


                        echo '<option value="'.$lesson['id_lesson'].'">'.$lesson['name'].'</option>';
                       }

                        


                       
                                                                
                   echo '</select>
                </div></div><br>';

    }
    
}


            public function actionVedemost(){

                $this->layout = false;

                

                $id_table=LessonsTable::find()->where(['id_group' => Yii::$app->request->post('groups'), 
                    'id_lesson'=>Yii::$app->request->post('lesson')])->all();
                 $id_tables=$id_table['0']['id_table'];

                $ExamList=ExamList::find()->where(['id_table' => $id_tables])->all();




                if(empty($ExamList)){ 
                    $save=2;
                }

                elseif(!empty($ExamList)){

                    $i=0; $save=0;
                    foreach ($ExamList as $list) {
                       
                       $ListVedemost=ListVedemost::find()->where(['id_list' => $ExamList[$i]['id_list']])->all();
                       $setting=Settings::find()->all();


                       // debug($setting);
                       // echo $setting['0']['studies_year'];
                       // exit;

                       if(empty($ListVedemost)){

                            $model= new ListVedemost();

                        $model->id_list=$ExamList[$i]['id_list'];
                        $model->id_group=Yii::$app->request->post('groups');
                        $model->studies_year=$setting['0']['studies_year'];
                        $model->kushish=Yii::$app->request->post('kushish');
                        $model->date=Yii::$app->request->post('date');
                        $model->vedomost_number=Yii::$app->request->post('vedomost');
                        $model->bakaydgiri_FIO=Yii::$app->request->post('bakaydgiri_FIO');
                        $model->mtesti_FIO=Yii::$app->request->post('testi_FIO');
                        $model->save();

                            $i++;
                            $save=1;

                        }

                        else {

                            // /echo $id_tables;  
                            $group=ExamList::getvedemost($id_tables);  

                            if(empty($group)){
                                $save=2;


                            }
                            $vedemosttitle=ExamList::getvedemosttitle($id_tables);  

                            // debug($vedemosttitle);
                            // exit;
                        }

                    }
                }   

                

                    return $this->render('vedemost', compact('ListVedemost', 'model','group','vedemosttitle','save'));
                }






            



    

        
    

}
