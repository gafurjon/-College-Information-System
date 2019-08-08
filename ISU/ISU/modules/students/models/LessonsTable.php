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
class LessonsTable extends \yii\db\ActiveRecord
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
    public static function Lesson($lessons,$id_group){
        foreach($lessons as $lesson) {
            $lessontable[$lesson['id_lesson']] = LessonsTable::find()->where('id_table=' . $lesson['id_table'] . ' and id_group=' . $id_group)->asArray()->all();
        }


            return $lessontable;
    }
    public static function getLesson_rating($id_group){
        $query = new Query();
        $lessons = $query
            ->select('*')
            ->from([LessonsTable::tableName().' as lt',Lessons::tableName().' as l'])
            ->where('lt.id_lesson = l.id_lesson and lt.id_group=:id_group group by name', [':id_group' => $id_group])
            ->all();
        return $lessons;
    }


    public function getLesson()
    {
        return $this->hasOne(Lessons::className(), ['id_lesson' => 'id_lesson']);
    }

    public function getTeacher()
    {
        return $this->hasOne(Teachers::className(), ['id_teacher' => 'id_teacher']);
    }

    public static function getlessons(){
        $query = new Query();
        $result = $query
            ->select('lessons_table.id_teacher, lessons_table.id_lesson, lessons.name as lesson_name, persons.surname,persons.name,persons.middle_name')
            ->from(['lessons_table','lessons','persons','teachers'])
            ->where('lessons_table.id_lesson=lessons.id_lesson 
                AND lessons_table.id_group=:id_group
                and lessons_table.id_teacher=teachers.id_teacher
                and persons.id_persons=teachers.persons_id 
                GROUP BY lessons.name',[':id_group'=>Yii::$app->session['id_group']])
            ->all();
        return $result;
    }

    public static function getGroup($id_lesson){
        $query = new Query();
        $result = $query
            ->select('students.id_students,persons.surname,persons.name,persons.middle_name')
            ->from(['lessons_table', 'group_students', 'students', 'persons'])
            ->where('lessons_table.id_group=group_students.id_group AND lessons_table.id_group=:id_group
AND group_students.group_status=1 AND students.id_group=group_students.id_group AND
students.persons_id=persons.id_persons AND lessons_table.id_lesson='.$id_lesson.' 
group by persons.surname,persons.name,persons.middle_name',[':id_group'=>Yii::$app->session['id_group']])
            ->all();
        return $result;



    }

    public static  function getId_group($id_lesson){
        $query = new Query();
        $result = $query
            ->select('lessons_table.id_group',  "CONCAT(`group_students`.`course`, '_', `profession`.`profession`) as groupcourse,")
            ->from(['lessons_table','profession','group_students'])
            ->where('`group_students`.`id_group`=`lessons_table`.`id_group` AND `group_students`.`id_profession`=`profession`.`id_profession` and lessons_table.id_lesson=:id_lesson and lessons_table.id_teacher=:id_teacher',[':id_lesson' => $id_lesson,':id_teacher'=>\app\modules\teacher\models\Teachers::getID(Yii::$app->user->id)])
            ->all();
        return $result;

    }





    public static function getDavomot($id_group){
        $query = new Query();
        $result = $query
            ->select('lessons_table.id_lesson, lessons.name as lesson_name, persons.surname,persons.name,persons.middle_name')
            ->from(['lessons_table','lessons','persons','teachers'])
            ->where('lessons_table.id_lesson=lessons.id_lesson 
                AND lessons_table.id_group=:id_group
                and lessons_table.id_teacher=teachers.id_teacher
                and persons.id_persons=teachers.persons_id 
                GROUP BY lessons.name',[':id_group'=>$id_group])
            ->all();

           
        return $result;
    }
}
