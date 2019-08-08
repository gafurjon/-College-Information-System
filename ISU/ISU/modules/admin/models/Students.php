<?php

namespace app\modules\admin\models;

use \yii\db\ActiveRecord;
use yii\db\Query;


class Students extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'students';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'bujet', 'id_group'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_students' => 'Id Students',
            'id_persons' => 'Id Persons',
            'user_id' => 'User ID',
            'bujet' => 'Bujet',
            'id_group' => 'Id Group',
        ];
    }

    public function getPerson()
    {
    return $this->hasMany(Persons::className(), ['id_persons' => 'persons_id']);
    }

    public function getGroup()
    {
        return $this->hasOne(GroupStudents::className(), ['id_group' => 'id_group']);
    }

    public function getParent()
    {
        return $this->hasOne(ParentStudent::className(), ['id_students' => 'id_students']);
    }

    public function getTranscript()
    {
        return $this->hasOne(Transcript::className(), ['id_students' => 'id_students']);
    }


    public static function getStudents($id_group){
        $query = new Query();
        $result = $query
            ->select('id_students,surname,name,middle_name')
            ->from([Students::tableName(),Persons::tableName()])
            ->where('`students`.`persons_id`=`persons`.`id_persons` AND `students`.`id_group`=:id_group',[':id_group'=>$id_group])
            ->orderBy('surname,name,middle_name')
            ->all();
        return $result;
    }

    public static function getQarzoron($id_group){
        $query = new Query();
        $result = $query
            ->select('`students`.id_students,`persons`.surname,`persons`.name,`persons`.middle_name,transcript.letter, lesson.name')
            ->from([Students::tableName(),Persons::tableName(),Transcript::tableName(),LessonsTable::tableName(),Lesson::tableName()])
            ->where("
            `students`.`persons_id`=`persons`.`id_persons` 
            AND transcript.`id_students`=students.`id_students` 
            AND lessons_table.id_table=transcript.id_table
            AND lessons_table.id_lesson=lesson.id_lesson
            AND `students`.`id_group`=".$id_group." AND `transcript`.`letter`='F'
            ")
            ->orderBy("persons.surname,persons.name,persons.middle_name")
            ->all();
        return $result;
    }
}
