<?php

namespace app\modules\students\models;

use app\modules\admin\models\Profession;
use Yii;

/**
 * This is the model class for table "group_students".
 *
 * @property integer $id_group
 * @property integer $course
 * @property integer $profession
 * @property string $language
 * @property string $faculty
 * @property string $type_training
 * @property string $year
 * @property string $final_year
 * @property integer $group_status
 *
 * @property Exam[] $exams
 * @property Journal[] $journals
 * @property LessonGroup[] $lessonGroups
 */
class GroupStudents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group_students';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course', 'profession', 'group_status'], 'integer'],
            [['year', 'final_year'], 'safe'],
            [['language', 'faculty', 'type_training'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_group' => 'Id Group',
            'course' => 'Course',
            'profession' => 'Profession',
            'language' => 'Language',
            'faculty' => 'Faculty',
            'type_training' => 'Type Training',
            'year' => 'Year',
            'final_year' => 'Final Year',
            'group_status' => 'Group Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExams()
    {
        return $this->hasMany(Exam::className(), ['id_group' => 'id_group']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJournals()
    {
        return $this->hasMany(Journal::className(), ['id_group' => 'id_group']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLessonGroups()
    {
        return $this->hasMany(LessonGroup::className(), ['id_group' => 'id_group']);
    }

    public function getProfession()
    {
        return $this->hasMany(Profession::className(), ['id_profession' => 'id_profession']);
    }
}
