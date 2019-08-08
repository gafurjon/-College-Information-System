<?php

namespace app\modules\teacher\models;

use app\modules\teacher\models\Week;
use Yii;
use yii\db\Query;


/**
 * This is the model class for table "journal".
 *
 * @property integer $id_baho
 * @property integer $id_students
 * @property integer $id_group
 * @property integer $id_table
 * @property string $mark
 * @property integer $asserted
 * @property string $date
 * @property string $date_save
 *
 * @property Students $idStudents
 * @property GroupStudents $idGroup
 */
class Journal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'journal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'unique'],
            [['id_students', 'id_group', 'id_table', 'asserted'], 'integer'],
            [['date', 'date_save'], 'safe'],
            [['mark'], 'string', 'max' => 2],
            [['id_students'], 'exist', 'skipOnError' => true, 'targetClass' => Students::className(), 'targetAttribute' => ['id_students' => 'id_students']],
            [['id_group'], 'exist', 'skipOnError' => true, 'targetClass' => GroupStudents::className(), 'targetAttribute' => ['id_group' => 'id_group']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_baho' => 'Id Baho',
            'id_students' => 'Id Students',
            'id_group' => 'Id Group',
            'id_table' => 'Id Table',
            'mark' => 'Mark',
            'id_mark_type' => 'Id Mark Type',
            'asserted' => 'Asserted',
            'date' => 'Date',
            'date_save' => 'Date Save',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdStudents()
    {
        return $this->hasOne(Students::className(), ['id_students' => 'id_students']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGroup()
    {
        return $this->hasOne(GroupStudents::className(), ['id_group' => 'id_group']);
    }
    public static function getDate($id_lesson,$id_teacher,$id_group){
        $query = new Query();

        $result = $query
            ->select('j.date, w.name_tj')
            ->from([Journal::tableName().' as j',LessonTime::tableName().' as ltime',LessonsTable::tableName().' as lt', Week::tableName().' as w'])
            ->where('j.`id_lesson_time`=`ltime`.`id_lesson_time` AND `ltime`.`id_table`=`lt`.`id_table` AND ltime.id_week=w.id_week AND`lt`.`id_teacher`=:id_teacher AND `lt`.`id_lesson`=:id_lessons AND `j`.`id_group`=:id_group GROUP BY j.`date`',[':id_group'=>$id_group,':id_teacher'=>$id_teacher,':id_lessons'=>$id_lesson])
            ->all();

        return $result;
    }

    public static function getMark($id_teacher, $id_group,$lesson_times){

        $query = new Query();

        $id_students = $query
            ->select('id_students')
            ->from(['journal'])
            ->where('id_group=:id_group GROUP BY id_students',[':id_group'=>$id_group])
            ->orderBy('id_mark_type')
            ->all();
    foreach($lesson_times as $lesson_time) {
	
	//debug($lesson_time);
	
        foreach ($id_students as $id_student) {
            $results = $query
                ->select('journal.id_students,journal.mark, journal.date,journal.date_save,journal.id_mark_type')
                ->from(['journal', 'lessons_table', 'lesson_time'])
                ->where('journal.id_lesson_time=lesson_time.id_lesson_time AND lessons_table.id_table=lesson_time.id_table AND journal.id_group=:id_group AND lessons_table.id_teacher=:id_teacher and journal.id_students=:id_students and journal.id_lesson_time=:id_lesson_time', [':id_group' => $id_group, ':id_teacher' => $id_teacher, ':id_students' => $id_student['id_students'], ':id_lesson_time' => $lesson_time['id_lesson_time']])
                ->orderBy('journal.date, journal.id_mark_type')
                ->all();

			

            foreach ($results as $result) {

                $mark[$id_student['id_students']][$result['date']][$result['id_mark_type']] = $result;
			
            }


        }
    }
	
	  return $mark;

		
    }


    public static function rating($groups,$lessons){
        $query = new Query();
        foreach ($groups as $group) {

            foreach($lessons as $lesson){
                for($i=1;$i<=3;$i++) {
                    $groups = $query
                        ->select('AVG(j.mark) as rating')
                        ->from([Journal::tableName() . ' as j', LessonTime::tableName() . ' as ltime', LessonsTable::tableName() . ' as ltable', Lessons::tableName() . ' as ls'])
                        ->where('j.id_lesson_time=ltime.id_lesson_time and ltime.id_table = ltable.id_table and ltable.id_lesson=ls.id_lesson and j.id_group=:id_group and ls.id_lesson=:id_lesson and j.id_mark_type=:id_mark_type', [':id_group' => $group['id_group'], ':id_lesson' => $lesson['id_lesson'],':id_mark_type'=>$i])
                        ->all();
                    $rating[$group['id_group']][$lesson['id_lesson']][$i] = $groups[0];
                }
            }


        }
        return $rating;
    }
    public static function group_rating($id_group,$lessons,$students){
        $query = new Query();
        foreach ($students as $student) {
            foreach ($lessons as $lesson) {
                for($i=1;$i<=3;$i++) {
                    $groups = $query
                        ->select('AVG(j.mark) as rating')
                        ->from([Journal::tableName() . ' as j', LessonTime::tableName() . ' as ltime', LessonsTable::tableName() . ' as ltable', 
                            Lesson::tableName() . ' as ls'])
                        ->where('j.id_lesson_time=ltime.id_lesson_time and ltime.id_table = ltable.id_table and ltable.id_lesson=ls.id_lesson 
                            and j.id_group=:id_group and ls.id_lesson=:id_lesson and j.id_students=:id_students 
                            and j.id_mark_type=:id_mark_type', [':id_group' => $id_group, ':id_lesson' => $lesson['id_lesson'], ':id_students' => $student['id_students'],':id_mark_type'=>$i])
                        ->all();
                    $rating[$student['id_students']][$lesson['id_lesson']][$i] = $groups[0];
                }
            }
        }
        return $rating;
    }
    public static function getKMD($id_group,$id_lesson_time,$id_students,$date){
        $query = new Query();
        $marks = $query
            ->select('*')
            ->from([Journal::tableName() . ' as j'])
            ->where('j.id_group=:id_group and j.id_students=:id_students and j.id_lesson_time=:id_lesson_time and j.id_mark_type=3 and j.date=:date' , [':id_group' => $id_group, ':id_lesson_time' => $id_lesson_time, ':id_students' => $id_students,':date'=>$date])
            ->all();
        return $marks;
    }

}
