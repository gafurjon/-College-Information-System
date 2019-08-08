<?php

namespace app\modules\admin\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "exam_list".
 *
 * @property integer $id_list
 * @property integer $id_table
 * @property integer $id_students
 * @property double $exam_one
 * @property double $exam_two
 * @property double $admin_exam
 * @property integer $smestr
 * @property string $date
 * @property integer $status
 */
class ExamList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'list_exam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_table', 'id_students', 'smestr', 'status'], 'integer'],
            [['exam_one', 'exam_two', 'admin_exam'], 'number'],
            [['date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_list' => 'Id List',
            'id_table' => 'Id Table',
            'id_students' => 'Id Students',
            'exam_one' => 'Exam One',
            'exam_two' => 'Exam Two',
            'admin_exam' => 'Admin Exam',
            'smestr' => 'Smestr',
            'date' => 'Date',
            'status' => 'Status',
        ];
    }

    public function getStudents()
    {
        return $this->hasOne(Students::className(), ['id_students' => 'id_students']);
    }

    public static function getVedemost($id_table){
        $query = new Query();

        $result = $query
            ->select('p.surname, p.name as pname, p.middle_name, lx.`admin_exam`,lx.`exam_one`,lx.`exam_two`,lx.`smestr`,
            lv.`id_vedemost_list`,lv.`studies_year`,lv.`kushish`, lv.`mtesti_FIO`,lv.`bakaydgiri_FIO`, lv.`date`,
            gs.course, pr.profession, pr.name, l.`name`, k.name_kafedra, f.faculty_name')
            ->from([Journal::tableName().' as j',Students::tableName().' AS s', ExamList::tableName().' AS lx', Persons::tableName().' AS p', 
                ListVedemost::tableName().' AS lv', GroupStudents::tableName(). ' AS gs', Profession::tableName().' AS pr',
                LessonsTable::tableName(). ' AS ls', Lesson::tableName(). ' AS l', Kafedra::tableName(). ' AS k', Faculty::tableName(). ' AS f'])
            ->where("s.`id_students`=p.id_persons 
                AND s.`id_students`=lx.`id_students` 
                AND lx.`id_list`=lv.`id_list`
                AND s.`id_group`=gs.id_group
                AND gs.id_profession=pr.id_profession
                AND lx.`id_table`=ls.`id_table`
                AND ls.`id_lesson`=l.`id_lesson`
                AND gs.id_faculty=f.id_faculty
                AND k.id_faculty=f.id_faculty
                AND lx.`id_table`=".$id_table." group by p.surname ORDER BY p.surname")
            ->all();

        return $result;
    }

     public static function getVedemostTitle($id_table){
        $query = new Query();

        $result = $query
            ->select('p.surname, p.name, p.middle_name,lx.`smestr`,lv.`studies_year`,lv.`date`, lv.`vedomost_number`,
gs.course, pr.profession, pr.name as proname, l.`name` as lessonname, k.name_kafedra, f.faculty_name')
            ->from([Students::tableName().' AS s', ExamList::tableName().' AS lx', Persons::tableName().' AS p', 
                ListVedemost::tableName().' AS lv', GroupStudents::tableName(). ' AS gs', Profession::tableName().' AS pr',Teachers::tableName(). ' AS t',
                LessonsTable::tableName(). ' AS ls', Lesson::tableName(). ' AS l', Kafedra::tableName(). ' AS k', Faculty::tableName(). ' AS f'])
            ->where("ls.`id_teacher`=t.`id_teacher`
AND t.`id_teacher`=p.id_persons 
AND ls.`id_group`=gs.id_group
AND gs.id_profession=pr.id_profession
AND lx.`id_table`=ls.`id_table`
AND ls.`id_lesson`=l.`id_lesson`
AND gs.id_faculty=f.id_faculty
AND k.id_faculty=f.id_faculty
AND lv.`id_list`=lx.`id_list`
AND lx.`id_table`=".$id_table."  GROUP BY p.surname")
            ->one();

        return $result;
    }
}
