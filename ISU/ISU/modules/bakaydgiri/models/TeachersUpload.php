<?php

namespace app\modules\bakaydgiri\models;

use Yii;

/**
 * This is the model class for table "teachers_upload".
 *
 * @property string $nasab
 * @property string $nom
 * @property string $nomi_padar
 * @property string $soli_tavallud
 * @property string $jins
 * @property string $viloyat
 * @property string $nohiya
 * @property string $suroga
 * @property string $millat
 * @property string $kafedra
 * @property string $rakami_telefon
 * @property string $malumot
 */
class TeachersUpload extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teachers_upload';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['soli_tavallud'], 'safe'],
            [['nasab', 'nom', 'nomi_padar', 'jins', 'viloyat', 'nohiya', 'suroga', 'millat', 'kafedra', 'rakami_telefon', 'malumot'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nasab' => 'Nasab',
            'nom' => 'Nom',
            'nomi_padar' => 'Nomi Padar',
            'soli_tavallud' => 'Soli Tavallud',
            'jins' => 'Jins',
            'viloyat' => 'Viloyat',
            'nohiya' => 'Nohiya',
            'suroga' => 'Suroga',
            'millat' => 'Millat',
            'kafedra' => 'Kafedra',
            'rakami_telefon' => 'Rakami Telefon',
            'malumot' => 'Malumot',
        ];
    }
}
