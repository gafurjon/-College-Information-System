<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>    <!-- Content Header (Page header) -->
   <div class="table-header">
    <center>
        <p style="font-size: 20px;">Форма барои иваз намудани рамз!!!</p></center>
</div>
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">
                <?php
                if(isset($save) && $save==1){
                    ?>

                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-info"></i>Огоҳӣ</h4>
                        Маълумотҳои зарури иваз карда шуд!
                    </div>
                <?} elseif(isset($save) && $save==2) {?>
                <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-info"></i>Огоҳӣ</h4>
                    Маълумотҳои xaто ворид карда шуд!
                </div>
                  <?}?>

               


            </div><!-- /.col -->
            </div>
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#password" data-toggle="tab">Ивази рамз(парол)</a></li>
                    </ul>
                    <div class="tab-content">
                        <?php
                        $form = ActiveForm::begin([
                            'id'                          =>    'about-form',
                            'method'                      =>    'post',
                            'options' => [
                                'onctype' => 'multipart/form-data',
                            ],
                        ]); ?>


                        <div class="form-horizontal">
                            <div class="form-group">

                                <label for="inputEmail" class="col-sm-4 control-label">Логинро ворид намоед</label>
                                <div class="col-sm-8">
                                    <?= $form->field($model, 'name')->textInput(['placeholder' => 'st10000   pr10000','name'=>'login'])->label(false) ?>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-4 control-label">Пароли нав</label>
                                <div class="col-sm-8">
                                    <?= $form->field($model, 'name')->passwordInput(['placeholder' => 'Пароли нав','name'=>'new_password'])->label(false) ?>
                                </div>

                            </div>


                            <div class="form-group">
                                <label for="inputName" class="col-sm-4 control-label">Пароли навро такрор кунед</label>
                                <div class="col-sm-8">
                                    <?= $form->field($model, 'name')->passwordInput(['placeholder' => 'Пароли навро такрор кунед','name'=>'new_password_double'])->label(false) ?>

                                </div>
                            </div>

                            <div class="form-group">
                            </div>
                            <div align="center">
                                <?= Html::resetButton('Сбрось', ['class' => 'btn btn-default']) ?>
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
                            </div>
                            
                        </div>
                        <?php ActiveForm::end(); ?>



                    </div><!-- /.tab-content -->
                </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
