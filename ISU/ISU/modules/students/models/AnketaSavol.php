<?php

namespace app\modules\students\models;

use Yii;

/**
 * This is the model class for table "anketa_savol".
 *
 * @property integer $id_savol
 * @property string $savol
 * @property integer $type
 * @property integer $status
 */
class AnketaSavol extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'anketa_savol';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'status'], 'integer'],
            [['savol'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_savol' => 'Id Savol',
            'savol' => 'Savol',
            'type' => 'Type',
            'status' => 'Status',
        ];
    }
}
