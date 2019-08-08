<?php

namespace app\modules\dekanifakultet\controllers;

use app\modules\admin\models\GroupStudents;
use app\modules\admin\models\LessonsTable;
use app\modules\admin\models\TimeLesson;
use app\modules\admin\models\Week;
use Yii;

class LessontableController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $model = new GroupStudents();
        $data = GroupStudents::getId_group();

        return $this->render('index', compact('data', 'model'));
    } //Shud

    public function actionLessonsTable()
    {
        $this->layout = false;
        $id_group = Yii::$app->request->get('id_group');
        $create = 'lessons_table';
        $group = GroupStudents::find()->joinWith('profession')->all();

        $groups = GroupStudents::find()->where(['id_group' => $id_group])->joinWith('profession')->asArray()->all();
        $week = Week::find()->all();
        $timelesson = TimeLesson::find()->all();
        $lessontable = LessonsTable::find()->joinWith('lesson')->joinWith('group')->
        joinWith('lessonTime.timeLesson')->all();


        $ms = array();
        $n = 0;
        for ($i = 1; $i < 7; $i++) {
            $n++;
            if ($week[$n]['id_week'] == $i) {
                $ms[$i]['ruz'] = $week[$n]['name_tj'];
            }


            $ruz = array();
            $ltt = 0;
            for ($j = 1; $j <= count($timelesson); $j++) {
                if ($timelesson[$ltt]['id_time_lesson'] == $j
                    && $lessontable[$ltt]['lessonTime']['id_week'] == $i
                ) {
                    $ruz[$j]['soat'] = $timelesson[$ltt]['time'];
                }

                $lessonstable = LessonsTable::find()->joinWith('lesson')->joinWith('group')->
                joinWith('lessonTime.timeLesson')->
                where(['lesson_time.id_time_lesson' => $j,
                    'lesson_time.id_week' => $i, 'lessons_table.id_group' => $id_group])->one();

                if (!empty($lessonstable)) {

                    $ruz[$j]['id_fan'] = $lessonstable['id_lesson'];
                    $ruz[$j]['fan'] = $lessonstable['lesson']['0']['name'];
                    $ruz[$j]['id_om'] = $lessonstable['id_teacher'];

                    $Persons = LessonsTable::find()->where(['lessons_table.id_table' => $lessonstable['id_table']])->joinWith('teacher.person')->one();

                    if (!empty($Persons)) {
                        $ruz[$j]['fio_om'] = $Persons['teacher']['person']['0']['surname'] . ' ' .
                            $Persons['teacher']['person']['0']['name'];
                    } else $ruz[$j]['fio_om'] = 'Интихоб нашудааст';


                } else {
                    $ruz[$j]['id_fan'] = 0;
                    $ruz[$j]['fan'] = '';
                    $ruz[$j]['id_om'] = 0;
                    $ruz[$j]['fio_om'] = '';
                }
                $ltt++;
            }
            $ms[$i]['satr'] = $ruz;
        }

        return $this->render($create, compact('ms', 'groups', 'group'));

    }// 100000000000%

}
