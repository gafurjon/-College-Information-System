<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "ariza".
 *
 * @property integer $id_ariza
 * @property integer $id_students
 * @property integer $id_persons
 * @property integer $id_lesson
 * @property integer $id_week
 * @property string $mark_old
 * @property string $mark_new
 * @property string $sababi_ivaz
 * @property string $sana
 * @property integer $tasdiq
 * @property integer $satatus
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
            'id_persons' => 'Id Persons',
            'id_lesson' => 'Id Lesson',
            'id_week' => 'Id Week',
            'mark_old' => 'Mark Old',
            'mark_new' => 'Mark New',
            'sababi_ivaz' => 'Sababi Ivaz',
            'sana' => 'Sana',
            'tasdiq' => 'Tasdiq',
            'satatus' => 'Satatus',
        ];
    }

    public function getTeacher()
    {
        return $this->hasOne(Teachers::className(), ['id_teacher' => 'id_teacher']);
    }

    public function getLesson()
    {
        return $this->hasOne(Lesson::className(), ['id_lesson' => 'id_lesson']);
    }
}
