<?php

namespace app\modules\bakaydgiri\models;

use Yii;

/**
 * This is the model class for table "lessons".
 *
 * @property integer $id_lessons
 * @property integer $id_profession
 * @property integer $id_kafedra
 * @property integer $category_id
 * @property string $name
 * @property integer $code_lessons
 * @property integer $lesson_kredit
 * @property integer $smesrt
 * @property integer $status
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
            [['id_profession', 'id_kafedra', 'category_id', 'id_lesson','code_lessons', 
            'lesson_kredit', 'smestr', 'status'], 'integer'],
             [['studies_year'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_lessons' => 'Id Lessons',
            'id_profession' => 'Id Profession',
            'id_kafedra' => 'Id Kafedra',
            'id_lesson' => 'Id Lesson',
            'category_id' => 'Category ID',
            //'name' => 'Name',
            'code_lessons' => 'Code Lessons',
            'lesson_kredit' => 'Lesson Kredit',
            'studies_year' =>  'Studies Year',
            'smestr' => 'smestr',
            'status' => 'Status',
        ];
    }


    public function getLesson()
    {
        return $this->hasOne(Lesson::className(), ['id_lesson' => 'id_lesson']);
    }

}
