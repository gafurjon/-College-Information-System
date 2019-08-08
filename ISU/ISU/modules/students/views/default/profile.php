<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>    <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Профили истифодабаранда
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?=\yii\helpers\Url::to('@web/index.php?r=students/default/index')?>"><i class="fa fa-dashboard"></i> Саҳифаи асосӣ</a></li>
            <li class="active">Профили истифодабаранда</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">
                <?php
                if(isset($save) && $save==1){
                    ?>

                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="false">×</button>
                        <h4><i class="icon fa fa-info"></i>Огоҳӣ</h4>
                        Маълумотҳои зарури иваз карда шуд!
                    </div>
                <?}
                elseif(isset($save) && $save==2){
                ?>

                <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-info"></i>Огоҳӣ</h4>
                    Маълумотҳои зарури иваз нашуд!
                </div>
                <?}?>

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="<?= yii\helpers\Url::to('@web/'.Yii::$app->user->identity['picture'])?>" alt="User profile picture">
                        <h3 class="profile-username text-center">
                            <?= Yii::$app->user->identity['surname'];?>
                            <?= Yii::$app->user->identity['name'];?>
                            <?= Yii::$app->user->identity['middle_name'];?>
                        </h3>
                        <p class="text-muted text-center"><?php
                            $users = \app\models\Users::getUserid(Yii::$app->user->identity['user_id']);
                            echo $users['name_user'];
                            ?>
                        </p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Санаи таваллуд</b> <a class="pull-right"><?= Yii::$app->user->identity['brithday'];?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Миллат</b>
                                <a class="pull-right">

                                    <?php
                                    if(Yii::$app->user->identity['id_nation']==1){
                                        echo "Тоҷик";
                                    }
                                    elseif(Yii::$app->user->identity['id_nation']==2){
                                        echo "Ӯзбек";
                                    }
                                    elseif(Yii::$app->user->identity['id_nation']==3){
                                        echo "Русский";
                                    }
                                    ?>

                                </a>
                            </li>
                            <li class="list-group-item">
                                <b>Ҷинс</b>
                                <a class="pull-right"><?php if(Yii::$app->user->identity['gender']==0) {
                                        echo "Мард";
                                    }
                                    else{
                                        echo "Зан";
                                    }
                                                    ?>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <b>Телефон</b> <a class="pull-right"><?= Yii::$app->user->identity['telefon'];?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Почтаи дохила</b> <a class="pull-right"><?= Yii::$app->user->identity['login'].'@ktk.tj';?></a>
                            </li>

                        </ul>


                    </div><!-- /.box-body -->
                </div><!-- /.box -->



            </div><!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#password" data-toggle="tab">Ивази парол</a></li>
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

                                <label for="inputEmail" class="col-sm-4 control-label">Пароли ҳозира</label>
                                <div class="col-sm-8">
                                    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароли ҳозира','name'=>'old_password'])->label(false) ?>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-4 control-label">Пароли нав</label>
                                <div class="col-sm-8">
                                    <?= $form->field($model, 'password')->passwordInput(['class'=>'form-control','placeholder'=>'Пароли нав','name'=>'new_password'])->label(false) ?>

                                    <?//= $form->field($model, 'name')->passwordInput(['placeholder' => 'Пароли нав','name'=>'new_password'])->label(false) ?>
                                </div>

                            </div>


                            <div class="form-group">
                                <label for="inputName" class="col-sm-4 control-label">Пароли навро такрор кунед</label>
                                <div class="col-sm-8">
                                    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароли навро такрор кунед','name'=>'new_password_double'])->label(false) ?>

                                </div>
                            </div>

                            <div class="form-group">


                                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>

                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>



                    </div><!-- /.tab-content -->
                </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
        </div><!-- /.row -->

    </section><!-- /.content -->
