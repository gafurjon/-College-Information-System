<?php

namespace app\modules\students\models;

use Yii;
use yii\db\Query;


/**
 * This is the model class for table "lessons_day".
 *
 * @property integer $id_day
 * @property string $datedars
 * @property string $type
 * @property integer $id_week
 * @property integer $open_close
 *
 * @property Week $idWeek
 */
class LessonsDay extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lessons_day';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['datedars', 'type', 'id_week'], 'required'],
            [['id_week', 'open_close'], 'integer'],
            [['datedars'], 'string', 'max' => 10],
            [['type'], 'string', 'max' => 20],
            [['id_week'], 'exist', 'skipOnError' => true, 'targetClass' => Week::className(), 'targetAttribute' => ['id_week' => 'id_week']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_day' => 'Id Day',
            'datedars' => 'Datedars',
            'type' => 'Type',
            'id_week' => 'Id Week',
            'open_close' => 'Open Close',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdWeek()
    {
        return $this->hasOne(Week::className(), ['id_week' => 'id_week']);
    }
    public static function getDate(){


            $query = new Query();
            $lesson_day = $query
                ->select('ld.id_day, ld.datedars, ld.type, w.name_tj,ld.open_close')
                ->from([LessonsDay::tableName().' as ld', Week::tableName().' as w'])
                ->where('ld.id_week=w.id_week and ld.id_week<>0',[])
                ->orderBy('datedars')
                ->all();


            //$lesson_day[$r] = LessonsDay::find()->where('id_week=:id_week ',[':id_week'=>$lesson_time['id_week']])->asArray()->all();



//            debug($lesson_days);
//        exit;
        return $lesson_day;
    }
}
