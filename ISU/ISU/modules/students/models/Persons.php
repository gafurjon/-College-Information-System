<?php

namespace app\modules\students\models;

use Yii;

/**
 * This is the model class for table "persons".
 *
 * @property integer $id_persons
 * @property string $login
 * @property string $password
 * @property integer $menu_status
 * @property string $name
 * @property string $surname
 * @property string $middle_name
 * @property string $brithday
 * @property integer $gender
 * @property integer $id_regions
 * @property integer $id_zoning
 * @property string $adress
 * @property string $picture
 * @property integer $user_id
 * @property integer $persons_status
 * @property integer $id_nation
 *
 * @property Nations $idNation
 * @property Regions $idRegions
 * @property Users $user
 * @property Zoning $idZoning
 * @property Students[] $students
 * @property Teachers[] $teachers
 */
class Persons extends \yii\db\ActiveRecord
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
            [['gender', 'id_regions', 'id_zoning', 'user_id', 'persons_status', 'id_nation'], 'integer'],
            [['brithday'], 'safe'],
            [['picture'], 'string'],
            [['login'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 255],
            [['name', 'surname', 'middle_name', 'adress'], 'string', 'max' => 25],
            [['id_nation'], 'exist', 'skipOnError' => true, 'targetClass' => Nations::className(), 'targetAttribute' => ['id_nation' => 'id_nation']],
            [['id_regions'], 'exist', 'skipOnError' => true, 'targetClass' => Regions::className(), 'targetAttribute' => ['id_regions' => 'id_regions']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'user_id']],
            [['id_zoning'], 'exist', 'skipOnError' => true, 'targetClass' => Zoning::className(), 'targetAttribute' => ['id_zoning' => 'id_zoning']],
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
            'name' => 'Name',
            'surname' => 'Surname',
            'middle_name' => 'Middle Name',
            'brithday' => 'Brithday',
            'gender' => 'Gender',
            'id_regions' => 'Id Regions',
            'id_zoning' => 'Id Zoning',
            'adress' => 'Adress',
            'picture' => 'Picture',
            'user_id' => 'User ID',
            'persons_status' => 'Persons Status',
            'id_nation' => 'Id Nation',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
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
    public function getIdZoning()
    {
        return $this->hasOne(Zoning::className(), ['id_zoning' => 'id_zoning']);
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