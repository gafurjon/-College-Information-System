<?php

namespace app\models;

use Yii;

use yii\db\Query;

/**
 * This is the model class for table "persons".
 *
 * @property integer $id_persons
 * @property string $login
 * @property string $password
 * @property integer $user_id
 * @property integer $telefon
 * @property string $name
 * @property string $surname
 * @property string $middle_name
 * @property string $brithday
 * @property integer $gender
 * @property integer $id_regions
 * @property integer $id_zoning
 * @property string $adress
 * @property string $picture
 * @property integer $persons_status
 * @property integer $id_nation
 *
 * @property Nations $idNation
 * @property Regions $idRegions
 * @property Users $user
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

    public static function getOnline(){

        $query = new Query();

        $count = $query
            ->select('COUNT(id_persons) as online')
            ->from(['persons'])
            ->where('is_online=1')
            ->all();

             return $count;

        }
}
