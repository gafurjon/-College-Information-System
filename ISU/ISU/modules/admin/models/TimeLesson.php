<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "time_lesson".
 *
 * @property integer $id_time_lesson
 * @property string $time
 */
class TimeLesson extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'time_lesson';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time'], 'string', 'max' => 25]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_time_lesson' => 'Id Time Lesson',
            'time' => 'Time',
        ];
    }
}
