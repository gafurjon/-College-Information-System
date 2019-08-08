<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "faculty".
 *
 * @property integer $id_faculty
 * @property string $faculty_name
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
            [['faculty_name'], 'string', 'max' => 50]
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

    public function getGroup()
    {
        return $this->hasMany(GroupStudents::className(), ['id_faculty' => 'id_faculty'] );
    }


}
