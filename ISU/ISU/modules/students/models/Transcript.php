<?php

namespace app\modules\students\models;

use Yii;

/**
 * This is the model class for table "transcript".
 *
 * @property integer $id_transcript
 * @property integer $id_table
 * @property integer $id_students
 * @property integer $exam_mark_one
 * @property integer $exam_mark_two
 * @property integer $exam_mark_final
 * @property string $letter
 * @property integer $smestr
 *
 * @property Students $idStudents
 */
class Transcript extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transcript';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_table', 'id_students', 'exam_mark_one', 'exam_mark_two', 'exam_mark_final', 'smestr'], 'integer'],
            [['letter'], 'string', 'max' => 10],
            [['id_students'], 'exist', 'skipOnError' => true, 'targetClass' => Students::className(), 'targetAttribute' => ['id_students' => 'id_students']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_transcript' => 'Id Transcript',
            'id_table' => 'Id Table',
            'id_students' => 'Id Students',
            'exam_mark_one' => 'Exam Mark One',
            'exam_mark_two' => 'Exam Mark Two',
            'exam_mark_final' => 'Exam Mark Final',
            'letter' => 'Letter',
            'smestr' => 'Smestr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Students::className(), ['id_students' => 'id_students']);
    }

    public function getLestable()
    {
        return $this->hasOne(LessonsTable::className(), ['id_table' => 'id_table']);
    }
}
