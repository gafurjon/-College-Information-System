<?php

namespace app\modules\teacher\models;

use Yii;
use yii\db\Query;

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
 * @property Profession $profession0
 * @property Students $idGroup
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
            [['course', 'id_profession', 'group_status'], 'integer'],
            [['year', 'final_year'], 'safe'],
            [['language', 'faculty', 'type_training'], 'string', 'max' => 50],
            [['id_profession'], 'exist', 'skipOnError' => true, 'targetClass' => Profession::className(), 'targetAttribute' => ['id_profession' => 'id_profession']],
            [['id_group'], 'exist', 'skipOnError' => true, 'targetClass' => Students::className(), 'targetAttribute' => ['id_group' => 'id_group']],
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
            'id_profession' => 'Id Profession',
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
    public function getProfession()
    {
        return $this->hasOne(Profession::className(), ['id_profession' => 'id_profession']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGroup()
    {
        return $this->hasOne(Students::className(), ['id_group' => 'id_group']);
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
    public static function getAll(){

        $query = new Query();

        $groups = $query
            ->select('*')
            ->from(['group_students'." as gr",'profession'." as p"])
            ->where('gr.id_profession = p.id_profession')
            ->orderBy('gr.course')
            ->all();
        return $groups;
    }
    public static function getGroup($id_group){
        $query = new Query();

        $groups = $query
            ->select('*')
            ->from(['group_students'." as gr",'profession'." as p"])
            ->where('gr.id_profession = p.id_profession and gr.id_group='.$id_group)
            ->orderBy('gr.course')
            ->all();
        return $groups;
    }



     


    public static  function getId_group(){
        $defis='_';
        $query = new Query();
        $result = $query
            ->select('group_students.id_profession, group_students.id_group', "CONCAT(`group_students`.`course`, '_', `profession`.`profession`) as groupcourse,")
            ->from(['profession','group_students'])
            ->where('`group_students`.`id_profession`=`profession`.`id_profession` ')
            ->all();
        return $result;

    }
}
