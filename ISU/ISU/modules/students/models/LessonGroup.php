<?php

namespace app\modules\students\models;

use Yii;

/**
 * This is the model class for table "lesson_group".
 *
 * @property integer $id_lesson_group
 * @property integer $id_lesson
 * @property integer $id_group
 * @property integer $count_time
 * @property integer $count
 *
 * @property Lessons $idLesson
 * @property GroupStudents $idGroup
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
            [['id_lesson', 'id_group', 'count_time', 'count'], 'integer'],
            [['id_lesson'], 'exist', 'skipOnError' => true, 'targetClass' => Lessons::className(), 'targetAttribute' => ['id_lesson' => 'id_lesson']],
            [['id_group'], 'exist', 'skipOnError' => true, 'targetClass' => GroupStudents::className(), 'targetAttribute' => ['id_group' => 'id_group']],
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
            'count' => 'Count',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdLesson()
    {
        return $this->hasOne(Lessons::className(), ['id_lesson' => 'id_lesson']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGroup()
    {
        return $this->hasOne(GroupStudents::className(), ['id_group' => 'id_group']);
    }
    public static function getCount($id_lesson,$id_group){
        $count = LessonGroup::find()->where('id_lesson = '.$id_lesson.' and id_group = '.$id_group)->asArray()->all();
        return $count;
    }
}
