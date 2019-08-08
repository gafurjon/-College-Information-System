<?php

namespace app\modules\students\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "students".
 *
 * @property integer $id_students
 * @property integer $persons_id
 * @property integer $user_id
 * @property integer $bujet
 * @property integer $id_group
 *
 * @property Journal[] $journals
 * @property Persons $persons
 */
class Students extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'students';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['persons_id', 'user_id', 'bujet', 'id_group'], 'integer'],
            [['persons_id'], 'exist', 'skipOnError' => true, 'targetClass' => Persons::className(), 'targetAttribute' => ['persons_id' => 'id_persons']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_students' => 'Id Students',
            'persons_id' => 'Persons ID',
            'user_id' => 'User ID',
            'bujet' => 'Bujet',
            'id_group' => 'Id Group',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJournals()
    {
        return $this->hasMany(Journal::className(), ['id_students' => 'id_students']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Persons::className(), ['id_persons' => 'persons_id']);
    }

    public static function getAll($id_persons){
        $result = static::find()->select('*')->asArray()->where('persons_id='.$id_persons)->all();
        if(isset($result[0])){
            return $result[0];
        }
    }
    public static function getStudents($id_group){
        $query = new Query();
        $result = $query
            ->select('id_students,surname,name,middle_name')
            ->from([Students::tableName(),Persons::tableName()])
            ->where('`students`.`persons_id`=`persons`.`id_persons` AND `students`.`id_group`=:id_group',[':id_group'=>$id_group])
            ->orderBy('surname,name,middle_name')
            ->all();
        return $result;
    }
}
