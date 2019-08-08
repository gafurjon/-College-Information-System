<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "type_profession".
 *
 * @property integer $id_type
 * @property string $type
 */
class TypeProfession extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type_profession';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_type' => 'Id Type',
            'type' => 'Type',
        ];
    }
}
