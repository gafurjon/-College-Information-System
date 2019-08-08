<?php

namespace app\modules\admin\models;

use yii\db\Query;
use Yii;

/**
 * This is the model class for table "lesson".
 *
 * @property integer $id_lesson
 * @property string $name
 * @property string $short_name
 */
class Lesson extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lesson';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 765],
            [['short_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_lesson' => 'Id Lesson',
            'name' => 'Name',
            'short_name' => 'Short Name',
        ];
    }


    public static  function getId_les($id_lesson){
        $query = new Query();
        $result = $query
            ->select('MIN(id_lesson), NAME')
            ->from(['lesson'])
            ->where('lesson.name=:id_lesson ',[':id_lesson' => $id_lesson])
            ->all();
        return $result;

    }

    public static function getLesson($id_group,$course){
        $query = new Query();
        $result = $query
             ->select('l.id_lesson, l.name')
             ->from([Lessons::tableName().' as l', GroupStudents::tableName().' as gs'])
             ->where('l.id_profession=gs.id_profession and gs.id_group=:id_group',[':id_group'=>$id_group])
             ->orderBy('name')
             ->groupBy('name')
             ->all();

      /*  if($course==2){
        
            $query = new Query();
        $result = $query
             ->select('l.id_lesson, ls.name')
             ->from([Lessons::tableName().' as l', Lesson::tableName().' as ls', GroupStudents::tableName().' as gs'])
             ->where('ls.id_lesson=l.id_lesson and l.id_profession=gs.id_profession and l.smestr>=3 and l.smestr>=4 
                and gs.id_group=:id_group',[':id_group'=>$id_group])
             ->orderBy('name')
             ->groupBy('name')
             ->all();
       
        }
        elseif($course==1){
        
        $query = new Query();
        $result = $query
             ->select('l.id_lesson, ls.name')
             ->from([Lessons::tableName().' as l', Lesson::tableName().' as ls', GroupStudents::tableName().' as gs'])
             ->where('ls.id_lesson=l.id_lesson and ls.id_lesson=l.id_lesson and l.id_profession=gs.id_profession and l.smestr>=1 
                and l.smestr>=2 and gs.id_group=:id_group',[':id_group'=>$id_group])
             ->orderBy('name')
             ->groupBy('name')
             ->all();
        
        }
        
        elseif($course==3){
        
        $query = new Query();
        $result = $query
             ->select('l.id_lesson, ls.name')
             ->from([Lessons::tableName().' as l', Lesson::tableName().' as ls', GroupStudents::tableName().' as gs'])
             ->where('ls.id_lesson=l.id_lesson and l.id_profession=gs.id_profession and l.smestr>=5 and 
                l.smestr>=6 and gs.id_group=:id_group',[':id_group'=>$id_group])
             ->orderBy('name')
             ->groupBy('name')
             ->all();
        }
        else{
        $query = new Query();
        $result = $query
             ->select('l.id_lesson, ls.name')
             ->from([Lessons::tableName().' as l', Lesson::tableName().' as ls', GroupStudents::tableName().' as gs'])
             ->where('ls.id_lesson=l.id_lesson and l.id_profession=gs.id_profession and l.smestr>=7 and l.smestr>=8 and gs.id_group=:id_group',[':id_group'=>$id_group])
             ->orderBy('name')
             ->groupBy('name')
             ->all();
        }*/
        return $result;
    }


        public function getLessons()
    {
        return $this->hasOne(Lessons::className(), ['id_lesson' => 'id_lesson']);
    }

     




}
