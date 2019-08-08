<?php

namespace app\modules\jonishinitarbiya;
use \app\models\Menu;
use yii\filters\AccessControl;
use Yii;

/**
 * Jonishinitarbiya module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\jonishinitarbiya\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function behaviors()
    {

        $module = $this->id;
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;


        $access = Menu::getAccess($module, $controller, $action);


        if ($access == true) {
            return [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['jonishinitarbiya']
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
