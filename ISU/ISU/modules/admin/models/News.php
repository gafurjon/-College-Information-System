<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id_news
 * @property integer $news_type
 * @property integer $user_news_id
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
            [['news_type', 'user_id'], 'integer'],
            [['news','picture'], 'string'],
            [['date'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['picture'], 'file','extensions' =>
             'png, jpg'],
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
            'user_id' => 'User  ID',
            'name' => 'Name',
            'news' => 'News',
            'picture' => 'Picture',
            'date' => 'Date',
        ];
    }
    public static function  getAll($id){
        return $news=News::find()->where(['news.user_id'=>$id])->asArray()->all();
    }



}
