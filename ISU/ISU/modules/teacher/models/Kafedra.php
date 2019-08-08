<?php

namespace app\modules\teacher\models;

use Yii;

/**
 * This is the model class for table "kafedra".
 *
 * @property integer $id_kafedra
 * @property string $name_kafedra
 * @property integer $id_faculty
 *
 * @property Faculty $idFaculty
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
            [['id_faculty'], 'exist', 'skipOnError' => true, 'targetClass' => Faculty::className(), 'targetAttribute' => ['id_faculty' => 'id_faculty']],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaculty()
    {
        return $this->hasOne(Faculty::className(), ['id_faculty' => 'id_faculty']);
    }
}
