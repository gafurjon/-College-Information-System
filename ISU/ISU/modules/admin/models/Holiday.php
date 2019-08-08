<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "holiday".
 *
 * @property integer $id_holiday
 * @property string $date
 * @property string $holiday_name
 * @property integer $status
 */
class Holiday extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'holiday';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'holiday_name'], 'required'],
            [['status'], 'integer'],
            [['date'], 'string', 'max' => 10],
            [['holiday_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_holiday' => 'Id Holiday',
            'date' => 'Date',
            'holiday_name' => 'Holiday Name',
            'status' => 'Status',
        ];
    }
}
