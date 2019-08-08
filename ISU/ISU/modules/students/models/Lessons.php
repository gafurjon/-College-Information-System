<?php

namespace app\modules\students\models;

use Yii;

/**
 * This is the model class for table "lessons".
 *
 * @property integer $id_lesson
 * @property integer $category_id
 * @property string $name
 * @property integer $code_lessons
 * @property integer $lesson_kredit
 * @property integer $status
 *
 * @property LessonGroup[] $lessonGroups
 * @property LessonCategory $category
 */
class Lessons extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lessons';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'code_lessons', 'lesson_kredit', 'status'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => LessonCategory::className(), 'targetAttribute' => ['category_id' => 'id_category']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_lesson' => 'Id Lesson',
            'category_id' => 'Category ID',
            'name' => 'Name',
            'code_lessons' => 'Code Lessons',
            'lesson_kredit' => 'Lesson Kredit',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLessonGroups()
    {
        return $this->hasMany(LessonGroup::className(), ['id_lesson' => 'id_lesson']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(LessonCategory::className(), ['id_category' => 'category_id']);
    }
}
