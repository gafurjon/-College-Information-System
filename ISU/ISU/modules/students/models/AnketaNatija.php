<?php

namespace app\modules\students\models;

use Yii;

/**
 * This is the model class for table "anketa_natija".
 *
 * @property integer $id_anketa
 * @property integer $id_teacher
 * @property integer $id_lesson
 * @property integer $id_savol
 * @property integer $javob
 */
class AnketaNatija extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'anketa_natija';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_teacher', 'id_lesson', 'id_savol', 'javob_adad'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_anketa' => 'Id Anketa',
            'id_teacher' => 'Id Teacher',
            'id_lesson' => 'Id Lesson',
            'id_savol' => 'Id Savol',
            'javob_adad' => 'javob_adad',
            
        ];
    }
}
