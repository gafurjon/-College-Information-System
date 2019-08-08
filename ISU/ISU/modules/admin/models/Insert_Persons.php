<?php

namespace app\modules\admin\models;

use app\modules\bakaydgiri\models\Regions;
use Yii;


class Insert_Persons extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'persons';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'telefon', 'gender', 'id_regions', 'id_zoning', 'persons_status', 'id_nation'], 'integer'],
            [['brithday'], 'safe'],
            [['picture'], 'string'],
            [['login'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 255],
            [['name', 'surname', 'middle_name', 'adress'], 'string', 'max' => 25],
            [['id_nation'], 'exist', 'skipOnError' => true, 'targetClass' => Nations::className(), 'targetAttribute' => ['id_nation' => 'id_nation']],
            [['id_regions'], 'exist', 'skipOnError' => true, 'targetClass' => Regions::className(), 'targetAttribute' => ['id_regions' => 'id_regions']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_persons' => 'Id Persons',
            'login' => 'Login',
            'password' => 'Password',
            'user_id' => 'User ID',
            'telefon' => 'Telefon',
            'name' => 'Name',
            'surname' => 'Surname',
            'middle_name' => 'Middle Name',
            'brithday' => 'Brithday',
            'gender' => 'Gender',
            'id_regions' => 'Id Regions',
            'id_zoning' => 'Id Zoning',
            'adress' => 'Adress',
            'picture' => 'Picture',
            'persons_status' => 'Persons Status',
            'id_nation' => 'Id Nation',
        ];
    }

    public function getIdNation()
    {
        return $this->hasOne(Nations::className(), ['id_nation' => 'id_nation']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRegions()
    {
        return $this->hasOne(Regions::className(), ['id_regions' => 'id_regions']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Students::className(), ['persons_id' => 'id_persons']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachers()
    {
        return $this->hasMany(Teachers::className(), ['persons_id' => 'id_persons']);
    }
}
