<?php

namespace app\modules\admin\models;

use \yii\db\ActiveRecord;


class TeachersDay extends ActiveRecord
{




    public static function tableName()
    {
        return 'teachers_day';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_teacher'], 'integer'],
            [['date', 'time_in', 'time_out'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_teacher' =>'Ключ учителья',
            'date' =>'app', 'Дата',
            'time_in' => 'Время входа',
            'time_out' => 'Время ухода',
        ];
    }

    public function getTeachers()
    {
        return $this->hasMany(Teachers::className(), ['id_teacher' => 'id_teacher',]);

    }



}
