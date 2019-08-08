<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "work".
 *
 * @property integer $id_working
 * @property string $working
 */
class Work extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'work';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['working'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_working' => 'Id Working',
            'working' => 'Working',
        ];
    }
}
