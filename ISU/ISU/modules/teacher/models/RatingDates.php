<?php

namespace app\modules\teacher\models;

use Yii;

/**
 * This is the model class for table "rating_dates".
 *
 * @property integer $id_date
 * @property integer $rating_id
 * @property string $date_on
 * @property string $date_off
 * @property integer $course
 * @property integer $status
 */
class RatingDates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rating_dates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rating_id', 'course', 'status'], 'integer'],
            [['date_on', 'date_off'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_date' => 'Id Date',
            'rating_id' => 'Rating ID',
            'date_on' => 'Date On',
            'date_off' => 'Date Off',
            'course' => 'Course',
            'status' => 'Status',
        ];
    }
}
