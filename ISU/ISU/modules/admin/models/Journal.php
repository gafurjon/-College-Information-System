<?php

namespace app\modules\admin\models;

use Yii;

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
}
