<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "kafedra".
 *
 * @property integer $id_kafedra
 * @property string $name_kafedra
 * @property integer $id_faculty
 */
class Kafedra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kafedra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_faculty'], 'integer'],
            [['name_kafedra'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_kafedra' => 'Id Kafedra',
            'name_kafedra' => 'Name Kafedra',
            'id_faculty' => 'Id Faculty',
        ];
    }

    public function getFaculty()
    {
        return $this->hasOne(Faculty::className(), ['id_faculty' => 'id_faculty'] );
    }
}
