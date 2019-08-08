<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "parent_student".
 *
 * @property integer $id_student
 * @property string $fio_padar
 * @property string $fio_modar
 * @property string $telefon_padar
 * @property string $telefon_modar
 * @property string $joi_kor_padar
 * @property string $joi_kor_modar
 * @property string $maktab
 */
class ParentStudent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parent_student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fio_padar', 'fio_modar', 'maktab'], 'string', 'max' => 150],
            [['telefon_padar'], 'string', 'max' => 25],
            [['telefon_modar'], 'string', 'max' => 20],
            [['joi_kor_padar', 'joi_kor_modar'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_student' => 'Id Student',
            'fio_padar' => 'Fio Padar',
            'fio_modar' => 'Fio Modar',
            'telefon_padar' => 'Telefon Padar',
            'telefon_modar' => 'Telefon Modar',
            'joi_kor_padar' => 'Joi Kor Padar',
            'joi_kor_modar' => 'Joi Kor Modar',
            'maktab' => 'Maktab',
        ];
    }
}
