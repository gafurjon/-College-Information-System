<?php

namespace app\modules\students\models;


use Yii;
use yii\db\Query;

/**
 * This is the model class for table "lessons_table".
 *
 * @property integer $id_table
 * @property integer $id_lesson
 * @property integer $id_teacher
 * @property integer $id_group
 */
class Lesson_table extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lessons_table';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_lesson', 'id_teacher', 'id_group'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_table' => 'Id Table',
            'id_lesson' => 'Id Lesson',
            'id_teacher' => 'Id Teacher',
            'id_group' => 'Id Group',
        ];
    }
    public static function getLesson($id_group,$id_week){
        $query = new Query();
        $result = $query
            ->select('persons.surname,persons.name,persons.middle_name,lessons.name,Week.name_tj,lesson_time.id_time_lesson')
            ->from(['lessons_table','lesson_time','lessons','WEEK', 'teachers', 'persons'])
            ->where('`lessons_table`.`id_table`=`lesson_time`.`id_table` and `lesson_time`.`id_week`=`Week`.`id_week`
and `lessons_table`.`id_teacher`=`teachers`.`id_teacher` and `persons`.`id_persons`=`teachers`.`persons_id`
and `lessons_table`.`id_lesson`=`lessons`.`id_lesson` and `lessons_table`.`id_group`=:id_group and lesson_time.id_week=:id_week ',[':id_group'=>$id_group,':id_week'=>$id_week])
            ->all();
        return $result;
    }
    public static function getAll($id_group){
        $query = new Query();
        $result = $query
            ->select('lessons.smestr as smestr,lessons.name as lesson_name,Lessons_table.id_table,lessons_table.id_lesson,Persons.surname as persons_surname,Persons.name as persons_name,Persons.middle_name as persons_middle_name,Persons.picture as persons_picture')
            ->from([Lesson_table::tableName(),Lessons::tableName(),Teachers::tableName(),Persons::tableName()])
            ->where('lessons_table.id_lesson=lessons.id_lesson and lessons_table.id_teacher=teachers.id_teacher and teachers.persons_id=persons.id_persons and lessons_table.id_group=:id_group group by lessons.name',[':id_group'=>$id_group])
            ->all();
        return $result;
    }
}
