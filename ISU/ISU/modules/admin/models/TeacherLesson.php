<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "teacher_lesson".
 *
 * @property integer $id_lesson_teacher
 * @property integer $id_teacher
 * @property integer $id_lesson
 */
class TeacherLesson extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teacher_lesson';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_teacher', 'id_lesson'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_lesson_teacher' => 'Id Lesson Teacher',
            'id_teacher' => 'Id Teacher',
            'id_lesson' => 'Id Lesson',
        ];
    }

    public function getLesson()
    {
        return $this->hasOne(Lesson::className(), ['id_lesson' => 'id_lesson'] );
    }

    public function getTeacher()
    {
        return $this->hasOne(Teachers::className(), ['id_teacher' => 'id_teacher'] );
    }
}
