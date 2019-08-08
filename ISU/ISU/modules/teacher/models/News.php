<?php

namespace app\modules\teacher\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "news".
 *
 * @property integer $id_news
 * @property integer $news_type
 * @property string $name
 * @property string $news
 * @property string $picture
 * @property string $date
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['news_type'], 'integer'],
            [['news', 'picture'], 'string'],
            [['date'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_news' => 'Id News',
            'news_type' => 'News Type',
            'name' => 'Name',
            'news' => 'News',
            'picture' => 'Picture',
            'date' => 'Date',
        ];
    }
    public static function  getAll($id_teacher,$id_user){
       /* return $news=News::find()->where(['user_id'=> 0] or ['user_id'=>Yii::$app->user->identity['user_id']] &&
            ['id_teacher'=>0] or ['id_teacher'=>$id_teacher])->asArray()->all();*/

        $query = new Query();
        $result = $query
            ->select('*')
            ->from('news')
            ->where('news.id_teacher='.$id_teacher.' OR news.id_teacher=0 AND
             news.`user_id`='.$id_user.' OR news.`user_id`=0')
            ->orderBy(['news.id_news'=>SORT_DESC])->all();
        return $result;
    }
}
