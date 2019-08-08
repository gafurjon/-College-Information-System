<?php

namespace app\modules\bakaydgiri\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $user_id
 * @property string $name_user
 * @property string $modules
 *
 * @property Persons[] $persons
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_user'], 'string', 'max' => 50],
            [['modules'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'name_user' => 'Name User',
            'modules' => 'Modules',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersons()
    {
        return $this->hasMany(Persons::className(), ['user_id' => 'user_id']);
    }
}
