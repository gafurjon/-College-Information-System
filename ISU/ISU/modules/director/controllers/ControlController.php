<?php

namespace app\modules\director\controllers;

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
                url: '".\yii\helpers\Url::to('@web/index.php?r=director/control/select-id-student&id_student=')."'+id,
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
            url: '".\yii\helpers\Url::to('@web/index.php?r=director/control/select-students&id_group=')."'+id,
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
            url: '".\yii\helpers\Url::to('@web/index.php?r=director/control/select-table-read&id_group=')."'+id,
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
    <link href='/web/admin/timetable_files/subdomain.css' type='text/css' rel='stylesheet'>";

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


           

        </div>
    </div>
</div>";
    }





}
