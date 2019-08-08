<?php

namespace app\modules\bakaydgiri\models;

use \yii\db\ActiveRecord;
use yii\db\Query;


class Students extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'students';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_st', 'user_id', 'bujet', 'id_group'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_students' => 'Id Students',
            //'persons_id' => 'Persons Id',
            'user_id' => 'User ID',
            'bujet' => 'Bujet',
            'id_group' => 'Id Group',
            'status_st'=> 'status_st',
        ];
    }



    public static function getMaxIDStudents(){
        $query = new Query();
        $result = $query
            ->select('MAX(id_students) as ID')
            ->from([Students::tableName()])
         ->one();
        return $result;
    }

    public static function getMaxIDPersons(){
        $query = new Query();
        $result = $query
            ->select('MAX(id_persons) as ID')
            ->from([Persons::tableName()])
            ->one();
        return $result;
    }
    public function getPerson()
    {
    return $this->hasMany(Persons::className(), ['id_persons' => 'persons_id']);
    }

}
