<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "profession".
 *
 * @property integer $id_profession
 * @property string $profession
 *
 * @property GroupStudents[] $groupStudents
 */
class Profession extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profession';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profession'], 'required'],
            [['profession'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_profession' => 'Id Profession',
            'profession' => 'Profession',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupStudents()
    {
        return $this->hasMany(GroupStudents::className(), ['id_profession' => 'id_profession']);
    }
}
