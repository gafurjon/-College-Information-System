<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "zoning".
 *
 * @property integer $id_zoning
 * @property string $zoning_name
 * @property integer $id_regions
 */
class Zoning extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zoning';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_regions'], 'integer'],
            [['zoning_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_zoning' => 'Id Zoning',
            'zoning_name' => 'Zoning Name',
            'id_regions' => 'Id Regions',
        ];
    }
}
