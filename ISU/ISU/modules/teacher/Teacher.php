<?php

namespace app\modules\teacher;
use \app\models\Menu;
use yii\filters\AccessControl;
use Yii;
/**
 * Teacher module definition class
 */
class Teacher extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\teacher\controllers';

    /**
     * @inheritdoc
     */

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
/*    public function behaviors()
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
                            'roles' => ['teacher']
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

    }*/
}
