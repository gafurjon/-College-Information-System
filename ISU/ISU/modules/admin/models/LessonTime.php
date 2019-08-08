<?php

namespace app\modules\admin\models;

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



    public function getLessonTable()
    {
        return $this->hasMany(LessonsTable::className(), ['id_table' => 'id_table'] );
    }

    public function getWeekName()
    {
        return $this->hasOne(Week::className(), ['id_week' => 'id_week'] );
    }

    public function getTimeLesson()
    {
        return $this->hasMany(TimeLesson::className(), ['id_time_lesson' => 'id_time_lesson'] );
    }

}
