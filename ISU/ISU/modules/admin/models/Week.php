<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "week".
 *
 * @property integer $id_week
 * @property string $name
 * @property string $name_tj
 */
class Week extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'week';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'name_tj'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_week' => 'Id Week',
            'name' => 'Name',
            'name_tj' => 'Name Tj',
        ];
    }




    public function getWeek()
    {
        return $this->hasOne(LessonTime::className(), ['id_week' => 'id_week'] );
    }
}
