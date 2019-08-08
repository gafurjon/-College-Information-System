<?php
/**
 * Created by PhpStorm.
 * User: Хуршед
 * Date: 27.04.2017
 * Time: 15:03
 */
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use yii\widgets\Pjax;
use yii\helpers\Html;

?>



<section class="content">
    <div class="row">
        <div class="col-md-6">
<!-- general form elements -->
<div class="box box-primary" style="">
    <div class="box-header with-border" style="text-align: center">
        <h3 class="box-title" >Добавить товар</h3>
    </div><!-- /.box-header -->
    <!-- form start -->

        <div class="box-body">
            <?php
            if(isset($save)){
                ?>

            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i>Оповещение</h4>
                    Ваш новый товар успешо добавлень.
            </div>
            <?}?>
            <?php
            $form = ActiveForm::begin([
                'id'                          =>    'about-form',
                'method'                      =>    'post',
                'options' => [
                    'onctype' => 'multipart/form-data',
                ],
            ]); ?>



            <?= $form->field($model, 'news')->textarea(['placeholder' => 'Хабар....']) ?>
            <?= $form->field($model, 'name')->textInput(['placeholder' => 'Номи Хабар']) ?>
            <?= $form->field($model, 'picture')->fileInput() ?>
            <?= Html::checkbox('tas_kmd', '', ['id' => 'tas_kmd_', 'onchange' => '$.get("@web/index.php?r=Teacher/default/getdate", function(data){$("#chek").val(data);})']); ?>






        </div><!-- /.box-body -->

        <div class="box-footer"  id="chek">
            <div class="form-group">
                <?= Html::resetButton('Сбрось', ['class' => 'btn btn-default']) ?>

                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary pull-right']) ?>

            </div>
        </div>

</div><!-- /.box -->

                <?php ActiveForm::end(); ?>
    </div>
    </div>
</section>


