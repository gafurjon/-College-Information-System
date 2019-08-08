<?php

namespace app\modules\admin\models;
use Yii;
use yii\db\Query;
use yii\web\Controller;


use app\modules\admin\models\GroupStudents;

/**
 * This is the model class for table "lessons".
 *
 * @property integer $id_lesson
 * @property integer $category_id
 * @property string $name
 * @property integer $code_lessons
 * @property integer $lesson_kredit
 * @property integer $status
 */
class Lessons extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lessons';
    }

    /**
     * @inheritdoc
     */



    public function rules()
    {
        return [
            [['category_id','id_lesson', 'code_lessons', 'lesson_kredit', 'status'], 'integer'],
            [ 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_lesson' => 'Id Lesson',
            'category_id' => 'Category ID',
            'code_lessons' => 'Code Lessons',
            'lesson_kredit' => 'Lesson Kredit',
            'status' => 'Status',
        ];
    }


    public function getCategory()
    {
        return $this->hasMany(Lessons::className(), ['category_id' => 'id_category'] );
    }


    public function getTeacher()
    {
        return $this->hasMany(TeacherLesson::className(), ['id_lesson' => 'id_lesson'] );
    }

    public function getLessons()
    {
        return $this->hasMany(lesson::className(), ['id_lesson' => 'id_lesson'] );
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

     

    

}
