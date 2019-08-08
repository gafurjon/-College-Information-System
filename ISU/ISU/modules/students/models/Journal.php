<?php

namespace app\modules\students\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "journal".
 *
 * @property integer $id_baho
 * @property integer $id_students
 * @property integer $id_group
 * @property integer $id_lesson_time
 * @property string $mark
 * @property integer $id_mark_type
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
            [['id_students', 'id_group', 'id_lesson_time', 'id_mark_type', 'asserted'], 'integer'],
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
            'id_lesson_time' => 'Id Lesson Time',
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
    public static function getMark(){
        $lessons = Lesson_table::getAll(\Yii::$app->session['id_group']);
        $lesson_days = LessonsDay::getDate();

        $r = 0;
        foreach($lessons as $lesson){
            foreach($lesson_days as $lesson_day){
                $query = new Query();
                $results[$lesson['id_lesson']][$lesson_day['datedars']] = $query
                ->select('*')
                ->from(['journal', 'lessons_table','lesson_time'])
                ->where('`journal`.`id_lesson_time`=`lesson_time`.`id_lesson_time`
AND `lesson_time`.`id_table`=`lessons_table`.`id_table` AND `lessons_table`.`id_lesson`=:id_lesson AND journal.`id_students` =:id_students AND journal.`date` =:date',[':id_lesson'=>$lesson['id_lesson'],':date'=>$lesson_day['datedars'],':id_students'=>\Yii::$app->session['id_students']])
                ->all();
        }
            foreach($lesson_days as $lesson_day){
                foreach ($results[$lesson['id_lesson']][$lesson_day['datedars']] as $result) {

                    $natija[$lesson['id_lesson']][$lesson_day['datedars']][$result['id_mark_type']] = $result;

                }

            }


            return $natija;
			
        }
    }
    public static function getAll($id_group,$id_lesson,$students,$lesson_times){
        $query = new Query();


        foreach($lesson_times as $lesson_time) {
            foreach ($students as $id_student) {
			

                $results = $query
                    ->select('journal.id_students,journal.mark, journal.date,journal.date_save,journal.id_mark_type,journal.id_lesson_time')
                    ->from(['journal', 'lessons_table', 'lesson_time'])
                    ->where('journal.id_lesson_time=lesson_time.id_lesson_time AND lessons_table.id_table=lesson_time.id_table AND journal.id_group=:id_group AND lessons_table.id_lesson=:id_lesson and journal.id_students=:id_students and journal.id_lesson_time=:id_lesson_time', [':id_group' => $id_group, ':id_lesson' => $id_lesson, ':id_students' => $id_student['id_students'], ':id_lesson_time' => $lesson_time['id_lesson_time']])
                    ->orderBy('journal.date, journal.id_mark_type')
                    ->all();


				
                foreach ($results as $result) {

                    $mark[$id_student['id_students']][$result['date']][$result['id_mark_type']] = $result;

                }


            }
        }
		
	

        return $mark;
		
    }
     public static function getDate($lesson_times,$rating_dates){
        $r=0;

        
           $date_on=$rating_dates[0]['date_on'];
           $date_off=$rating_dates[0]['date_off'];
       

        foreach($lesson_times as $lesson_time){
            
                     


            $query = new Query();
            $lesson_day[$r] = $query
                ->select('ld.id_day, ld.datedars, ld.type, w.name_tj,ld.open_close, t.id_lesson_time')
                ->from([LessonsDay::tableName().' as ld', Week::tableName().' as w', LessonTime::tableName().' as t',
                    RatingDates::tableName().' as rt'])
                ->where("ld.id_week=w.id_week and ld.id_week=:id_week and t.id_lesson_time=:id_lesson_time and 
                    ld.`datedars` BETWEEN '".$date_on."' AND '".$date_off."'" ,[':id_week'=>$lesson_time['id_week'],
                    ':id_lesson_time'=>$lesson_time['id_lesson_time']])
                ->GroupBy('datedars')
                ->all();

               



            //$lesson_day[$r] = LessonsDay::find()->where('id_week=:id_week ',[':id_week'=>$lesson_time['id_week']])->asArray()->all();
        $r++;
        }
            // sort($lesson_day);
            
               
        for($i=0;$i<=count($lesson_day[0])-1;$i++){
            for($j=0;$j<=count($lesson_day)-1;$j++){
               
                
                
                $lesson_days[$i][$j]=$lesson_day[$j][$i];

                //

            
            }

        }
       //     debug($lesson_days);
       // exit;
        return $lesson_days;
    }
    public static function getMarks($id_students,$lessons, $id_group,$lesson_times){
        $query = new Query();
        foreach($lessons as $lesson) {
            $a = (int)($lesson['id_table']);
                foreach($lesson_times[$a] as $lesson_time ) {
                    $results = $query
                        ->select('journal.id_students,journal.mark, journal.date,journal.date_save,journal.id_mark_type')
                        ->from(['journal', 'lessons_table', 'lesson_time'])
                        ->where('journal.id_lesson_time=lesson_time.id_lesson_time AND lessons_table.id_table=lesson_time.id_table AND journal.id_students=:id_students AND journal.id_group=:id_group AND lessons_table.id_lesson=:id_lesson and journal.id_lesson_time=:id_lesson_time', [':id_students' => $id_students,':id_group' => $id_group, ':id_lesson' => $lesson['id_lesson'], ':id_lesson_time' => $lesson_time['id_lesson_time']])
                        ->orderBy('journal.date, journal.id_mark_type')
                        ->all();
                    foreach ($results as $result) {
                        $marks[$lesson['id_table']][$result['date']][$result['id_mark_type']] = $result;
                    }
                }
        }
       return $marks;
    }
    public static function group_rating($id_group,$lessons,$students){
        $query = new Query();
        foreach ($students as $student) {
            foreach ($lessons as $lesson) {
                for($i=1;$i<=3;$i++) {
                    $groups = $query
                        ->select('AVG(j.mark) as rating')
                        ->from([Journal::tableName() . ' as j', LessonTime::tableName() . ' as ltime', 
                            LessonsTable::tableName() . ' as ltable', Lessons::tableName() . ' as ls',
                            RatingDates::tableName() .' as rd', GroupStudents::tableName().' as gs' ])
                        ->where('j.id_lesson_time=ltime.id_lesson_time and ltime.id_table = ltable.id_table 
                            and ltable.id_lesson=ls.id_lesson and j.id_group=gs.id_group and 
                            gs.course=rd.course and j.date >= rd.date_on and j.date <= rd.date_off
                            and rd.status=1 and j.id_group=:id_group 
                            and ls.id_lesson=:id_lesson and j.id_students=:id_students 
                            and j.id_mark_type=:id_mark_type', [':id_group' => $id_group, 
                            ':id_lesson' => $lesson['id_lesson'], ':id_students' => $student['id_students'],
                            ':id_mark_type'=>$i])
                        ->all();
                    $rating[$student['id_students']][$lesson['id_lesson']][$i] = $groups[0];
                }
            }
        }
        return $rating;
    }
	
	
	
	public static function getBaho($id_group,$id_lessons,$lesson_times){

        $query = new Query();

        $id_students = $query
            ->select('id_students')
            ->from(['journal'])
            ->where('id_group=:id_group GROUP BY id_students',[':id_group'=>$id_group])
            ->orderBy('id_mark_type')
            ->all();
			
		sort($lesson_times);	
    foreach($lesson_times as $lesson_time) {
	//debug($lesson_time);
        foreach ($id_students as $id_student) {
            $results = $query
                ->select('lesson_time.id_lesson_time, journal.id_students,journal.mark, journal.date,journal.date_save,journal.id_mark_type')
                ->from(['journal', 'lessons_table', 'lesson_time'])
                ->where('journal.id_lesson_time=lesson_time.id_lesson_time AND lessons_table.id_table=lesson_time.id_table AND journal.id_group=:id_group AND lessons_table.id_lesson=:id_lesson and journal.id_students=:id_students and journal.id_lesson_time=:id_lesson_time', [':id_group' => $id_group, ':id_lesson' => $id_lessons, ':id_students' => $id_student['id_students'], ':id_lesson_time' => $lesson_time['id_lesson_time']])
                ->orderBy('journal.date, journal.id_mark_type')
                ->all();

			
			
            foreach ($results as $result) {
				
                $mark[$id_student['id_students']][$result['date']][$result['id_mark_type']] = $result;
		
            }


        }
    }
	
	
        return $mark;

		
    }



    public static function getNest($id_students,$lessons){
        $query = new Query();
       
                    $results = $query
                        ->select('journal.id_students,journal.mark, journal.date,journal.date_save,journal.id_mark_type')
                        ->from(['journal', 'lessons_table', 'lesson_time'])
                        ->where('journal.id_lesson_time=lesson_time.id_lesson_time AND lessons_table.id_table=lesson_time.id_table AND journal.id_students=:id_students AND journal.id_group=:id_group AND lessons_table.id_lesson=:id_lesson and journal.id_lesson_time=:id_lesson_time', [':id_students' => $id_students,':id_group' => $id_group, ':id_lesson' => $lesson['id_lesson'], ':id_lesson_time' => $lesson_time['id_lesson_time']])
                        ->orderBy('journal.date, journal.id_mark_type')
                        ->all();
          
       return $marks;
    }
	
}
