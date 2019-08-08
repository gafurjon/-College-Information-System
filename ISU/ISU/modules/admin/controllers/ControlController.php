<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\GroupStudents;
use app\modules\admin\models\LessonGroup;
use app\modules\admin\models\Lessons;
use app\modules\admin\models\Lesson;
use app\modules\admin\models\LessonsTable;
use app\modules\admin\models\LessonTime;
use app\modules\admin\models\Persons;
use app\modules\admin\models\Students;
use app\modules\admin\models\TeacherLesson;
use app\modules\admin\models\Teachers;
use app\modules\admin\models\TeachersDay;
use app\modules\admin\models\Week;
use app\modules\admin\models\Settings;
use Yii;
use yii\db\Query;
use yii\web\Controller;

class ControlController extends Controller
{

    public function actionInsertTable(){
        //Функсия для обрабокти данных
        /// Inset-----Table------

    	 $taftish = lesson::getId_les(Yii::$app->request->post('name'));

    	 $hast = LessonGroup::findOne(['id_group'=>Yii::$app->request->post('pk'),
            	'id_lesson' =>$taftish['0']['MIN(id_lesson)'] ]);


    	// debug($taftish );
     //    exit;
        if(empty($hast)){

            $model = new LessonGroup;
                $model->id_lesson=$taftish['0']['MIN(id_lesson)'];
                $model->id_group=Yii::$app->request->post('pk');
                $model->count_time=Yii::$app->request->post('value');
                $model->count=36;
                $model->insert();
               
                return 'Ворид карда шуд';
        }

        elseif(!empty($hast)){
            
            
            $id=$hast['id_lesson_group'];
            if($id > 0){
                $sql= LessonGroup::findOne($id);
                $sql->updateAttributes(['count_time'=>Yii::$app->request->post('value')]);
                return 'Ивазкарда шуд';
            } 

            return 'Нашуд!';


        }
    }// Шудаги 1000000000%

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

                $nt='<div>Руйхати омӯзгорон';
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

    public function actionSelectGroupLesson()
    {

        $id_s=Yii::$app->request->get('id_s');
        $lesson_group = Yii::$app->db->createCommand('SELECT lessons.`id_lesson`,lesson.`name`,lesson_group.`count_time` 
		FROM `lessons`, `lesson_group`,`group_students`, lesson
		WHERE lesson.`id_lesson`=lessons.`id_lesson`
		AND lessons.`id_lesson`=lesson_group.`id_lesson` 
		AND count_time > 0 AND lesson_group.`id_group`=`group_students`.`id_group` 
		AND `group_students`.`id_group`='.$id_s.'
		GROUP BY NAME')->queryAll();



        $n=0;
        if($lesson_group > 0){
            $ms=array();
            foreach($lesson_group as $row){

//                echo $row['count_time'];
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

    public function actionInsertLesson()
    {
        $id_group=Yii::$app->request->get('id_s');
        $id_lesson=Yii::$app->request->get('fan');

        $id_week=Yii::$app->request->get('id_ruz');
        $id_time_lesson=Yii::$app->request->get('soat');




            $lesson_time=LessonTime::find()->where(['lesson_time.id_week'=>$id_week,
            'lesson_time.id_time_lesson'=>$id_time_lesson])->orderby(['id_lesson_time'=>SORT_DESC])->one()->id_table;
//

            $lesson_table=LessonsTable::find()->
        where(['lessons_table.id_group'=>$id_group,
        'lessons_table.id_table'=>$lesson_time, 'lessons_table.id_table'=>$lesson_time])->one();
            

             
        if(!empty(Yii::$app->request->get())){

            if(!empty($lesson_table)) {


                $lesson_table->id_lesson = $id_lesson;

                $lesson_table->save();


                echo 'иваз шуд!!!';
            }
                
          


            else {
                    $lesson_table = new LessonsTable();
                    $lesson_time = new LessonTime();

            	$stadies_year=Settings::find()->all();



                $lesson_table->id_group = Yii::$app->request->get('id_s');
                $lesson_table->id_teacher = 0;
                $lesson_table->id_lesson = Yii::$app->request->get('fan');
                $lesson_table->studies_year=$stadies_year['0']['studies_year'];
                $lesson_table->save();

                $les_table = LessonsTable::find()->
                where(['lessons_table.id_lesson' => Yii::$app->request->get('fan'),
                    'lessons_table.id_group' => Yii::$app->request->get('id_s')])->one();

                $lesson_time->id_table=$les_table['id_table'];
                $lesson_time->id_week=Yii::$app->request->get('id_ruz');
                $lesson_time->id_time_lesson=Yii::$app->request->get('soat');
                $lesson_time->save();

                echo 'Ҳамаи маълумотҳо ба ҷадвалҳо ворид карда шуд!!!';
            }}


          

    } //Шудаги 1000000000000%


    public function actionInsertTeacher(){

    	

        $lesson_time=LessonTime::find()->where(['lesson_time.id_week'=>Yii::$app->request->get('id_ruz'),
            'lesson_time.id_time_lesson'=>Yii::$app->request->get('soat')])->orderby(['id_lesson_time'=>SORT_DESC])->one()->id_table;
                

       

               


        $lesson_table=LessonsTable::find()->
        where(['lessons_table.id_group'=>Yii::$app->request->get('id_s'),
        'lessons_table.id_table'=>$lesson_time])->one();
        	
			
			 
        if(!empty(Yii::$app->request->get())){

            if(!empty($lesson_table)) {


                $lesson_table->id_teacher = Yii::$app->request->get('omuz');

                $lesson_table->save();


                echo 'SHUD';
            }

        }
        else echo "NASHUD";


    }//Шудаги 1000000000000%



    public function actionDeleteLesson()
    {
        $id_lesson=Yii::$app->request->get('id_lesson');
        $id_teacher=Yii::$app->request->get('id_teacher');

        $teacher_lesson=TeacherLesson::find()->where(['teacher_lesson.id_teacher'=>$id_teacher,
            'teacher_lesson.id_lesson'=>$id_lesson,'teacher_lesson.status'=>'1','teacher_lesson.year'=>date(Y)])
            ->joinWith('lesson')->one();

            // debug($teacher_lesson);
            // exit;


        if(!empty($teacher_lesson)){

            //$teacher_lesson->delete();
            $teacher_lesson->status=0;
            $teacher_lesson->save();


            echo 'SHUD';
        }
        else{
                echo 'Nashud';
        }

    }// Шудаги 100%





    public function actionTeacherLesson(){
        $id_teacher=Yii::$app->request->get('savolid');

        $teacher_lesson=TeacherLesson::find()->where(['teacher_lesson.id_teacher'=>$id_teacher,'teacher_lesson.status'=>'1'])
            ->joinWith('lesson')->all();

        foreach($teacher_lesson as $row){

            echo "<tr>
                    <td>
                         <dt>".$row['lesson']['name']."</dt>
                    </td>
                    <td width='20px'>
                        <button class='btn btn-xs btn-danger' onclick='delet(".$row['id_lesson'].")'>
                            <i class='ace-icon fa fa-trash-o bigger-120'></i>
                        </button>
                    </td>
                </tr>";
        }
    }




    public function actionAddLesson()
    {
        $id_lesson=Yii::$app->request->get('id_lesson');
        $id_teacher=Yii::$app->request->get('id_teacher');

        if(!empty($id_lesson  && $id_teacher)){
            $teacherlesson = New TeacherLesson();

            $teacherlesson->id_teacher=$id_teacher;
            $teacherlesson->id_lesson=$id_lesson;
            $teacherlesson->status=1;
            $teacherlesson->year=date(Y);

            $teacherlesson->save();

            echo 'SHUD';}
        else{
            echo 'NASHUD';
        }

    }


    public function actionTeacher($id_teacher='')
    {
        $id_teacher=Yii::$app->request->get('id_teacher');

        $teacher_lesson=TeacherLesson::find()->
        where(['teacher_lesson.id_teacher'=>$id_teacher,'teacher_lesson.status'=>'1'])->joinWith('teacher.person')->all();

        $lesson=Lesson::find()->groupby('name')->all();

    		
		
        echo "<table class='table table-striped table-bordered table-hover'>
            <thead class='thin-border-bottom'>
                <tr>
                    <th>
                        Номи фан
                    </th>
                    <th width='20px'>амал</th>
                </tr>
            </thead>";

        echo " <tbody id='vaz'>";

        foreach($teacher_lesson as $row){

            echo "<tr>
                    <td>
                        <dt>".$row['lesson']['name']."</dt>
                    </td>

                    <td width='20px'>
                        <button class='btn btn-xs btn-danger' onclick='delet(".$row['id_lesson'].")'>
                            <i class='ace-icon fa fa-trash-o bigger-120'></i>
                        </button>
                    </td>
                </tr>";
        }
        echo"</tbody>
        </table>";


        echo "<div class='hr hr-12 hr-double'></div>";
        echo "<div>
                <label for='form-field-select-3'>Иловаи фан ба омӯзгор</label>

                <br>
                <select class='chosen-select form-control' id='vazifa'  >";
        echo "<option value=''></option>";

        foreach($lesson as $pow){


            echo "<option value='".$pow['id_lesson']."'> ".$pow['name']." </option>";

        }


        echo"</select>
               </div>";

        echo "<script type='text/javascript'>
             function delet(id)
            {
                $.ajax({
                        type: 'get',
                        url: '".\yii\helpers\Url::to('@web/index.php?r=admin/control/delete-lesson')."&id_teacher=".$id_teacher."',
                        data: 'id_lesson='+id,
                        success: function(returnData){
                                if (returnData) {
                               $('#vazifa').val('');
                                 //alter('Илова карда шуд!');
                                 $.ajax({
                                        type: 'get',
                                        url: '".\yii\helpers\Url::to('@web/index.php?r=admin/control/teacher-lesson')."&id_teacher=".$id_teacher."',
                                        data: 'savolid='+$id_teacher,
                                        success: function(data){
                                            $('#vaz').html(data);
                                        }
                                    });
                                } else {
                                     alter('Илова карда нашуд!');
                                }
                        }
                    });
            };
        $(document).ready(function(){
            $('#vazifa').on('change',function() {
                var id_lesson = $(this).val();
                    $.ajax({
                        type: 'get',
                        url: '".\yii\helpers\Url::to('@web/index.php?r=admin/control/add-lesson')."&id_teacher=".$id_teacher."',
                        data: 'id_lesson='+id_lesson,
                        success: function(returnData){
                                if (returnData) {
                                 $('#vazifa').val('');
                                 $.ajax({
                                        type: 'get',
                                        url: '".\yii\helpers\Url::to('@web/index.php?r=admin/control/teacher-lesson')."&id_teacher=".$id_teacher."',
                                        data: 'savolid='+$id_teacher,
                                        success: function(data){
                                            $('#vaz').html(data);
                                        }
                                    });
                                 alter('Илова карда шуд!');
                                } else {
                                   alter('Илова карда нашуд!');
                                }
                        }
                    });
            });

        });
                           </script>";



    }


    public function actionTeachers($amal='')
    {
        $id_teacher=Yii::$app->request->post('id');

        if(Yii::$app->request->post('oper')==true && Yii::$app->request->post('oper')=='edit'){

            $teacher=Teachers::find()->where(['teachers.id_teacher'=>$id_teacher])->one();
            $person=Persons::find()->where(['persons.id_persons'=>$teacher['id_teacher']])->one();

            // echo '<pre>';
            //     print_r($person);
            // echo '</pre>';
            // exit;

            $teacher->work=Yii::$app->request->post('work');
            $teacher->unvon=Yii::$app->request->post('daraja');


            $person->surname=Yii::$app->request->post('fio_surname');
            $person->name=Yii::$app->request->post('fio_name');
            $person->middle_name=Yii::$app->request->post('fio_middlename');
            $person->adress=Yii::$app->request->post('fio_middlename');
            $person->telefon=Yii::$app->request->post('telefon');

            $teacher->save();
            $person->save();

            echo 'Маълумот иваз карда шуд!!!';
        }

        if(Yii::$app->request->post('oper')==true && Yii::$app->request->post('oper')=='add') {

            $persons=Yii::$app->db->createCommand('SELECT MAX(login) as login  FROM persons WHERE user_id=2')->queryOne();

            $person= New Persons();

            $person->surname=Yii::$app->request->post('fio_surname');
            $person->name=Yii::$app->request->post('fio_name');
            $person->middle_name=Yii::$app->request->post('fio_middlename');
            $person->adress=Yii::$app->request->post('fio_middlename');
            $person->telefon=Yii::$app->request->post('telefon');
            $person->save();

            echo 'Маълумот нав дохил карда шуд!!!';}




    }


    public function actionSelectGroup()
    {
        $id_group = Yii::$app->request->get('id');

        $students =GroupStudents::find()->where(['group_students.id_group' => $id_group])
            ->joinWith('profession')->joinWith('faculty')
           ->joinWith('teacher.person')
            ->all();

//        echo '<pre>';
//            print_r($students);
//        echo '</pre>';
//        exit;

    }//netu





    public function actionSelectStudents(){
    $id_group=Yii::$app->request->get('id_group');
    $group_student= Students::find()
        ->joinWith('person')
        ->where(['students.id_group' => $id_group])
        ->orderBy(['surname' => SORT_ASC])->asArray()
        ->all();

    if(count($group_student) > 0){


       /* <div class="wizard-actions">
            <button class="btn btn-success" onclick="add_khonanda()">
                <i class="ace-icon fa fa-pencil align-top bigger-125"></i>
Иловаи хонандаи нав
</button>
        </div>*/echo '
        <table class="table table-striped table-bordered">
            <thead class="center">
            <tr>
                <th class="center">№</th>
                <th class="center">Ному насаб</th>
                <th class="hidden-xs" ><p align="center">Телефони донишҷӯ<p></th>
                <th class="hidden-480"><p align="center">Суроға<p></th>
                <th class="center">Амал</th>
            </tr>
            </thead>
            <tbody>';
        $i=1; foreach($group_student as $row){
            $id_students=$row['id_students'];
            echo '
    <tr>
        <td class="center">'.$i.'</td>

        <td>'.$row['person']['0']['surname'].' '.$row['person']['0']['name'].' '.$row['person']['0']['middle_name'].'</td>
        <td class="hidden-xs">'.$row['person']['0']['telefon'].'</td>
        <td class="hidden-480">'.$row['person']['0']['adress'].'</td>
        <td>

            <div class="hidden-sm hidden-xs btn-group">';
               echo "<button class='btn btn-xs btn-success' onclick='select_id_khonanda($id_students)'>";
                   echo '<i class="ace-icon fa fa-search-plus bigger-120"></i>
                </button>

                <button class="btn btn-xs btn-info">
                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                </button>

                <button class="btn btn-xs btn-danger">
                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                </button>


            </div>


            <div class="hidden-md hidden-lg">
                <div class="inline pos-rel">
                    <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto" >
                        <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                        <li>';
                          echo"  <a href='' class='tooltip-info' data-rel='tooltip' title='' data-original-title='View' onclick='select_id_khonanda($id_students)'>";
                                       echo ' <span class="blue">
                                            <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                        </span>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="tooltip-success" data-rel="tooltip" title="" data-original-title="Edit">
                                        <span class="green">
                                            <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                        </span>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="tooltip-error" data-rel="tooltip" title="" data-original-title="Delete">
                                        <span class="red">
                                            <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                        </span>
                            </a>
                        </li>
                    </ul>
                </div>



            </div>


        </td>
    </tr>';
            $i++;
        }
        echo '</tbody>
</table>

</div>';

        echo "<script type='text/javascript'>
function select_id_khonanda(id)
    {
            $.ajax({
                type: 'POST',
                url: '".\yii\helpers\Url::to('@web/index.php?r=admin/control/select-id-student&id_student=')."'+id,
                data: 'id_student=' + id,
                success: function (returnData) {
                    if (returnData) {
                        $('#dialog-message').html(returnData);
                    } else {
                    }
                }
            });

            var dialog = $( '#dialog-message' ).removeClass('hide').dialog({
                modal: true,
                title: 'Маълумоти пурра оиди донишҷӯ',
                width: '85%',
                top: '33px',

                title_html: true,
                buttons: [
                    {
                        text: 'Cancel', 'class' : 'btn btn-minier',
                        click: function() { $( this ).dialog( 'close' );
                    }
                    },
                    {
                        text: 'OK', 'class' : 'btn btn-primary btn-minier',
                        click: function() { $( this ).dialog( 'close' );
                    }
                    }
                ]
            });
};
</script>";
    }
}



    public function actionSelectTableRead(){

        $id_group=Yii::$app->request->get('id_group');
        $group=GroupStudents::find()->joinWith('profession')->where(['id_group'=>$id_group])->asArray()->one();

        $ms=array();
        $n=0;
        for($i=1; $i<7;$i++)
        {   $n++;

            $ms[$i]['ruz']=Yii::$app->db->createCommand('SELECT name_tj FROM week WHERE id_week='.$i)->queryOne();
            $ruz=array();
            for($j=1;$j<=7;$j++)
            {
                $ruz[$j]['soat'] = Yii::$app->db->createCommand('select time from time_lesson where id_time_lesson=' . $j)->queryOne();

                $les_table = Yii::$app->db->createCommand('SELECT `lessons_table`.`id_table`,`lesson_time`.`id_week`,`lesson_time`.`id_time_lesson`,`lessons_table`.`id_lesson`
,`lessons`.`name`,`lessons_table`.`id_teacher` FROM `lessons_table`,`lessons`, `lesson_time`
WHERE `lessons_table`.`id_table`=`lesson_time`.`id_table`
AND `lessons_table`.`id_lesson`=`lessons`.`id_lesson`
AND `lessons_table`.`id_group`=' . $id_group . ' AND `lesson_time`.`id_week`=' . $i . ' AND `lesson_time`.`id_time_lesson`=' . $j)->queryAll();


                if (!empty($les_table)) {
                    foreach ($les_table as $lesson_table){

                        $ruz[$j]['id_lesson'] = $lesson_table['id_table'];
                        $ruz[$j]['lesson'] = $lesson_table['name'];
                        $ruz[$j]['id_teacher']=$lesson_table['id_teacher'];


                        $teacher = Yii::$app->db->createCommand("SELECT `teachers`.`id_teacher`,`persons`.`surname`,`persons`.`name`,`persons`.`middle_name`
FROM `teachers`, `persons`,`lessons_table`
WHERE `lessons_table`.`id_teacher`=`teachers`.`id_teacher` AND `teachers`.`persons_id`=`persons`.`id_persons` AND
lessons_table.`id_table`=" . $lesson_table['id_table'])->queryOne();
                        if (!empty($teacher)) {
                            $fio = $teacher['surname'] . ' ' . $teacher['name'] . ' ' . $teacher['middle_name'];

                            $ruz[$j]['fio_om'] = $fio;

                        } else $ruz[$j]['fio_om'] = 'Интихоб нашудааст';

                    }


                }

                else {
            $ruz[$j]['id_lesson'] = 0;
            $ruz[$j]['lesson'] = '';
            $ruz[$j]['fio_om'] = '';
        }

        }
        $ms[$i]['satr']=$ruz;

        }


        echo "
    <link href='/ktk.tj/web/admin/timetable_files/subdomain.css' type='text/css' rel='stylesheet'>";

        $sana=date('Y-m-d');  $rh=(date('w', strtotime($sana)));
        echo "<div class='class_tabs_content_item tabs1_cb' id='class_tabs_timetable'>
        <div class='tabs1_cbb'>
        <div class='tabs_timetbl'>
            <div class='ttb_boxes'>";
        $n=0; foreach($ms as $jadval):$n++;

            if($rh==$n){  echo" <div class='ttb_box today'>";} else { echo" <div class='ttb_box'>";}
            echo "<div class='ttb_day '>".$jadval['ruz']['name_tj']."</div>
                    <table class='ttb_tbl'>
                        <thead>
                        <tr>
                            <td class='w1'>№</td>
                            <td class='w2'>Вақт</td>
                            <td class='w3'>
                                <div class='col-sm-6'>
                                    Фан
                                </div>
                                <div class='col-sm-6'>
                                     Омӯзор
                                </div>
                            </td>
                           <!-- <td class='w4'>Кабинет</td>-->
                        </tr>
                        </thead>
                        <tbody>";
            $s=0; foreach($jadval['satr'] as $row): $s++;
                if($s % 2 <> 0){echo" <tr class='even'>";} else{echo " <tr class=''>";}
                echo "
                                <td class='num'>".$s."</td>
                                <td class='time'>
                                    ".$row['soat']['time']."
                                </td>
                                <td class='subjs'>
                                    <div>
                                        <div class='col-sm-6'>
                                            ".$row['lesson']."
                                        </div>
                                        <div class='col-sm-6'>
                                            <span>".$row['fio_om']."</span>
                                        </div>
                                    </div>
                                </td>

                            </tr>";
            endforeach;
            echo "</tbody>
                    </table>
                </div>";
        endforeach;
        echo "</div>


            <div class='line_small' style='margin:0px 0px 0px;'>
                <a href='".\yii\helpers\Url::to('@web/index.php?r=admin/admin/lessons-table')."&id_group=".$id_group."'>
                    <span class='icon-edit'></span> Тағирдиҳи
                </a>
                <span class='divide'>|</span>

            </div>

        </div>
    </div>
</div>";



    }



    public function actionSelectIdStudent(){
        $id_student=Yii::$app->request->get('id_student');
        $student_parent=Students::find()->where(['students.id_students'=>$id_student])->
        joinWith('person')->joinWith('parent')->joinWith('person.nations')->asArray()->one();


        echo "
            <div class='row'>
    <div class='col-xs-12'>
        <div class='widget-box'>
            <div class='widget-header widget-header-flat'>
                <h4 class='widget-title smaller'>Донишҷӯ</h4>
            </div>
            <div class='row'>
                <div class='col-sm-12'>
                    <div class='col-sm-6'>
                        <div class='widget-body'>
                            <div class='widget-main'>
                                <dl id='dt-list-1' class='dl-horizontal'>
                                    <dt>Насаб ном номи падар:</dt>
                                    <dd>".$student_parent['person']['0']['surname'].' '.
            $student_parent['person']['0']['name'].' '.$student_parent['person']['0']['middle_name']."</dd>
                                    <dt>Санаи таваллуд:</dt>
                                    <dd>".$student_parent['person']['0']['brithday']."</dd>
                                    <dt>Ҷинс:</dt>
                                    <dd>";if ($student_parent['person']['0']['gender']==0){echo 'Мард';}else{echo 'Зан';}
                                    echo "</dd>
                                    <dt>Миллат:</dt>
                                    <dd>".$student_parent['person']['0']['nations']['nation_name']."</dd>

                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class='vspace-6-sm'></div>
                    <div class='col-sm-6'>
                        <div class='widget-body'>
                            <div class='widget-main'>
                                <dl id='dt-list-1' class='dl-horizontal'>
                                    <dt>Суроға:</dt>
                                    <dd>".$student_parent['person']['0']['adress']."</dd>
                                    <dt> Мактаби хатмкарда:</dt>
                                    <dd>".$student_parent['parent']['maktab']."</dd>
                                    <dt>Телефони донишҷӯ:</dt>
                                    <dd>".$student_parent['person']['0']['telefon']."</dd>

                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <div class='space'></div>
<div class='row'>
    <div class='col-xs-12'>
        <div class='col-sm-6'>
            <div class='widget-box'>
                <div class='widget-header widget-header-flat'>
                    <h4 class='widget-title smaller'>Падари донишҷӯ</h4>
                </div>
                <div class='widget-body'>
                    <div class='widget-main'>
                        <dl id='dt-list-1' class='dl-horizontal'>
                            <dt>Насаб ном номи падар</dt>
                            <dd>".$student_parent['parent']['fio_padar']."</dd>
                            <dt>Телефон:</dt>
                            <dd>".$student_parent['parent']['telefon_padar']."</dd>
                            <dt>Ҷои кор:</dt>
                            <dd>".$student_parent['parent']['joi_kor_padar']."</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div><!-- /.col -->

        <div class='vspace-6-sm'></div>

        <div class='col-sm-6'>
            <div class='widget-box'>
                <div class='widget-header widget-header-flat'>
                    <h4 class='widget-title smaller'>Модари донишҷӯ</h4>
                </div>

                <div class='widget-body'>
                    <div class='widget-main'>
                        <dl id='dt-list-1' class='dl-horizontal'>
                            <dt>Насаб ном номи падар</dt>
                            <dd>".$student_parent['parent']['fio_modar']."</dd>
                            <dt>Телефон:</dt>
                            <dd>".$student_parent['parent']['telefon_modar']."</dd>
                            <dt>Ҷои кор:</dt>
                            <dd>".$student_parent['parent']['joi_kor_modar']."</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>";
    }


    public function actionSelectGroupStudents()
    {
        $id_group = Yii::$app->request->get('id');

        $group =GroupStudents::find()->where(['group_students.id_group' => $id_group])
            ->joinWith('profession')->joinWith('faculty')
            ->joinWith('teacher.person')->asArray()
            ->one();

//        echo '<pre>';
//            print_r($group);
//        echo '</pre>';
//        exit;
            
        echo "<div class='box-body' id='content'>
                <div class='widget-box'>
            <div class='widget-header widget-header-flat'>
                <h4 class='widget-title smaller'>Гурӯҳи интихобкардашуда</h4>
            </div>
            <div class='widget-body'>
                <div class='widget-main'>
                    <div class='row' >
                        <div class='col-sm-6'>
                            <dl id='dt-list-1' class='dl-horizontal'>
                                <dt>Гурӯҳ:</dt>
                                <dd>".$group['course'].' - '.$group['profession']['0']['profession']."</dd>
                                <dt>Забони таълим:</dt>
                                <dd>".$group['language']."</dd>

                                <dt>Факултети:</dt>
                               <dd>".$group['faculty']['0']['faculty_name']."</dd>
                                <dt>Роҳбари гурӯҳ:</dt>
                                <dd>".$group['teacher']['0']['person']['0']['surname']
                                .$group['teacher']['0']['person']['0']['name']
                                .$group['teacher']['0']['person']['0']['middle_name']."</dd>
                        </div>

                    </div>

                    <div class='row' >
                        <div class='tabbable'>
                            <ul class='nav nav-tabs padding-12 tab-color-blue background-blue' id='myTab4'>
                                <li class=''>
                                    <a data-toggle='tab' class='talabagon' onclick='talabagoni($id_group)' href='#talabagon'>
<i class='green ace-icon fa fa-users bigger-120'></i>
Доношҷӯён</a>
</li>

<li>
    <a data-toggle='tab' class='jadvali_darsi' onclick='jadvali_darsi($id_group)' href='#jadvali_darsi'>
        <i class='green ace-icon fa fa-calendar bigger-120'></i>
        Ҷадвали дарси</a>
</li>

</ul>

</div>
<div class='tab-content'>
        <div id='talabagon' class='tab-pane '>
        <p>Интизор шавед рӯйхати донишҷёни гурӯҳ омода мешавад.</p>
        </div>


        <div id='jadvali_darsi' class='tab-pane '>
         <p>Интизор шавед ҷадвали дарси гурӯҳ омода мешавад.</p>
        </div>



</div>
</div>
</div>
</div>
</div>
</div>";


echo "<script type='text/javascript'>

    function talabagoni(id) {
        $.ajax({
            type: 'POST',
            url: '".\yii\helpers\Url::to('@web/index.php?r=admin/control/select-students&id_group=')."'+id,
            data: 'id_group=' + id,
            success: function (returnData) {
                if (returnData) {
                    $('#talabagon').html(returnData);
                } else {
                }
            }
        });

    };

    function jadvali_darsi(id) {
        $.ajax({
            type: 'POST',
            url: '".\yii\helpers\Url::to('@web/index.php?r=admin/control/select-table-read&id_group=')."'+id,
            data: 'id_group=' + id,
            success: function (returnData) {
                if (returnData) {
                    $('#jadvali_darsi').html(returnData);
                } else {
                }
            }
        });

    };



</script>";
    }





}
