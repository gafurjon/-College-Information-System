<?php

namespace app\modules\admin\models;

use Yii;
use yii\db\Query;

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


    public static function getQarzho($id_students){
        $query = new Query();
        $qarzhoi_donishju = $query
            ->select('*')
            ->from([Transcript::tableName()])
            ->where("`transcript`.`id_students`=".$id_students." AND 
            `transcript`.`letter`='F' ")
            ->all();
        return $qarzhoi_donishju;
    }
}
