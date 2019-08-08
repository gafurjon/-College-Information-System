<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "lesson_group".
 *
 * @property integer $id_lesson_group
 * @property integer $id_lesson
 * @property integer $id_group
 * @property integer $count_time
 */
class LessonGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lesson_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_lesson', 'id_group', 'count_time'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_lesson_group' => 'Id Lesson Group',
            'id_lesson' => 'Id Lesson',
            'id_group' => 'Id Group',
            'count_time' => 'Count Time',
        ];
    }

    public function getLesson()
    {
        return $this->hasMany(Lessons::className(), ['id_lesson' => 'id_lesson'] );
    }

    public function getGroup()
    {
        return $this->hasMany(GroupStudents::className(), ['id_group' => 'id_group'] );
    }



}
