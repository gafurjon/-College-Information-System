<?php

namespace app\modules\director;
use \app\models\Menu;
use yii\filters\AccessControl;
use Yii;
/**
 * Director module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\director\controllers';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {

        $module = $this->id;
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;


        $access = Menu::getAccess($module, $controller, $action);

//        debug($access);
//        exit;
        if ($access == true) {
            return [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['director']
                        ]
                    ]
                ]
            ];
        } else {
            return[
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => false,

                        ]

                    ]
                ]
            ];
        }

    }
}
