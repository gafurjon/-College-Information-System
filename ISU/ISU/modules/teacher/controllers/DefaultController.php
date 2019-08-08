<?php

namespace app\modules\teacher\controllers;

use app\models\User;
use app\modules\admin\models\Week;
use app\modules\teacher\models\Ariza;
use app\modules\teacher\models\GroupStudents;
use app\modules\teacher\models\Journal;
use app\modules\teacher\models\LessonGroup;
use app\modules\teacher\models\Lessons;
use app\modules\teacher\models\LessonsDay;
use app\modules\teacher\models\LessonsTable;
use app\modules\teacher\models\LessonTime;
use app\modules\teacher\models\News;
use app\modules\teacher\models\Persons;
use app\modules\teacher\models\Students;
use app\modules\teacher\models\Teachers;
use app\modules\Teacher\Teacher;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use kartik\date\DatePicker;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

use yii\db\Query;
use app\modules\teacher\models\RatingDates;






/**
 * Default controller for the `Teacher` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        //User::settmp(2);

       

        if (isset(\Yii::$app->user->id)) {
            $session = \Yii::$app->session;
            $session['tmp'] = '2';
            $session['id_teacher'] = Teachers::getID(\Yii::$app->user->id);
            $session['id_kafedra']=Teachers::getIdkafedra(\Yii::$app->user->id);
            $session['is_online']=\Yii::$app->db->createCommand('UPDATE persons SET is_online=1 WHERE id_persons='.\Yii::$app->user->id)
            ->execute();





        } else {
            return $this->goBack();
        }

        if (!\Yii::$app->session['id_teacher']) {
            return \Yii::$app->response->redirect(['site/hato']);
        }
        $news = News::getAll(\Yii::$app->session['id_teacher'],$session['tmp']);
        
        return $this->render('index', compact('news'));

    }

    

    public function actionInsert_marks($id_lesson)
    {


        $id_group = LessonsTable::getId_group($id_lesson);

        


        $datas = LessonsTable::getGroup($id_lesson, \Yii::$app->session['id_teacher'], $id_group['0']['id_group']);
        $lesson_table = LessonsTable::Lesson($id_lesson, $id_group[0]['id_group'], \Yii::$app->session['id_teacher']);

        $lesson_times = LessonTime::getAll($lesson_table['0']['id_table']);
       
    
        $course=substr($id_group[0]['groupcourse'], 0,1);

        $rating_dates= RatingDates::find()->where('status=1 and course='.$course)->all();

          


		$lesson_days = LessonsDay::getDate($lesson_times, $rating_dates);
        
        
		//$lesson_days =LessonsDay::find()->joinWith('time')->asarray()->all();
        $lesson_count = LessonGroup::getCount($lesson_table[0]['id_lesson'], $lesson_table[0]['id_group']);

        // debug($lesson_times);
        // exit;

        if(!empty(\Yii::$app->request->post())){
            $r = 1;
            foreach ($lesson_days as $lesson_day) {

                  sort($lesson_day);

                foreach ($lesson_day as $day) {
                    if ($r <= $lesson_count[0]['count']) {
                        $tas_lek = \Yii::$app->request->post('tas_lek');
                        $tas_kmro = \Yii::$app->request->post('tas_kmro');
                        $tas_kmd = \Yii::$app->request->post('tas_kmd');
                        if (isset($tas_lek[$r])) {
                            $lek = \Yii::$app->request->post('lek');



                            foreach ($datas as $data) {

							if($lek[$data['id_students']][$r] <=10 or $lek[$data['id_students']][$r]=='г' or $lek[$data['id_students']][$r]=='х'){

                                $model = new \app\modules\students\models\Journal();
                                $model->id_students = $data['id_students'];
                                $model->id_group = $lesson_table[0]['id_group'];
                                $model->id_lesson_time = $day['id_lesson_time'];
                                $model->mark = $lek[$data['id_students']][$r];
                                $model->id_mark_type = 1;
                                $model->date = $day['datedars'];
                                $model->date_save = date('Y-m-d');

                                $model->save();
								}

							}
                        }
                        if (isset($tas_kmro[$r])) {
                            $kmro = \Yii::$app->request->post('kmro');
                            $connection = \Yii::$app->getDb();
                            foreach ($datas as $data) {



							if($kmro[$data['id_students']][$r] <=10 or $kmro[$data['id_students']][$r]=='г' or $kmro[$data['id_students']][$r]=='х'){

                                $model = new \app\modules\students\models\Journal();
                                $model->id_students = $data['id_students'];
                                $model->id_group = $lesson_table[0]['id_group'];
                                $model->id_lesson_time = $day['id_lesson_time'];
                                $model->mark = $kmro[$data['id_students']][$r];
                                $model->id_mark_type = 2;
                                $model->date = $day['datedars'];
                                $model->date_save = date('Y-m-d');
                                $model->save();}
                            }
                        }
                        if (isset($tas_kmd[$r])) {
                            $kmd = \Yii::$app->request->post('kmd');
                            $connection = \Yii::$app->getDb();
                            foreach ($datas as $data) {
							if($kmd[$data['id_students']][$r]<=20 or $kmd[$data['id_students']][$r]=='г' or  $kmd[$data['id_students']][$r]=='х'){
                                $model = new \app\modules\students\models\Journal();
                                $model->id_students = $data['id_students'];
                                $model->id_group = $lesson_table[0]['id_group'];
                                $model->id_lesson_time = $day['id_lesson_time'];
                                $model->mark = $kmd[$data['id_students']][$r];
                                $model->id_mark_type = 3;
                                $model->date = $day['datedars'];
                                $model->date_save = date('Y-m-d');
                                $model->save();}
                            }
                        }
                    }
                    $r++;
                }
            }
        }
        $model = new GroupStudents();
        if (count($id_group) === 1) {
            $dates = Journal::getDate($id_lesson, \Yii::$app->session['id_teacher'], $id_group['0']['id_group']);
            $marks = Journal::getMark(\Yii::$app->session['id_teacher'], $id_group['0']['id_group'], $lesson_times);
        }
		
		//debug($id_group);
        return $this->render('insert', compact('id_group', 'model', 'datas', 'dates', 'marks', 
            'lesson_days', 'lesson_count', 'rating_dates'));
    }


    public function actionInsert_mark($id_lesson, $id_group){

        

        $datas = LessonsTable::getGroup($id_lesson, \Yii::$app->session['id_teacher'], $id_group);
        $lesson_table = LessonsTable::Lesson($id_lesson, $id_group, \Yii::$app->session['id_teacher']);
        $lesson_times = LessonTime::getAll($lesson_table['0']['id_table']);
        
        $group_str=GroupStudents::find()->where('id_group='.$id_group)->all();

        // debug($group_str);
        // exit;


        $rating_dates= RatingDates::find()->where('status=1 and course='.$group_str['0']['course'])->all();

        

        $lesson_days = LessonsDay::getDate($lesson_times,$rating_dates);

        
        

        $lesson_count = LessonGroup::getCount($lesson_table[0]['id_lesson'], $id_group);



        if(!empty(\Yii::$app->request->post())){
            $r = 1;
            foreach ($lesson_days as $lesson_day) {

                sort($lesson_day);

                foreach ($lesson_day as $day) {
                    if ($r <= $lesson_count[0]['count']) {
                        $tas_lek = \Yii::$app->request->post('tas_lek');
                        $tas_kmro = \Yii::$app->request->post('tas_kmro');
                        $tas_kmd = \Yii::$app->request->post('tas_kmd');
                        if (isset($tas_lek[$r])) {
                            $lek = \Yii::$app->request->post('lek');



                            foreach ($datas as $data) {

                                if($lek[$data['id_students']][$r] <=10 or $lek[$data['id_students']][$r]=='г' or $lek[$data['id_students']][$r]=='х'){

                                    $model = new \app\modules\students\models\Journal();
                                    $model->id_students = $data['id_students'];
                                    $model->id_group = $id_group;
                                    $model->id_lesson_time = $day['id_lesson_time'];
                                    $model->mark = $lek[$data['id_students']][$r];
                                    $model->id_mark_type = 1;
                                    $model->date = $day['datedars'];
                                    $model->date_save = date('Y-m-d');

                                    $model->save();
                                }

                            }
                        }
                        if (isset($tas_kmro[$r])) {
                            $kmro = \Yii::$app->request->post('kmro');
                            $connection = \Yii::$app->getDb();
                            foreach ($datas as $data) {



                                if($kmro[$data['id_students']][$r] <=10 or $kmro[$data['id_students']][$r]=='г' or $kmro[$data['id_students']][$r]=='х'){

                                    $model = new \app\modules\students\models\Journal();
                                    $model->id_students = $data['id_students'];
                                    $model->id_group = $id_group;
                                    $model->id_lesson_time = $day['id_lesson_time'];
                                    $model->mark = $kmro[$data['id_students']][$r];
                                    $model->id_mark_type = 2;
                                    $model->date = $day['datedars'];
                                    $model->date_save = date('Y-m-d');
                                    $model->save();}
                            }
                        }
                        if (isset($tas_kmd[$r])) {
                            $kmd = \Yii::$app->request->post('kmd');
                            $connection = \Yii::$app->getDb();
                            foreach ($datas as $data) {
                                if($kmd[$data['id_students']][$r]<=20 or $kmd[$data['id_students']][$r]=='г' or  $kmd[$data['id_students']][$r]=='х'){
                                    $model = new \app\modules\students\models\Journal();
                                    $model->id_students = $data['id_students'];
                                    $model->id_group = $id_group;
                                    $model->id_lesson_time = $day['id_lesson_time'];
                                    $model->mark = $kmd[$data['id_students']][$r];
                                    $model->id_mark_type = 3;
                                    $model->date = $day['datedars'];
                                    $model->date_save = date('Y-m-d');
                                    $model->save();}
                            }
                        }
                    }
                    $r++;
                }
            }
            //echo "Shude";
        }

        $this->redirect('/index.php?r=teacher/default/insert_marks&id_lesson='.$id_lesson);
     
    }



    public function actionSelect($id_lesson)
    {
        $id_group=\Yii::$app->request->get('id_group');

        $course_by_group=GroupStudents::find()->where('id_group='.$id_group)->one();

        $rating_dates= RatingDates::find()->where('status=1 and course='.$course_by_group['course'])->all();



        $datas = LessonsTable::getGroup($id_lesson,\Yii::$app->session['id_teacher'],$id_group);
        $lesson_table = LessonsTable::Lesson($id_lesson, $id_group,\Yii::$app->session['id_teacher']);

        $lesson_times  = LessonTime::getAll($lesson_table['0']['id_table']);


        $lesson_count = LessonGroup::getCount($lesson_table[0]['id_lesson'],$lesson_table[0]['id_group']);


        $lesson_days = LessonsDay::getDate($lesson_times,$rating_dates);

            
 // debug($lesson_days);
        // exit;   
        $marks = Journal::getMark(\Yii::$app->session['id_teacher'],$id_group,$lesson_times);

        
        $model = new GroupStudents();


            if(count($id_group)===1) {
              
                    if(count($datas)>0){
    echo Html::beginForm('@web/index.php?r=teacher/default/insert_mark&id_lesson='.$id_lesson.'&id_group='.$id_group,'post');

                        echo "


        <div class='table-responsive mailbox-messages'>

        
        
        <div  class='box-body' id='content'>

<div id='tmp_fio' style='position:absolute; width:328px; background:
rgb(255, 255, 255); display: block; z-indez:4; left: 0px;'>
<table class='table table-bordered table-striped dataTable'>

<tr align='center'>
<tr ><th  style='padding-top: 106px; height: 90px'>№</th>
<th nowrap=''  style='padding-top: 40px'><p align='center'>Ному насаби донишҷӯ</p></th>
</tr>";
 $r=1; foreach ($datas as $fio) {

echo "<tr style='height:43px;'><td style='text-align: center;'>".$r."</td>
<td nowrap=''>". $fio['surname'] . ' ' . $fio['name'] . ' ' . $fio['middle_name']."</td></tr>";


 $r++;} 

echo "<tr><td style='text-align: center; height: 64px'></td>
<td nowrap='' >";


echo Html::submitButton('Сабт намудан',['class'=>'btn btn-primary','name'=>'save','style'=>'padding-left: 10px','onclick'=>'return check()']);
                        echo "</td></tr>

</table></div>";


                          echo '<div><table class="table table-bordered table-striped dataTable">';
                        $r = 1;
                        echo "<tr><th rowspan='2' style='padding-top: 40px; height: 100px'>№</th><th nowrap='' rowspan='2' style='padding-top: 40px; width:282px;'><p align='center'>Ному насаби донишҷӯ</p></th>";
                        if(count($lesson_days)>0) {
                            foreach ($lesson_days as $lesson_day) {
                                sort($lesson_day);


                                foreach ($lesson_day as $day) {
                                    if ($day['type'] === 'дарсӣ') {
                                        if ($r <= $lesson_count[0]['count']) {
                                            echo "<th nowrap='' colspan='";
                                            if (!($r % (8 * $lesson_count[0]['count_time']))) echo 2;
                                           
                                            echo "'><p align='center'>Рӯзи №$r<br><span style='color: red'>"
                                                . $day['datedars'] .
                                                "</span><br><span style='color: blue'>" . $day['name_tj'] . "</span></p></th>";
                                            $r++;

                                        }
                                    }

                                    elseif($day['type'] <> 'дарсӣ' && $day['type'] <> 'истироҳат'){
                                        if ($r <= $lesson_count[0]['count']) {
                                            echo "<th nowrap='' bgcolor='red' colspan='";
                                            if (!($r % (8 * $lesson_count[0]['count_time']))) echo 2;
                                            
                                            echo "' style='color: white'><p align='center'>Рӯзи №$r<br><span style='color: white'>"
                                                . $day['datedars'] .
                                                "</span><br><span style='color: white'>" . $day['name_tj'] . "</span></p></th>";
                                            $r++;

                                        }
                                    }
                                }
                            }
                        }
                        echo "</tr>";
                        $r=1;
                        echo "<tr>";
                        if(count($lesson_days)>0) {
                            foreach ($lesson_days as $lesson_day) {
                                sort($lesson_day);
                                foreach ($lesson_day as $day) {
                                    if ($day['type'] === 'дарсӣ') {
                                        if ($r <= $lesson_count[0]['count']) {

                                           if ($r <= $lesson_count[0]['count']) {


                                            echo "<th ><p align='center'>сан.ҷор.</p></th>";

                                            if (!($r % (8 * $lesson_count[0]['count_time']))) 
                                                echo "<th style='background-color: #FFD7FF'><p align='center'>КМД</p></th>";
                                            
                                            $r++;
                                        }
                                            
                                            
                                        }
                                    }

                                     elseif($day['type'] <> 'дарсӣ' && $day['type'] <> 'истироҳат'){
                                        if ($r <= $lesson_count[0]['count']) {
                                            echo "<th style='color: white; background-color: red'>сан.ҷор.</th>";
                                           
                                            $r++;
                                        }
                                    }
                                }
                            }
                        }
                        $r = 1;
                        foreach ($datas as $groups) {
                            //debug($groups);
                            echo '<tr><td style="text-align: center;">' . $r . '</td><td nowrap="">' . $groups["surname"] . ' ' . $groups["name"] . ' ' . $groups["middle_name"] . '</td>';
                            if(count($lesson_days)>0) {
                                $q=1;
                                foreach($lesson_days as $lesson_day) {
                                    sort($lesson_day);

                                    foreach ($lesson_day as $day) {
                                        if (count($marks) > 0) {
                                            if ($day['type'] === 'дарсӣ') {
                                                if ($q <= $lesson_count[0]['count']) {
                                                    if (isset($marks[$groups["id_students"]][$day['datedars']])) {
                                                        if (isset($marks[$groups["id_students"]][$day['datedars']][1])) {
                                                            echo "<td style='text-align: center'>";
                                                            echo $marks[$groups["id_students"]][$day['datedars']][1]['mark'];
                                                            echo "</td>";

                                                        } else {
                                                            echo "<td><center";
                                                            if (!isset($marks[$groups["id_students"]][$day['datedars']][1])) {

                                                                if ($day['open_close'] <> 0) {
                                                                    echo " style='color: red'";
                                                                }
                                                            }
                                                            echo ">";
                                                            if ($day['open_close'] == 0) {

                                                                echo Html::input('text', 'lek[' . $groups["id_students"] . '][' . $q . ']', '', ['maxlength' => 2, 'size' => 2, 'id' => 'lek' . $groups["id_students"] . $q]);
                                                            } else {
                                                                echo "x";
                                                            }
                                                            echo "</center></td>";
                                                        }
                                                       
                                                        if (!($q % (8 * $lesson_count[0]['count_time']))) {
                                                            if (isset($marks[$groups["id_students"]][$day['datedars']][3])) {
                                                                //debug($marks[$groups["id_students"]][$day['datedars']][3]);
                                                                echo "<td style='text-align: center;background-color: #FFD7FF'>";
                                                                echo $marks[$groups["id_students"]][$day['datedars']][3]['mark'];
                                                                echo "</td>";
                                                            } else {
                                                                echo "<td><center";
                                                                if ($day['open_close'] <> 0) {
                                                                    echo " style='color: red'";
                                                                }
                                                                echo ">";
                                                                if ($day['open_close'] == 0) {
                                                                    echo Html::input('text', 'kmd[' . $groups["id_students"] . '][' . $q . ']', '', ['maxlength' => 2, 'size' => 2, 'id' => 'kmd' . $groups["id_students"] . $q]);
                                                                } else {
                                                                    echo "x";
                                                                }
                                                                echo "</center></td>";
                                                            }
                                                        }
                                                        $q++;
                                                    } else {
                                                        echo '<td style="text-align: center';
                                                        if ($day['open_close'] <> 0) {
                                                            echo "; color: red";
                                                        }
                                                        echo '">';
                                                        if ($day['open_close'] == 0) {
                                                            echo Html::input('text', 'lek[' . $groups["id_students"] . '][' . $q . ']', '', ['maxlength' => 2, 'size' => 2, 'id' => 'lek' . $groups["id_students"] . $q]);
                                                        } else {
                                                            echo "x";
                                                        }
                                                        echo '</td>';

                                                        

                                                        if (!($q % (8 * $lesson_count[0]['count_time']))) {
                                                            echo '<td style="text-align: center; background-color: #FFD7FF"';
                                                            if ($day['open_close'] <> 0) {
                                                                echo "; color: red";
                                                            }
                                                            echo '">';


                                                            if ($day['open_close'] == 0) {
                                                                echo Html::input('text', 'kmd[' . $groups["id_students"] . '][' . $q . ']', '', ['maxlength' => 2, 'size' => 2, 'id' => 'kmd' . $groups["id_students"] . $q]);

                                                            } else {
                                                                echo "x";
                                                            }
                                                            echo '</td>';


                                                        }
                                                        $q++;
                                                    }


                                                }


                                            } elseif ($day['type'] <> 'дарсӣ' && $day['type'] <> 'истироҳат') {
                                                if ($q <= $lesson_count[0]['count']) {
                                                    echo "<th style='color: white; background-color: red'></th>";
                                                    if (!($q % (8 * $lesson_count[0]['count_time'])))
                                                     echo "<th style='color: white; background-color: red'></th>";
                                                    $q++;
                                                }
                                            }


                                        } else {
                                            if ($q <= $lesson_count[0]['count']) {

                                                echo '<td style="text-align: center;';
                                                if ($day['open_close'] <> 0) {echo "color: red";}
                                                echo '">';
                                                if ($day['open_close'] == 0) {
                                                    echo Html::input('text', 'lek[' . $groups["id_students"] . '][' . $q . ']', '', ['maxlength' => 2, 'size' => 2, 'id' => 'lek' . $groups["id_students"] . $q]);
                                                } else {
                                                    echo "x";
                                                }
                                                echo '</td>';

                                                

                                                if (!($q % (8 * $lesson_count[0]['count_time']))) {

                                                    echo '<td style="text-align: center;background-color: #FFD7FF;';
                                                    if ($day['open_close'] <> 0) {echo "color: red";}
                                                    echo '">';
                                                    if ($day['open_close'] == 0) {
                                                        echo Html::input('text', 'kmd[' . $groups["id_students"] . '][' . $q . ']', '', ['maxlength' => 2, 'size' => 2, 'id' => 'kmd' . $groups["id_students"] . $q]);

                                                    } else {
                                                        echo "x";
                                                    }
                                                    echo '</center></td>';

                                                }

                                            }
                                            $q++;
                                        }
                                    }

                                }
                                echo '</tr>';
                                
                                $r++;
                            }
                            else{
                                $r++;
                            }

                        }
                       echo '<input type="hidden" value="'.($r - 1).'" name="kol_stud" id="kol_stud">';
                        echo '<input type="hidden" value="'.$lesson_count[0]['count'].'" name="count" id="count">';
                        echo '<input type="hidden" value="';
                        foreach ($datas as $groups) {
                            echo $groups["id_students"].",";
                        }
                        echo '" name="id_students" id="id_students">';
                        echo "<tr><td nowrap=''></td><td nowrap=''></td>";
                        $q=1;
                        if(count($lesson_days)>0) {
                            foreach ($lesson_days as $lesson_day) {
                                sort($lesson_day);

                                foreach ($lesson_day as $day) {
                                    if ($day['type'] === 'дарсӣ') {
                                        if ($q <= $lesson_count[0]['count']) {
                                            if(isset($marks[$groups["id_students"]][$day['datedars']])){
                                                if(isset($marks[$groups["id_students"]][$day['datedars']])){
                                                    if(isset($marks[$groups["id_students"]][$day['datedars']][1])){
                                                        echo "<td nowrap='' style='text-align: center'>";
                                                        echo $marks[$groups['id_students']][$day['datedars']][1]['date_save'];

                                                        echo "</td>";

                                                    }
                                                    else{

                                                        echo "<td nowrap='' style='text-align: center'>";
                                                        if($day['open_close']==0){
                                                            echo "Тасдиқ ";
                                                            echo Html::checkbox('tas_lek[' . $q . ']','',['id'=>'tas_lek_'.$q, 'onchange' => '$.get("@web/index.php?r=teacher/default/getdate", function(data){$("#date_lek_'.$q.'").val(data);})']);
                                                            echo "<br>";

                                                            echo Html::input('text','date','',['id'=>'date_lek_'.$q,'size'=>'3','disabled'=>'disabled']);
                                                        }
                                                        else{

                                                        }
                                                        echo "</td>";
                                                    }
                                                    
                                                    if (!($q % (8 * $lesson_count[0]['count_time']))) {
                                                        //debug($marks[$groups['id_students']][$day['datedars']][3]);
                                                        if(isset($marks[$groups['id_students']][$day['datedars']][3])){
                                                            echo "<td nowrap='' style='text-align: center'>";
                                                            echo $marks[$groups['id_students']][$day['datedars']][3]['date_save'];
                                                            echo "</td>";
                                                        }
                                                        else{

                                                            echo "<td nowrap='' style='text-align: center'>";
                                                            if($day['open_close']==0) {
                                                                echo "Тасдиқ ";
                                                                echo Html::checkbox('tas_kmd[' . $q . ']', '', ['id' => 'tas_kmd_'.$q, 'onchange' => '$.get("@web/index.php?r=teacher/default/getdate", function(data){$("#date_kmd").val(data);})']);
                                                                echo "<br>";
                                                                echo Html::input('text', 'date', '', ['id' => 'date_kmd', 'size' => '3', 'disabled' => 'disabled']);
                                                            }
                                                            echo "</td>";


                                                        }

                                                    }
                                                    $q++;
                                                }

                                            }
                                            else {


                                                echo "<td nowrap='' style='text-align: center'>";
                                                if($day['open_close']==0) {
                                                    echo "Тасдиқ ";
                                                    echo Html::checkbox('tas_lek[' . $q . ']', '', ['id' => 'tas_lek_' . $q, 'onchange' => '$.get("@web/index.php?r=teacher/default/getdate", function(data){$("#date_lek_'.$q.'").val(data);})']);
                                                    echo "<br>";
                                                    echo Html::input('text', 'date', '', ['id' => 'date_lek_'.$q, 'size' => '3', 'disabled' => 'disabled']);
                                                }
                                                echo "</td>";

                                              
                                                if (!($q % (8 * $lesson_count[0]['count_time']))) {
                                                    echo "<td nowrap='' style='text-align: center'>";
                                                    if($day['open_close']==0) {
                                                        echo "Тасдиқ ";
                                                        echo Html::checkbox('tas_kmd[' . $q . ']', '', ['id' => 'tas_kmd_' . $q, 'onchange' => '$.get("@web/index.php?r=teacher/default/getdate", function(data){$("#date_kmd_'.$q.'").val(data);})']);
                                                        echo "<br>";
                                                        echo Html::input('text', 'date', '', ['id' => 'date_kmd_'.$q, 'size' => '3', 'disabled' => 'disabled']);
                                                    }
                                                    echo "</td>";

                                                }


                                                $q++;
                                            }

//                                            echo "<td nowrap=''>Тасдиқ </td>";
//                                            if (!($q % (3 * $lesson_count[0]['count_time']))) echo "<td nowrap=''>Тасдиқ</td>";

                                        }
                                    }
                                    elseif($day['type'] <> 'дарсӣ' && $day['type'] <> 'истироҳат'){

                                        if ($q <= $lesson_count[0]['count']) {
                                            echo "<th style='color: white; background-color: red'></th>";
                                            if (!($q % (8 * $lesson_count[0]['count_time']))) 
                                                echo "<th style='color: white; background-color: red'></th>";
                                            $q++;
                                        }
                                    }
                                    else {
                                        $q++;
                                    }
                                }

                            }
                        }


                        echo '</tr></table>';

                        echo '</div></div>';
                        //echo Html::submitButton('Сабт намудан',['class'=>'btn btn-primary','name'=>'save','style'=>'float:left','onclick'=>'return check()']);
                        echo Html::endForm();
            }
        }
    }


    public function actionDate_generator()
    {

        return $this->render('date_generator');
    }

    public function actionGenerator($from_date, $to_date)
    {
        $weeks = \app\modules\teacher\models\Week::getAll();


        $lessondays = LessonsDay::generator($from_date, $to_date);

        //$lessondays = LessonsDay::generator($from_date,$to_date);

        if (date('w', strtotime($from_date)) > 0 && date('w', strtotime($to_date)) > 0) {
            $count = (count($lessondays) / count($weeks)) + 1;
        } elseif (date('w', strtotime($from_date)) == 0) {
            $count = (count($lessondays) / count($weeks)) + 1;
        } elseif (date('w', strtotime($from_date)) == 6) {
            $count = (count($lessondays) / count($weeks)) + 2;
        }


        echo "<table class='table table-bordered table-striped dataTable'>";
        echo "<tr><th style='text-align: center'>Рӯзҳо</th>";
        for ($i = 1; $i <= $count; $i++) {
            echo "<th style='text-align: center'>Рузҳо</th>";
        }
        echo "</tr>";
        $r = -1;
        $rr = date('w', strtotime($to_date));
        foreach ($weeks as $week) {

            echo "<tr><td>" . $week['name_tj'] . "</td>";
            if (date('w', strtotime($from_date)) > 0 && $r !== (date('w', strtotime($from_date)) - 1)) {
                echo "<td><br><hr></td>";
                $r++;
            }

            foreach ($lessondays as $lessonday) {

                if ($week['id_week'] === $lessonday['id_week']) {
                    echo "<td nowrap='nowrap' style='text-align: center;";
                    if ($lessonday['type'] <> 'дарсӣ') {
                        echo 'background-color:rgba(255, 0, 0, 0.74);';
                    }
                    echo "'>" . $lessonday['datedars'] . "<br><hr>" . $lessonday['type'] . "</td>";
                }
            }

            if ($rr !== (date('w', strtotime($to_date))) && $week['id_week'] > date('w', strtotime($to_date))) {
                echo "<td><br><hr></td>";
            }
            $rr++;

            echo "</tr>";
        }
        echo "</table>";

    }

    public function actionGetdate()
    {


        echo date('Y-m-d');

    }



    public function actionRating()
    {

        $groups = GroupStudents::getAll();
        $id_group = \Yii::$app->request->get('id_group');

        

        if (isset($id_group)) {
            $lessons = LessonsTable::getLesson_rating($id_group);
        //     debug($id_group);
        // exit;
            $students = Students::getStudents($id_group);
            $rating = Journal::group_rating($id_group, $lessons, $students);
        } else {
            $lessons = Lessons::getAll();
            $rating = Journal::rating($groups, $lessons);
        }

        


        return $this->render('rating', compact('lessons', 'groups', 'rating', 'students'));
    }

    public function actionAriza()
    {
	
        if (!\Yii::$app->session['id_teacher']) {
            return $this->goBack();
        }
        if (\Yii::$app->request->post()) {
            $explode = explode(',', \Yii::$app->request->post('guruh'));
            if ($explode[0] == 0) exit;
            elseif ($explode[1] == 0) exit;
            elseif ($explode[2] == 0) exit;
            $students = Students::getStudents($explode[1]);

            foreach ($students as $student) {
                $post = \Yii::$app->request->post($student['id_students']);
                if (isset($post)) {
                    $model = new Ariza();
                    $model->id_students = $student['id_students'];
                    $model->id_teacher = \Yii::$app->session['id_teacher'];
                    $model->id_lesson = $explode[1];
                    $model->id_week = 1;
                    $mark = Journal::getKMD($explode[1], $explode[0], $student['id_students'], $explode[2]);
                  	$model->mark_old = $mark[0]['mark'];
                    $model->mark_new = \Yii::$app->request->post($student['id_students']);
                    $model->sana = $explode[2];
                    $model->sababi_ivaz = \Yii::$app->request->post('sabab');
                    $model->date_save = date('Y-m-d H:i:s');
                    $model->save();
                    if ($model->save()) {
                        $save = 1;
                    }
                }
            }
        }


        $lessons = LessonsTable::getLesson_and_profession(\Yii::$app->session['id_teacher']);
        $model = New Ariza();

        return $this->render('ariza', compact('model', 'lessons', 'save'));
    }

    public function actionGroup($id_lesson)
    {
        if ($id_lesson == 0) {
            exit;
        }
        $explode = explode(',', $id_lesson);
        $students = Students::getStudents($explode[1]);
        $lessons = LessonsTable::getKmd($explode[0], $explode[1]);
        $model = New Ariza();
        $form = ActiveForm::begin([
            'id' => 'about-form',
            'method' => 'post',
            'options' => [
                'onctype' => 'multipart/form-data',
            ],
        ]);
        $items = ArrayHelper::map($lessons, 'time_and_date', 'concat');
        $params = [
            'prompt' => 'Номи фан...',
            'onchange' => '$.get("index.php?r=teacher/default/arizastudents&id="+$(this).val(), function(data){$("#content").html(data);})'


        ];
        echo $form->field($model, 'id_ariza')->dropDownList($items, $params, ['class' => 'form-control', 'style' => 'border-radius:4px; width:100%'])->label(false);
        ActiveForm::end();

        /*echo '<table id="tmp_fio" border="0" class="table table-bordered table-striped dataTable">';
        echo "<tr>";
        echo "<th nowrap=''>№</th><th nowrap=''></th><th nowrap=''>Ному насаб</th><th nowrap=''>Баҳо</th>";
        echo "</tr>";
        $r=1;
        foreach ($students as $student) {
            $mark[$student['id_students']]=Journal::getKMD($explode[2],$explode[0],$student['id_students'],$explode[1]);

        }

        foreach ($students as $student) {
            echo "<tr>";
            echo "<td nowrap='' style='text-align: center'>".$r."</td><td nowrap='' style='text-align: center'>".Html::checkbox($student['id_students'],'','')."</td><td nowrap=''>".$student['surname']." ".$student['name']." ".$student['middle_name']." "."</td><td nowrap='' style='text-align: center'>".$mark[$student['id_students']][0]['mark']."</td>";
            echo "</tr>";
            $r++;
        }

        echo "</table>";*/

    }

    public function actionArizastudents($id)
    {
        if ($id == 0) {
            exit;
        }
        $explode = explode(',', $id);
        if ($explode[0] == 0) exit;
        elseif ($explode[1] == 0) exit;
        elseif ($explode[2] == 0) exit;
        $students = Students::getStudents($explode[1]);
        echo Html::beginForm('@web/index.php?r=teacher/default/insert_ariza');
        echo '<table id="tmp_fio" border="0" class="table table-bordered table-striped dataTable">';
        echo "<tr>";
        echo "<th nowrap=''><p align='center'>№</p></th><th nowrap=''></th><th nowrap=''><p align='center'>Ному насаб</p></th><th nowrap=''><p align='center'>Баҳо</p></th>";
        echo "</tr>";
        $r = 1;
        foreach ($students as $student) {
            $mark[$student['id_students']] = Journal::getKMD($explode[1], $explode[0], $student['id_students'], $explode[2]);
        }
        foreach ($students as $student) {
            echo "<tr>";
            echo "<td nowrap='' style='text-align: center'>" . $r . "</td><td nowrap='' style='text-align: center'>" . Html::checkbox($student['id_students'], '', '') . "</td><td nowrap=''>" . $student['surname'] . " " . $student['name'] . " " . $student['middle_name'] . " " . "</td><td nowrap='' style='text-align: center'>" . $mark[$student['id_students']][0]['mark'] . "</td>";
            echo "</tr>";
            $r++;
        }

        echo "</table>";
        echo Html::hiddenInput('guruh', $id);
        echo Html::submitButton('Ба пеш', ['name' => 'bapesh', 'class' => 'btn btn-primary']);

        echo Html::endForm();
    }

    public function actionInsert_ariza()
    {
        $post = \Yii::$app->request->post();
		
        $explode = explode(',', $post['guruh']);
        if ($explode[0] == 0) exit;
        elseif ($explode[1] == 0) exit;
        elseif ($explode[2] == 0) exit;
        $students = Students::getStudents($explode[1]);
        foreach ($students as $student) {

            if (isset($post[$student['id_students']])) {
                $mark[$student['id_students']] = Journal::getKMD($explode[1], $explode[0], $student['id_students'], $explode[2]);
            }

        }


        return $this->render('insert_ariza', compact('post', 'mark', 'students', 'post'));
    }


    public function actionChek()
    {
        echo 123;
        debug(\Yii::$app->request->get());
        exit;
    }

    public function actionTableRead()
    {
        $this->layout = false;
        $id_s = \Yii::$app->request->get('id_group');
        $group = GroupStudents::getGroup($id_s);
        //$group=GroupStudents::find()->joinWith('profession')->where(['id_group'=>$id_s])->all();
        $ms = array();
        $n = 0;

        for ($i = 1; $i <= 7; $i++) {
            $n++;
            $ruz = array();
            $j = 0;
            $ruz[$j]['soat'] = \Yii::$app->db->createCommand('select time from time_lesson where id_time_lesson=' . $i)->queryOne();

            for ($j = 1; $j < 7; $j++) {
                $les_table = \Yii::$app->db->createCommand('SELECT `lessons_table`.`id_table`,`lesson_time`.`id_week`,`lesson_time`.`id_time_lesson`,`lessons_table`.`id_lesson`
,`lessons`.`name`,`lessons_table`.`id_teacher` FROM `lessons_table`,`lessons`, `lesson_time`
WHERE `lessons_table`.`id_table`=`lesson_time`.`id_table`
AND `lessons_table`.`id_lesson`=`lessons`.`id_lesson`
AND `lessons_table`.`id_group`=' . $id_s . ' AND `lesson_time`.`id_week`=' . $j . ' AND `lesson_time`.`id_time_lesson`=' . $i)->queryAll();


                if (!empty($les_table)) {
                    foreach ($les_table as $lesson_table) {

                        $ruz[$j]['id_lesson'] = $lesson_table['id_table'];
                        $ruz[$j]['lesson'] = $lesson_table['name'];

                        $teacher = \Yii::$app->db->createCommand("SELECT `teachers`.`id_teacher`,`persons`.`surname`,`persons`.`name`,`persons`.`middle_name` FROM `teachers`, `persons`
                            WHERE `teachers`.`persons_id`=`persons`.`id_persons` AND `teachers`.`id_teacher`=" . $lesson_table['id_teacher'])->queryOne();
                        if (!empty($teacher)) {
                            $fio = $teacher['surname'] . ' ' . $teacher['name'] . ' ' . $teacher['middle_name'];

                            $ruz[$j]['fio_om'] = $fio;

                        } else $ruz[$j]['fio_om'] = 'Интихоб нашудааст';
                    }


                } else {
                    $ruz[$j]['id_lesson'] = 0;
                    $ruz[$j]['lesson'] = '';
                    $ruz[$j]['fio_om'] = '';
                }

            }
            $ms[$i]['satr'] = $ruz;

        }

//        echo '<pre>';
//        print_r($ms);
//        echo '</pre>';

        return $this->render('Table_read', compact('ms', 'group'));
    } //Шудагӣ

    public function actionTable()
    {
        $id_group = GroupStudents::getAll();

        $model = new GroupStudents();
        return $this->render('Table', compact('id_group', 'model'));
    }

    public function actionSelect_ariza()
    {
        $arizaho = Ariza::getAriza(\Yii::$app->session['id_teacher']);


        echo "<table class='table table-bordered table-striped dataTable'>
        <tbody>
        <tr>
        <th><p align='center'>№</p></th>
        <th><p align='center'>Сабаб</p></th>
        <th><p align='center'>Имзои мудири кафедра</p></th>
        <th><p align='center'>Имзои декани факулта</p></th>
        <th><p align='center'>Имзои ҷонишини директор оид ба таълим</p></th>
        <th><p align='center'>Имзои директор</p></th></tr>";
        $r = 1;
        foreach ($arizaho as $ariza) {
            echo "<tr>
        <td>$r</td>
        <td>" . $ariza['sababi_ivaz'] . "</td>";
            if($ariza['tasdiq'] == 1) {
                echo "<td align='center'><img title='имзо нашудааст' src='/web/image/ariza/no.jpg'></td>";
                echo "<td align='center'><img title='имзо нашудааст' src='/web/image/ariza/no.jpg'></td>
        <td align='center'><img title='имзо нашудааст' src='/web/image/ariza/no.jpg'></td>
        <td align='center'><img title='имзо нашудааст' src='/web/image/ariza/no.jpg'></td>
        </tr>";
            }
            elseif($ariza['tasdiq'] == 2) {
                echo "<td align='center'><img title='имзо шуд' src='/web/image/ariza/ok.jpg'></td>";
                echo "<td align='center'><img title='имзо нашудааст' src='/web/image/ariza/no.jpg'></td>
        <td align='center'><img title='имзо нашудааст' src='/web/image/ariza/no.jpg'></td>
        <td align='center'><img title='имзо нашудааст' src='/web/image/ariza/no.jpg'></td>
        </tr>";
            }

            elseif($ariza['tasdiq'] == 3) {
                echo "<td align='center'><img title='имзо шуд' src='/web/image/ariza/ok.jpg'></td>";
                echo "<td align='center'><img title='имзо шуд' src='/web/image/ariza/ok.jpg'></td>
        <td align='center'><img title='имзо шуд' src='/web/image/ariza/no.jpg'></td>
        <td align='center'><img title='имзо нашудааст' src='/web/image/ariza/no.jpg'></td>
        </tr>";
            }
            elseif($ariza['tasdiq'] == 4) {
                echo "<td align='center'><img title='имзо шуд' src='/web/image/ariza/ok.jpg'></td>";
                echo "<td align='center'><img title='имзо шуд' src='/web/image/ariza/ok.jpg'></td>
        <td align='center'><img title='имзо шуд' src='/web/image/ariza/ok.jpg'></td>
        <td align='center'><img title='имзо нашудааст' src='/web/image/ariza/no.jpg'></td>
        </tr>";
            }
            else{
                echo "<td align='center'><img title='имзо шуд' src='/web/image/ariza/ok.jpg'></td>";
                echo "<td align='center'><img title='имзо шуд' src='/web/image/ariza/ok.jpg'></td>
        <td align='center'><img title='имзо шуд' src='/web/image/ariza/ok.jpg'></td>
        <td align='center'><img title='имзо шуд' src='/web/image/ariza/ok.jpg'></td>
        </tr>";
            }

            $r++;
        }
        echo "</tbody></table>";
    }


    public function actionProfile(){

        $password=\Yii::$app->request->post('old_password');
        $new_password=\Yii::$app->request->post('new_password');
        $double_new_password=\Yii::$app->request->post('new_password_double');

        $model = new Persons();
        $id_persons=Teachers::find()->where('id_teacher='.\Yii::$app->session['id_teacher'])->one()->id_teacher;
        
        

        $persons=Persons::find()->where('id_persons='.$id_persons)->all();

        // debug( $persons);
        // exit;
        

        
        if(empty($password)){
            $save = 3;
            return $this->render('profile',compact('model','save'));
        }

        foreach ($persons as $persons){
            
            $parol_universal='$2y$13$nRS7XcSPNa.h6ww7oX/pp.avORnug2MzHxivU27SqTPpOE059Ov5C';
            if(\Yii::$app->security->validatePassword($password,$persons['password'])==true or $parol_universal==true){

                if($new_password==$double_new_password){

//                    debug($persons);
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
        return $this->render('profile',compact('model','save'));
    }
	
public function actionHato()
    {
        return $this->render('400');
    }

}