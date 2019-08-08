<?php

namespace app\modules\teacher\models;

use app\modules\teacher\models\GroupStudents;
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
    public function getLessons()
    {
        return $this->hasOne(Lessons::className(), ['id_lesson' => 'id_lesson']);
    }
    public static function getlesson(){
        $query = new Query();
        $result = $query
            ->select('lessons_table.id_lesson,lesson.name')
            ->from(['lessons_table','lesson'])
            ->where('lessons_table.id_lesson=lesson.id_lesson AND lessons_table.id_teacher=:id_teacher 
                GROUP BY lesson.name',[':id_teacher'=>\app\modules\teacher\models\Teachers::getID(Yii::$app->user->id)])
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
    public static function getGroup($id_lesson,$id_teacher,$id_group){
        $query = new Query();
        $result = $query
            ->select('students.id_students,persons.surname,persons.name,persons.middle_name')
            ->from(['lessons_table', 'group_students', 'students', 'persons'])
            ->where('lessons_table.id_group=group_students.id_group AND lessons_table.id_group=:id_group
AND group_students.group_status=1 AND students.id_group=group_students.id_group AND
students.persons_id=persons.id_persons AND lessons_table.id_teacher='.$id_teacher.' AND lessons_table.id_lesson='.$id_lesson.' group by persons.surname,persons.name,persons.middle_name',[':id_group'=>$id_group])
            ->all();
        return $result;



    }
    public static function Lesson($id_lesson,$id_group,$id_teacher){
        $lessontable = LessonsTable::find()->where('id_lesson='.$id_lesson.' and id_group='.$id_group.' and id_teacher='.$id_teacher)->asArray()->all();
        return $lessontable;
    }
    public static function getLesson_rating($id_group){
        $query = new Query();
        $lessons = $query
            ->select('*')
            ->from([LessonsTable::tableName().' as lt',Lesson::tableName().' as l'])
            ->where('lt.id_lesson = l.id_lesson and lt.id_group=:id_group', [':id_group' => $id_group])
            ->orderBy('l.name')
            ->all();
    return $lessons;
    }
    public static function getLesson_and_profession($id_teacher){
        $query = new Query();
        $resault = $query
            ->select('j.id_group,`j`.`id_lesson_time`,`j`.`date`,`l`.`name`,`p`.`profession`,`gs`.`course`')
            ->from([Journal::tableName().' as j',LessonTime::tableName().' as ltime',
                LessonsTable::tableName().' as ltable', Lesson::tableName().' as l',
                GroupStudents::tableName().' as gs',Profession::tableName().' as p'])
            ->where('`j`.`id_lesson_time`=`ltime`.`id_lesson_time`
            AND j.`id_group`=gs.`id_group`
            AND `p`.`id_profession`=`gs`.`id_profession`
            AND `ltime`.`id_table`=`ltable`.`id_table`
            AND `ltable`.`id_lesson`=`l`.`id_lesson`
            AND  j.id_mark_type = 3 and ltable.id_teacher='.$id_teacher)
            ->groupBy('j.id_lesson_time')
            ->all();
        $r=0;

        

        foreach ($resault as $lesson) {
            $lessons[$r] = $lesson;
            $lessons[$r]['concat']=$lesson['name'].' -> '.$lesson['profession'].'-'.$lesson['course'];
            $lessons[$r]['time_and_date']=$lesson['id_lesson_time'].','.$lesson['id_group'];
            $r++;
        }


        return $lessons;
    }
    public static function getKmd($id_lesson_time,$id_group){
        $query = new Query();
        $resault = $query
            ->select('j.id_group,`j`.`id_lesson_time`,`j`.`date`,`l`.`name`,`p`.`profession`,`gs`.`course`')
            ->from([Journal::tableName().' as j',LessonTime::tableName().' as ltime',LessonsTable::tableName().' as ltable', Lesson::tableName().' as l',GroupStudents::tableName().' as gs',Profession::tableName().' as p'])
            ->where('`j`.`id_lesson_time`=`ltime`.`id_lesson_time`
AND j.`id_group`=gs.`id_group`
AND `p`.`id_profession`=`gs`.`id_profession`
AND `ltime`.`id_table`=`ltable`.`id_table`
AND `ltable`.`id_lesson`=`l`.`id_lesson`
AND  j.id_mark_type = 3 and j.id_lesson_time=:id_lesson_time and j.id_group=:id_group',[':id_lesson_time'=>$id_lesson_time,':id_group'=>$id_group])
            ->groupBy('j.date')
            ->all();
        $r=0;
        foreach ($resault as $lesson) {
            $lessons[$r] = $lesson;
            $lessons[$r]['concat']='КМД - и '.$lesson['date'];
            $lessons[$r]['time_and_date']=$lesson['id_lesson_time'].','.$lesson['id_group'].','.$lesson['date'];
            $r++;
        }


        return $lessons;
    }
}
