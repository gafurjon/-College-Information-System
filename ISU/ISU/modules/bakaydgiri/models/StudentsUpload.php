<?php

namespace app\modules\bakaydgiri\models;

use Yii;

/**
 * This is the model class for table "students_upload".
 *
 * @property string $guruh
 * @property string $nasab
 * @property string $nom
 * @property string $nomi_padar
 * @property string $soli_tavallid
 * @property string $jins
 * @property string $viloyat
 * @property string $nohiya
 * @property string $suroga
 * @property string $millat
 * @property string $ixtisos
 * @property string $namudi_tahsil
 * @property double $telefon
 */
class StudentsUpload extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'students_upload';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['soli_tavallid'], 'safe'],
            [['telefon'], 'number'],
            [['guruh', 'nasab', 'nom', 'nomi_padar', 'jins', 'viloyat', 'nohiya', 'suroga', 'millat', 'ixtisos', 'namudi_tahsil'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'guruh' => 'Guruh',
            'nasab' => 'Nasab',
            'nom' => 'Nom',
            'nomi_padar' => 'Nomi Padar',
            'soli_tavallid' => 'Soli Tavallid',
            'jins' => 'Jins',
            'viloyat' => 'Viloyat',
            'nohiya' => 'Nohiya',
            'suroga' => 'Suroga',
            'millat' => 'Millat',
            'ixtisos' => 'Ixtisos',
            'namudi_tahsil' => 'Namudi Tahsil',
            'telefon' => 'Telefon',
        ];
    }
}
