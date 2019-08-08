<?php

namespace app\modules\admin\models;

use Yii;

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
            [['id_lesson', 'id_teacher', 'id_group'], 'integer']
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

    public function getTeacher()
    {
        return $this->hasOne(Teachers::className(), ['id_teacher' => 'id_teacher'] );
    }

    public function getLessonTime()
    {
        return $this->hasOne(LessonTime::className(), ['id_table' => 'id_table']);
    }

    public function getLesson()
    {
        return $this->hasMany(Lesson::className(), ['id_lesson' => 'id_lesson'] );
    }

    public function getGroup()
    {
        return $this->hasMany(GroupStudents::className(), ['id_group' => 'id_group'] );
    }
}
