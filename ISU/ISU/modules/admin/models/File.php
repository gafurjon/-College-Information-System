<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "file".
 *
 * @property integer $id_file
 * @property integer $user_id
 * @property integer $id_teacher
 * @property string $name
 * @property string $text
 * @property string $file
 * @property string $date
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'id_teacher'], 'integer'],
            [['text',], 'string'],
            [['date'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['file'], 'file','extensions' =>
                'doc, docx, ppt, pdf'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_file' => 'Id File',
            'user_id' => 'User ID',
            'id_teacher' => 'Id Teacher',
            'name' => 'Name',
            'text' => 'Text',
            'file' => 'File',
            'date' => 'Date',
        ];
    }

    public function getPersonsave()
    {
        return $this->hasOne(Persons::className(), ['id_persons' => 'id_person'] );
    }

    public function getTeacher()
    {
        return $this->hasOne(Teachers::className(), ['id_teacher' => 'id_teacher'] );
    }

    public function getUser()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'user_id'] );
    }
}
