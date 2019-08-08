<?php

namespace app\modules\admin\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "lesson_category".
 *
 * @property integer $id_category
 * @property string $name_category
 * @property mixed Lesson
 */
class LessonCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lesson_category';
    }

    /**
     * @inheritdoc
     */

    public  function getLesson()
    {
        return $this->hasMany(Lessons::className(), ['category_id' => 'id_category'] );
    }

    public function rules()
    {
        return [
            [['name_category'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_category' => 'Счётчик',
            'name_category' => 'Категорияи фан',
        ];
    }
}
