<?php

namespace app\modules\bakaydgiri\models;

use Yii;
use yii\db\Query;


/**
 * This is the model class for table "lesson".
 *
 * @property integer $id_lesson
 * @property string $name
 * @property string $short_name
 */
class Lesson extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lesson';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 765],
            [['short_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_lesson' => 'Id Lesson',
            'name' => 'Name',
            'short_name' => 'Short Name',
        ];
    }

        public static function getLesname(){
        $query = new Query();

        $result = $query
            ->select('*')
            ->from([Lesson::tableName() ])
            ->orderBy('name')
            ->all();

        return $result;
    }
    
}
