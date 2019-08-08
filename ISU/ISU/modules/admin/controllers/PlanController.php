<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\GroupStudents;
use app\modules\admin\models\LessonGroup;
use app\modules\admin\models\Lessons;
use Yii;

class PlanController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $model = new GroupStudents();

        $data = GroupStudents::getId_group();
        sort($data);

//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';
        return $this->render('index', compact('data', 'model'));
    } //Shud

    public function actionPlan()
    {
        $id_group = Yii::$app->request->get('id_group');
		//$cource=2;
		
		
        $this->layout = false;


        $groups = GroupStudents::find()->where(['id_group' => $id_group])->joinWith('profession')->asArray()->all();
		
		if($groups[0]['course']==2){
		
		//$lesson = Lessons::find()->where(['lessons.id_profession' => $groups[0]['id_profession'], 'lessons.smestr' =>1, 'lessons.smestr'=> 2])->asArray()->groupBy('name')->all();
		$lesson = Yii::$app->db->createCommand('SELECT * FROM `lessons` as ls, `lesson` as l
		WHERE ls.`id_profession`='.$groups[0]['id_profession'].'
		AND ls.id_lesson=l.id_lesson 
		GROUP BY l.NAME')->queryAll();
		
		}
		elseif($groups[0]['course']==1){
		
		//$lesson = Lessons::find()->where(['lessons.id_profession' => $groups[0]['id_profession'], 'lessons.smestr' =>1, 'lessons.smestr'=> 2])->asArray()->groupBy('name')->all();
		$lesson = Yii::$app->db->createCommand('SELECT * FROM `lessons` as ls, `lesson` as l
        WHERE ls.`id_profession`='.$groups[0]['id_profession'].'
        AND ls.id_lesson=l.id_lesson 
        GROUP BY l.NAME')->queryAll();
		
		}
		
		elseif($groups[0]['course']==3){
		
		//$lesson = Lessons::find()->where(['lessons.id_profession' => $groups[0]['id_profession'], 'lessons.smestr' =>1, 'lessons.smestr'=> 2])->asArray()->groupBy('name')->all();
$lesson = Yii::$app->db->createCommand('SELECT * FROM `lessons` as ls, `lesson` as l
        WHERE ls.`id_profession`='.$groups[0]['id_profession'].'
        AND ls.id_lesson=l.id_lesson 
        GROUP BY l.NAME')->queryAll();
		
		}
		else{
		$lesson = Yii::$app->db->createCommand('SELECT * FROM `lessons` as ls, `lesson` as l
        WHERE ls.`id_profession`='.$groups[0]['id_profession'].'
        AND ls.id_lesson=l.id_lesson  
        GROUP BY l.NAME')->queryAll();
		}
		
        


        $k = 0;
        foreach ($groups as $row) {
            $n = 0;
            $ms[$k] = $row;
            foreach ($lesson as $pow) {
               
               


                $mss[$n] = $pow;
                $mq = LessonGroup::find()->select('count_time')->where(['id_group' => $row['id_group'],
                    'id_lesson' => $pow['id_lesson']])->one();
                $mq = $mq['count_time'];
                if ($mq > 0) {
                    $mss[$n]['mq'] = $mq;
                } else {
                    $mss[$n]['mq'] = 0;
                }
                $n++;
            }
            $ms[$k]['fanhoi'] = $mss;
            $k++;

        }


        //return $this->render('plan', compact('ms', 'lesson'));

        echo "<link href='/web/admin/css/bootstrap-editable.css' rel='stylesheet'>
<style>
            .corner-frame {
        float: left;
    }

            .scrollable-rows-frame {
        float: left;
        overflow: hidden;
    }

            .scrollable-columns-frame {
        overflow: hidden;
    }

            .scrollable-data-frame {
        overflow: auto;
    }

            table.data th, table.data td {
        font-family: 'Palatino Linotype';
                font-size: 14px;
                padding: 2px;
                border: 1px solid grey;
                border-spacing: 0px;
            }
            .ss{
        -moz-transform: rotate(0deg);
        -webkit-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        writing-mode: tb-rl;
    }
</style>


<table id='ExampleTable' class='data table table-striped table-bordered table-hover' cellpadding='0' cellspacing='0'>
<div id='content'></div>

 <thead>
    <tr>
        <th style='height:260px'><p class='ss'><br><br>Фанҳо/
    Гурӯҳҳо<br><br><br></p></th>";
         $i = 0;
        foreach ($lesson as $row) {
            $i++;
           echo "<th  style='height:260px'><p class='ss table-striped float-center'><bold>". $row['name']."</bold></p></th>";
        }

        echo "</tr>
        </thead>
        <tbody class='table table-striped table-bordered table-hover float center'>";

       foreach ($ms as $row) {

           echo "<tr ><td>".$row['course'].' '.$row['profession']['0']['profession']. "</td>";
           if(!empty($row['fanhoi'])){
           foreach ($row['fanhoi'] as $pow) {
           	 echo "<td ><a class='s'  href='#' id='".$pow['name']."'
            data-type='text' data-pk=".$row['id_group']."
            data-url='".\yii\helpers\Url::to('@web/index.php?r=admin/control/insert-table')."' >".$pow['mq']."</a></td>";}



              
        }
         else echo 'Маълумот вуҷуд надорад!!!';
        echo "</tr>";
    }

   echo "</tbody>
</table>

        <div id='scrollableTable'></div>

<script language='javascript' src='/web/admin/js/tablescroller.js'></script>
<script language='javascript' src='/web/admin/js/tablescroller.jquery.js'></script>

<script type='text/javascript' defer async>
    var options = {
        width: '99%',
        pinnedRows: 0,
        height: 300+(($('#ExampleTable tr').length - 1)*20),
        pinnedCols: 1,
        container: '#scrollableTable',
        removeOriginal: true
    };

           $('#ExampleTable').tablescroller(options);

           </script>


<script src='/web/admin/js/bootstrap-editable.js'></script>

<script>
           //turn to inline mode
           $.fn.editable.defaults.mode = 'popup';
    $(document).ready(function() {
        $('.s').editable();
    });
</script>";
    } //Шудаги 100%

}
