<?php

namespace app\modules\students\controllers;

use app\modules\students\models\GroupStudents;
use app\modules\students\models\Students;
use Yii;
use \yii\web\Controller;


class TablereadController extends Controller
{
    public function actionIndex()
    {
        $students = Students::getAll(\Yii::$app->user->id);

        $id_s=$students['id_group'];
        $group = GroupStudents::find()->joinWith('profession')->where(['id_group' => $id_s])->all();
        $ms = array();
        $n = 0;

        for ($i = 1; $i <= 7; $i++) {
            $n++;
            $ruz = array();
            $j = 0;
            $ruz[$j]['soat'] = Yii::$app->db->createCommand('select time from time_lesson where id_time_lesson=' . $i)->queryOne();

            for ($j = 1; $j < 7; $j++) {
                $les_table = Yii::$app->db->createCommand('SELECT `lessons_table`.`id_table`,`lesson_time`.`id_week`,`lesson_time`.`id_time_lesson`,`lessons_table`.`id_lesson`
,`lessons`.`name`,`lessons_table`.`id_teacher` FROM `lessons_table`,`lessons`, `lesson_time`
WHERE `lessons_table`.`id_table`=`lesson_time`.`id_table`
AND `lessons_table`.`id_lesson`=`lessons`.`id_lesson`
AND `lessons_table`.`id_group`=' . $id_s . ' AND `lesson_time`.`id_week`=' . $j . ' AND `lesson_time`.`id_time_lesson`=' . $i)->queryAll();


                if (!empty($les_table)) {
                    foreach ($les_table as $lesson_table) {

                        $ruz[$j]['id_lesson'] = $lesson_table['id_table'];
                        $ruz[$j]['lesson'] = $lesson_table['name'];

                        $teacher = Yii::$app->db->createCommand("SELECT `teachers`.`id_teacher`,`persons`.`surname`,`persons`.`name`,`persons`.`middle_name` FROM `teachers`, `persons`
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

        return $this->render('tableread', compact('ms', 'group'));
    } //Shud




}
