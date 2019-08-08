<?php

namespace app\modules\students\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "lesson_time".
 *
 * @property integer $id_lesson_time
 * @property integer $id_table
 * @property integer $id_week
 * @property integer $id_time_lesson
 */
class LessonTime extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lesson_time';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_table', 'id_week', 'id_time_lesson'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_lesson_time' => 'Id Lesson Time',
            'id_table' => 'Id Table',
            'id_week' => 'Id Week',
            'id_time_lesson' => 'Id Time Lesson',
        ];
    }
    public static function getAll($id_table){

        foreach($id_table as $id){
            $lesson_time[$id[0]['id_table']] = LessonTime::find()->where('id_table=:id_table order by id_week',[':id_table'=>$id[0]['id_table']])->asArray()->all();
        }

        return $lesson_time;
    }
    public static function getOne($id_group,$id_lesson){


        $query = new Query();
        $result = $query
            ->select('*')
            ->from([LessonTime::tableName(),LessonsTable::tableName()])
            ->where('`lesson_time`.`id_table`=`lessons_table`.`id_table` AND `lessons_table`.`id_lesson`=:id_lesson AND `lessons_table`.`id_group`=:id_group',[':id_group'=>$id_group,':id_lesson'=>$id_lesson])
            ->orderBy('id_week')
            ->all();
        return $result;



    }
}
