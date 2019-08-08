<?php
/**
 * Created by PhpStorm.
 * User: Хуршед
 * Date: 09.03.2017
 * Time: 11:08
 */



/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Pjax;
Use kartik\date\DatePicker;



//$this->params['breadcrumbs'][] = $this->title;

?>

<div class="table-header">
    <center>
        <p style="font-size: 20px;">Маълумоти умуми дар бораи гурӯҳҳо</p></center>
</div>
<section class="page-content">
    <div class="row">
        <?php
        if(count($data) > 0) {
            ?>

            <h3 class="col-xs-3">
                <?php

                $form = ActiveForm::begin();
                // получаем всех авторов

                // формируем массив, с ключем равным полю 'id' и значением равным полю 'name'
                $items = ArrayHelper::map($data, 'id_group','groupcourse');
                $params = [
                    'prompt' => 'Гурӯҳро интихоб кунед...',

                    'onchange'=>'$.get("index.php?r=admin/control/select-group-students&id="+$(this).val(), function(data){$("#content").html(data);})'

                ];
                echo $form->field($model, 'profession')->dropDownList($items, $params, ['class' => 'form-control select2', 'style' => 'border-radius:4px; width:100%'])->label(false);

                ActiveForm::end();

                ?>
            </h3>
        <?php }?>


    </div>

    <script src="/ktk.tj/web/admin/jquery-ui.min.js"></script>

    <div id="dialog-message" class="hide">


    </div>

    <div class="box-body" id="content">
        <!---malumot--->
    </div>


</section>




