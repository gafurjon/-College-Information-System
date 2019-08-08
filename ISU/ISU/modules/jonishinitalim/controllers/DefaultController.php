<?php

namespace app\modules\jonishinitalim\controllers;

use app\modules\admin\models\News;
use yii\web\Controller;
use app\models\User;
use Yii;

/**
 * Default controller for the `Jonishinitalim` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $user = User::find()->where('id_persons='.\Yii::$app->user->id)->one();
        $session=\Yii::$app->session;
        $session['tmp']='5';
        $session['is_online']=\Yii::$app->db->createCommand('UPDATE persons SET is_online=1 WHERE id_persons='.\Yii::$app->user->id)
            ->execute();

        $news=News::find()->where(['user_id'=>$user['user_id']])->asArray()->all();


        return $this->render('index', compact('news'));
    }


    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


}
