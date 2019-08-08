<?php

namespace app\modules\dekanifakultet\controllers;

use app\modules\admin\models\GroupStudents;
use app\modules\admin\models\LessonGroup;
use app\modules\admin\models\Lessons;
use app\modules\admin\models\LessonsTable;
use app\modules\admin\models\LessonTime;
use app\modules\admin\models\Persons;
use app\modules\admin\models\Students;
use app\modules\admin\models\TeacherLesson;
use app\modules\admin\models\Teachers;
use app\modules\admin\models\TeachersDay;
use app\modules\admin\models\Week;
use Yii;
use yii\db\Query;
use yii\web\Controller;

class ControlController extends Controller
{

    public function actionSelectGroupLesson()
    {

        $id_s=Yii::$app->request->get('id_s');
        $lesson_group = Yii::$app->db->createCommand('SELECT lessons.`id_lesson`,lessons.`name`,lesson_group.`count_time` FROM `lessons`, `lesson_group`
        WHERE lessons.`id_lesson`=lesson_group.`id_lesson` AND count_time > 0 AND lesson_group.`id_group`='.$id_s.' ORDER BY name')->queryAll();

        $n=0;
        if($lesson_group > 0){
            $ms=array();
            foreach($lesson_group as $row){

//
                $count_time_lesson = Yii::$app->db->createCommand('SELECT COUNT(*) FROM lessons_table AS ls,
                lesson_time AS lt WHERE ls.`id_table`=lt.`id_table` AND ls.`id_lesson`='.$row['id_lesson'].' AND ls.id_group='.$id_s)
                    ->queryScalar();

                if($count_time_lesson <= $row['count_time']-1) {

                    $ms[$n] = $row;
                    $n++;
                }
            }
        }
        $ms;

        if(!empty($ms)) {


            $nt = 'Руйхати фанҳо';
            $nt .= " <div class=''>
                <ul class='pop2_list'>";
            $nt .= "<li>
               <a class='clear' onclick='classTimetableEditor.changeSubject({
                                id: 0,
                                name:&#39; Интихоб нашудааст &#39;
                           })'>Интихоб нашудааст
                       </a>
					</li>";
            foreach ($ms as $row) {

                $nt .= " <li>
                     <a onclick='classTimetableEditor.changeSubject({
                        id: " . $row['id_lesson'] . ",
                        name: &#39;" . $row['name'] . "&#39;
                        })'>" . $row['name'] . "
                    </a>
                    </li>";
            }
            $nt .= "</ul>
            </div>";
            echo $nt;
        }
    }  //Шудаги 1000000000%



    public function actionSelectTeacherLesson()
    {
        $ruz=Yii::$app->request->get('ruz');
        $soat=Yii::$app->request->get('soat');
        $id_f=Yii::$app->request->get('id_f');

        if($id_f <> 0){
            $query=TeacherLesson::find()->
            where(['teacher_lesson.id_lesson'=>$id_f])->joinWith('teacher.person')-> all();


            $n=0;
            $ms=array();
            if(!empty($query)){
                foreach($query as $row){

                    $id_teacher=$row['id_teacher'];

                    $query2 = LessonsTable::find()->joinWith('lessonTime')
                        ->where(['lessons_table.id_teacher'=>$id_teacher,
                            'lesson_time.id_week' => $ruz,
                            'lesson_time.id_time_lesson' => $soat,])->all();

                    if(!$query2){
                        $ms[$n]=$row;
                        $n++;
                    }
                }
            }
            $ms;


            if(!empty($ms)){

                $nt='<div>Руйхати омузгорон';
                $nt.="<ul class='pop2_list'>";
                foreach($ms as $row){
                    $fio=$row['teacher']['person']['0']['surname'].' '.
                        $row['teacher']['person']['0']['name'].' '.$row['teacher']['person']['0']['middle_name'];
                    $nt.="<li>
                <a onclick='classTimetableEditor.changeOmuz({
                                id: ".$row['id_teacher'].",
                                name: &#39;".$fio.".&#39;
                            })'>
                 ".$fio." </a>
            </li>";
                }
                $nt.="</ul></div>";
                echo $nt;
            }else{
                echo "Бубахшед омӯзгори озод ёфта нашуд!";
            }
        }else echo "Аввал фаннро интихоб кунед!";

    }// Шудагӣ 10000000%


    public function actionInsertLesson()
    {
        if(Yii::$app->request->get('fan')==0) {


            $lessons_times = LessonTime::find()->
            where(['id_week' => Yii::$app->request->get('id_ruz'),
                'id_time_lesson' => Yii::$app->request->get('soat')])->all();
            $i=0;
            foreach($lessons_times as $row) {

                $lessons_tables = LessonsTable::find()->
                where(['lessons_table.id_table' => $lessons_times[$i]['id_table'],
                    'lessons_table.id_group' => Yii::$app->request->get('id_s')])->one();


                if($lessons_tables==true){
                    $lessons_times[$i]->id_table=0;
                    $lessons_times[$i]->save();
                    echo 'malumoti zaruri ivaz shud!!!';
                }

                $i++;
            }
        }

            if(Yii::$app->request->get('fan')<> 0) {

                //update
                $ls_time=LessonTime::find()->
                where(['id_week' => Yii::$app->request->get('id_ruz'),
                    'id_time_lesson' => Yii::$app->request->get('soat')])->one();


                   $ls_tab= LessonsTable::find()->
                   where(['lessons_table.id_table'=>$ls_time['id_table'],
                       'lessons_table.id_group' => Yii::$app->request->get('id_s')])->one();

                if($ls_tab==true) {

                    $ls_tab->id_lesson = Yii::$app->request->get('fan');
                    $ls_tab->save();
                    echo 'dars ivaz karda shud!';

                }


                $lessons_table = LessonsTable::find()->
                where(['lessons_table.id_lesson' => Yii::$app->request->get('fan'),
                    'lessons_table.id_group' => Yii::$app->request->get('id_s')])->one();

                if($lessons_table==true){
                    $lt_time = LessonTime::find()->
                    where(['id_table'=>0,'id_week' => Yii::$app->request->get('id_ruz'),
                        'id_time_lesson' => Yii::$app->request->get('soat')])->one();

                    if ($lt_time == true) {
                        $lt_time->id_table = $lessons_table['id_table'];
                        $lt_time->save();
                        echo 'malumoti zaruri ivaz shud!!!';

                    }
                }
                else echo 'update naashud';

                $lessons_time = LessonTime::find()->
                where(['lesson_time.id_table'=>$lessons_table['id_table'],
                    'lesson_time.id_week' => Yii::$app->request->get('id_ruz'),
                    'lesson_time.id_time_lesson' => Yii::$app->request->get('soat')])->one();

                debug($lessons_table);
                $lesson_table = new LessonsTable();
                $lesson_time = new LessonTime();

                if ( empty($lessons_table)  && empty($lessons_time)) {
                    $lesson_table->id_group = Yii::$app->request->get('id_s');
                    $lesson_table->id_teacher = 4;
                    $lesson_table->id_lesson = Yii::$app->request->get('fan');
                    $lesson_table->save();

                    $les_table = LessonsTable::find()->
                    where(['lessons_table.id_lesson' => Yii::$app->request->get('fan'),
                        'lessons_table.id_group' => Yii::$app->request->get('id_s')])->one();

                    $lesson_time->id_table=$les_table['id_table'];
                    $lesson_time->id_week=Yii::$app->request->get('id_ruz');
                    $lesson_time->id_time_lesson=Yii::$app->request->get('soat');
                    $lesson_time->save();

                    echo 'malumot nav ba jadvalho vorid shud!!!';
                }

                $lessons_times = LessonTime::find()->
                where(['id_week' => Yii::$app->request->get('id_ruz'),
                    'id_time_lesson' => Yii::$app->request->get('soat')])->all();
                $i=0;
                foreach($lessons_times as $row) {

                    $lessons_tables = LessonsTable::find()->
                    where(['lessons_table.id_table' => $lessons_times[$i]['id_table'],
                        'lessons_table.id_group' => Yii::$app->request->get('id_s')])->one();


                    if($lessons_tables==true){
                        $lessons_times[$i]->id_table=$lessons_table['id_table'];
                        $lessons_times[$i]->save();
                        echo 'lesson_time ivaz shud!!!';
                    }

                    $i++;
                }

            }

    } //Шудаги 1000000000000%


    public function actionInsertTeacher(){

        $lesson_time=LessonTime::find()->where(['lesson_time.id_week'=>Yii::$app->request->get('id_ruz'),
            'lesson_time.id_time_lesson'=>Yii::$app->request->get('soat')])->one();

        $lesson_table=LessonsTable::find()->
        where(['lessons_table.id_group'=>Yii::$app->request->get('id_s'),
            'lessons_table.id_table'=>$lesson_time['id_table']])->one();


        if(!empty(Yii::$app->request->get())){

            if($lesson_table==true) {

                $lesson_table->id_teacher = Yii::$app->request->get('omuz');

                $lesson_table->save();


                echo 'SHUD';
            }

        }
        else echo "NASHUD";


    }//Шудаги 1000000000000%


}
