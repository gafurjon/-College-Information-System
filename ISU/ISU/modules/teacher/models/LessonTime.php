<?php

namespace app\modules\teacher\models;
use yii\db\Query;
use Yii;

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
        $lesson_time = LessonTime::find()->where('id_table=:id_table',[':id_table'=>$id_table])->
		orderby(['id_week'=>SORT_ASC])->asArray()->all();
        return $lesson_time;
    }



        public static  function getId_group($id_week,$id_time_lesson){
        $query = new Query();
        $result = $query
            ->select('MAX(`id_lesson_time`')
            ->from(['lesson_time'])
            ->where('lesson_time.id_week=:week  and id_time_lesson=:id_time_lesson',[':week' => $id_week, ':id_time_lesson'=>$id_time_lesson])
            ->one();
        return $result;

    }
}
