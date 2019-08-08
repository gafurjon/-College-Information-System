<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\GroupStudents;
use app\modules\admin\models\LessonsTable;
use app\modules\admin\models\Transcript;
use \app\modules\admin\models\Students;


class QarzdoronController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $model = new GroupStudents();
        $data = GroupStudents::getId_group();
        sort($data);


        return $this->render('index', compact('data', 'model'));

    } //Shud


    public function actionQarzdoroniguruh($id_group)
    {
        
        $this->layout = false;
        $students = Students::getStudents($id_group);

        $qarzdoron= Students::getQarzoron($id_group);

        //debug($qarzdoron);
       return $this->render('qarzdoroniguruh', compact('students', 'qarzdoron'));
    }


    public function actionSelect_qarzho($id_students){

        $qarzho=Transcript::getQarzho($id_students);
        $lesson_table=LessonsTable::find()->
        joinWith('lesson.lessons')->
        all();

        // debug($lesson_table);
        // exit;



        echo "<table id='qarzho' border='1px'  width='495px' height='82px'>
    <tbody><tr>
        <th><p align='center'>#</p></th>
        <th><p align='center'>Номи фан</p></th>
        <th><p align='center'>Устод</p></th>
        <th><p align='center'>Маркази тестӣ</p></th>
    </tr>";

        $r=1; foreach($qarzho as $qarz){

            foreach ($lesson_table as $lesson){
                //echo $lesson['id_table'];
                if($lesson['id_table']== $qarz['id_table']){
                    $name=$lesson['lesson']['0']['name'];
                    $kredit=$lesson['lesson']['0']['lessons']['lesson_kredit'];

                    echo " <tr>
        <th>$r.</th>
        <td>$name. Kредит ба ин фан $kredit</td>
        <td colspan='2'>Ҳоло ба ин фан донишҷӯ кредит нахаридааст.</td>
    </tr>";
                }
            }
            $r++;
        }


        echo "</tbody></table></td>";
    }
}
