<?php
/**
 * Created by PhpStorm.
 * User: Хуршед
 * Date: 19.05.2017
 * Time: 03:55
 */

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<?php
/**
 * Created by PhpStorm.
 * User: Хуршед
 * Date: 19.05.2017
 * Time: 00:18
 */
?>
<section class="content-header">
    <h1>
        Рейтинг
        <small></small>
    </h1>
    <?php //Yii::$app->getSecurity()->generatePasswordHash('0000'); ?>
    <ol class="breadcrumb">
        <li><a href="<?php echo \yii\helpers\Url::to('@web/index.php?r=teacher/default/index'); ?>"><i class="fa fa-dashboard"></i>Саҳифаи асосӣ</a></li>
        <li class="active">Ариза</li>
    </ol>
</section>
<section class="content">
    <div class="row">


        <div class='col-md-12'>
            <div class='box box-primary'>

                <div class='box-header with-border'>
                    <div class="table-responsive mailbox-messages" style="position: relative" id="scroll">
                        <div class='box-header with-border'>


                            <i class=''></i>
                            <h3 class='box-title'>Ариза</h3>
                        </div><!-- /.box-header -->
                        <div class='box-body'>
                            <?php
                            if(isset($save)){
                                ?>

                                <div class="alert alert-info alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-info"></i>Огоҳи</h4>
                                    Аризаи шумо бо муваффақият фиристода шуд!!!
                                </div>
                            <?}?>
                            <div class="col-sm-5">

                            <?php
                            if(count($lessons)>0) {
                                $form = ActiveForm::begin([
                                    'id' => 'about-form',
                                    'method' => 'post',
                                    'options' => [
                                        'onctype' => 'multipart/form-data',
                                    ],
                                ]);
                                $items = ArrayHelper::map($lessons, 'time_and_date', 'concat');
                                $params = [
                                    'prompt' => 'Номи фан...',
                                    'onchange' => '$.get("index.php?r=teacher/default/group&id_lesson="+$(this).val(), function(data){$("#group").html(data);})'


                                ];
                                echo $form->field($model, 'id_ariza')->dropDownList($items, $params, ['class' => 'form-control', 'style' => 'border-radius:4px; width:100%'])->label(false);

                            ?>

                            </div>
                            <div class="col-sm-5" id="group">


                            </div>
                            <div class="col-sm-2" onclick='$.get("index.php?r=teacher/default/select_ariza", function(data){$("#content").html(data);})'>
                                Дидани аризаи навишташуда
                            </div>
                            <div class="col-md-12" id="content">

                            </div>
                            <?php ActiveForm::end(); }?>


                        </div>
                        <div class="box-footer">
                        </div>
                    </div>

                </div>

            </div>




        </div>
</section>

