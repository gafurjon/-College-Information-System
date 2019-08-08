<?php

namespace app\modules\dekanifakultet\controllers;

use app\models\User;
use app\modules\admin\models\News;
use yii\web\Controller;
use Yii;

/**
 * Default controller for the `dekanifakultet` module
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
        $session['tmp']='8';
        $session['is_online']=\Yii::$app->db->createCommand('UPDATE persons SET is_online=1 WHERE id_persons='.\Yii::$app->user->id)
            ->execute();

        $user = User::find()->where('id_persons=' . \Yii::$app->user->id)->one();


        $news = News::find()->where(['user_id' => $user['user_id'], 'id_teacher' => 0])->all();

        return $this->render('index', compact('news'));

    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
