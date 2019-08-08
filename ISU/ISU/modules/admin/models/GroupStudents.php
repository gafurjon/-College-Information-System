<?php

namespace app\modules\admin\models;

use  \yii\db\ActiveRecord;
use yii\db\Query;

/**
 * This is the model class for table "group_students".
 *
 * @property integer $id_group
 * @property integer $course
 * @property string $profession
 * @property string $language
 * @property string $faculty
 * @property string $type_training
 * @property string $year
 * @property integer $group_status
 */
class GroupStudents extends ActiveRecord
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
            [['course', 'group_status'], 'integer'],
            [['year'], 'safe'],
            [['profession'], 'string', 'max' => 20],
            [['language', 'faculty', 'type_training'], 'string', 'max' => 50]
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
            'group_status' => 'Group Status',
        ];
    }

    public function getProfession()
    {
        return $this->hasMany(Profession::className(), ['id_profession' => 'id_profession'] );
    }

    public function getFaculty()
    {
        return $this->hasMany(Faculty::className(), ['id_faculty' => 'id_faculty'] );
    }

    public function getStudents()
    {
        return  $this->hasMany(Students::className(), ['id_group' => 'id_group']);
    }

    public function getTeacher()
    {
        return  $this->hasMany(Teachers::className(), ['id_teacher' => 'id_teacher']);
    }

    public static  function getId_group(){
        $defis='_';
        $query = new Query();
        $result = $query
            ->select('group_students.id_profession, group_students.id_group, group_students.course',  "CONCAT(`group_students`.`course`, '_', `profession`.`profession`, ' ', `profession`.`name`) as groupcourse,")
            ->from(['profession','group_students'])
            ->where('`group_students`.`id_profession`=`profession`.`id_profession` and `group_students`.`group_status`=1')
            ->OrderBy('group_students.course')
            ->all();
        return $result;

    }


     public function getType()
    {
        return $this->hasMany(TypeProfession::className(), ['id_type' => 'id_type'] );
    }



}
