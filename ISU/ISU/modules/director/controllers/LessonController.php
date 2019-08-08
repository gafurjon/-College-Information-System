<?php

namespace app\modules\director\controllers;

use app\modules\admin\models\LessonCategory;

class LessonController extends \yii\web\Controller
{
    public function actionIndex(){

        $category=LessonCategory::find() ->joinWith('lesson')->all();

        // debug($ca);

		return $this->render('index', compact('category'));


    } //Shudagi 50 %

}
