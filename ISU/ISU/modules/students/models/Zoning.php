<?php

namespace app\modules\students\models;

use Yii;

/**
 * This is the model class for table "zoning".
 *
 * @property integer $id_zoning
 * @property string $zoning_name
 * @property integer $id_regions
 *
 * @property Persons[] $persons
 * @property Regions $idRegions
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
            [['zoning_name'], 'string', 'max' => 100],
            [['id_regions'], 'exist', 'skipOnError' => true, 'targetClass' => Regions::className(), 'targetAttribute' => ['id_regions' => 'id_regions']],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersons()
    {
        return $this->hasMany(Persons::className(), ['id_zoning' => 'id_zoning']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRegions()
    {
        return $this->hasOne(Regions::className(), ['id_regions' => 'id_regions']);
    }
}
