<?php

namespace app\modules\students\models;

use Yii;

/**
 * This is the model class for table "rating_dates".
 *
 * @property integer $id_date
 * @property integer $rating
 * @property string $date_on
 * @property string $date_off
 * @property integer $course
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
            [['rating', 'course'], 'integer'],
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
            'rating' => 'Rating',
            'date_on' => 'Date On',
            'date_off' => 'Date Off',
            'course' => 'Course',
        ];
    }
}
