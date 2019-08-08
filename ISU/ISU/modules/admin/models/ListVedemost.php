<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "list_vedemost".
 *
 * @property integer $id_vedemost_list
 * @property integer $id_list
 * @property integer $id_group
 * @property string $studies_year
 * @property integer $kushish
 * @property string $date
 * @property integer $vedomost_number
 * @property string $bakaydgiri_FIO
 * @property string $mtesti_FIO
 * @property integer $status
 */
class ListVedemost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'list_vedemost';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_list', 'id_group', 'kushish', 'vedomost_number', 'status'], 'integer'],
            [['studies_year', 'date'], 'string', 'max' => 15],
            [['bakaydgiri_FIO', 'mtesti_FIO'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_vedemost_list' => 'Id Vedemost List',
            'id_list' => 'Id List',
            'id_group' => 'Id Group',
            'studies_year' => 'Studies Year',
            'kushish' => 'Kushish',
            'date' => 'Date',
            'vedomost_number' => 'Vedomost Number',
            'bakaydgiri_FIO' => 'Bakaydgiri  Fio',
            'mtesti_FIO' => 'Mtesti  Fio',
            'status' => 'Status',
        ];
    }
}
