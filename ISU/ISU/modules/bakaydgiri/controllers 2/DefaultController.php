<?php

namespace app\modules\bakaydgiri\controllers;

use app\models\User;
use app\modules\admin\models\News;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `bakaydgiri` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $session=\Yii::$app->session;
        $session['tmp']='9';
        $session['is_online']=\Yii::$app->db->createCommand('UPDATE persons SET is_online=1 WHERE id_persons='.\Yii::$app->user->id)
            ->execute();


        $user = User::find()->where('id_persons=' . \Yii::$app->user->id)->one();


        $news = News::find()->where(['user_id' => $user['user_id'], 'id_teacher' => 0])->all();

        return $this->render('index', compact('news'));

    }


    public function actionLogout()
    {
        $user = User::find()->where('id_persons=' . \Yii::$app->user->id)->one();
        // $user->tmp = '';
        // $user->save();
        Yii::$app->user->logout();

        return $this->goHome();
    }

}

