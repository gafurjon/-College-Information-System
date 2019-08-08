<?php

namespace app\modules\admin\models;

use Faker\Provider\cs_CZ\Person;
use \yii\db\ActiveRecord;


class Persons extends ActiveRecord
{

    public static function tableName()
    {
        return 'persons';
    }



    public function getTeacher()
    {
        return $this->hasOne(Teachers::className(), ['persons_id' => 'id_persons']);
    }

    public function getStudent()
    {
        return $this->hasOne(Students::className(), ['persons_id' => 'id_persons'] );
    }

    public function getNations()
    {
        return $this->hasOne(Nations::className(), ['id_nation' => 'id_nation']);
    }


    
}
