<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property integer $id_settings
 * @property string $studies_year
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['studies_year'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_settings' => 'Id Settings',
            'studies_year' => 'Studies Year',
        ];
    }
}
