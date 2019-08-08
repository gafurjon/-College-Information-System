<?php

namespace app\modules\teacher\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "ariza".
 *
 * @property integer $id_ariza
 * @property integer $id_students
 * @property integer $id_teacher
 * @property integer $id_lesson
 * @property integer $id_week
 * @property string $mark_old
 * @property string $mark_new
 * @property string $sababi_ivaz
 * @property string $sana
 * @property integer $tasdiq
 * @property integer $satatus
 *
 * @property Students $idStudents
 * @property Teachers $idTeacher
 * @property Lessons $idLesson
 * @property Week $idWeek
 */
class Ariza extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ariza';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_students', 'id_teacher', 'id_lesson', 'id_week', 'tasdiq', 'status'], 'integer'],
            [['sababi_ivaz'], 'string'],
            [['sana'], 'safe'],
            [['mark_old', 'mark_new'], 'string', 'max' => 4],
            [['id_students'], 'exist', 'skipOnError' => true, 'targetClass' => Students::className(), 'targetAttribute' => ['id_students' => 'id_students']],
            [['id_teacher'], 'exist', 'skipOnError' => true, 'targetClass' => Teachers::className(), 'targetAttribute' => ['id_teacher' => 'id_teacher']],
            [['id_lesson'], 'exist', 'skipOnError' => true, 'targetClass' => Lessons::className(), 'targetAttribute' => ['id_lesson' => 'id_lesson']],
            [['id_week'], 'exist', 'skipOnError' => true, 'targetClass' => Week::className(), 'targetAttribute' => ['id_week' => 'id_week']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ariza' => 'Id Ariza',
            'id_students' => 'Id Students',
            'id_teacher' => 'Id Teacher',
            'id_lesson' => 'Id Lesson',
            'id_week' => 'Id Week',
            'mark_old' => 'Mark Old',
            'mark_new' => 'Mark New',
            'sababi_ivaz' => 'Sababi Ivaz',
            'sana' => 'Sana',
            'date_save'=>'Date Save',
            'tasdiq' => 'Tasdiq',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdStudents()
    {
        return $this->hasOne(Students::className(), ['id_students' => 'id_students']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTeacher()
    {
        return $this->hasOne(Teachers::className(), ['id_teacher' => 'id_teacher']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdLesson()
    {
        return $this->hasOne(Lessons::className(), ['id_lesson' => 'id_lesson']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdWeek()
    {
        return $this->hasOne(Week::className(), ['id_week' => 'id_week']);
    }

    public static function getAriza($id_teacher)
    {
        $query = new Query();

        $arizaho = $query
            ->select('*')
            ->from(['ariza'])
            ->where('id_teacher='.$id_teacher.' and tasdiq <=4 and status=1')
            ->orderBy('date_save')
            ->all();
        return $arizaho;
    }
}
