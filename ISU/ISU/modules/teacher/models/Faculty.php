<?php

namespace app\modules\teacher\models;

use Yii;

/**
 * This is the model class for table "faculty".
 *
 * @property integer $id_faculty
 * @property string $faculty_name
 *
 * @property GroupStudents[] $groupStudents
 * @property Kafedra[] $kafedras
 */
class Faculty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faculty';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['faculty_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_faculty' => 'Id Faculty',
            'faculty_name' => 'Faculty Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupStudents()
    {
        return $this->hasMany(GroupStudents::className(), ['id_faculty' => 'id_faculty']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKafedras()
    {
        return $this->hasMany(Kafedra::className(), ['id_faculty' => 'id_faculty']);
    }
}
