<?
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>


<section class="content-header">
    <h1>
        Пурсишномаи донишҷӯ    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Саҳифаи аввал</a></li>
        <li class="active">Пурсишномаи донишҷӯ  </li>
    </ol>
</section>

<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row" style="font-size: 12px">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Рӯйхати пурсишномаҳо</h3>

                </div><!-- /.box-header -->
                <div class="box-body no-padding"><br>

                <?php foreach ($model as $item) :?>
                    <? 
                        // debug($item);
                    $fio=$item['surname'].' '.
                        $item['name'].' '.
                        $item['middle_name'];?>
                    <div class="col-md-6">
                        <div class="box box-solid">
                            <div class="box-header with-border" style="background-color: #FFFFCC">
                                <i class="fa  fa-book"></i>
                                <h5 class="box-title" style="font-size: 14px;"><?=$item['lesson_name'];?></h5>
                                <p class="pull-right"><?=$fio?></p>
                            </div><!-- /.box-header -->
                            <div class="box-body">

                               <? echo Html::beginForm('@web/index.php?r=students/anketa/anketa');?>

                                <p align="center">
                                    <? echo Html::hiddenInput('id_lesson', $item['id_lesson']);?>
                                    <? echo Html::hiddenInput('id_teacher', $item['id_teacher']);?>
                                    <? echo Html::hiddenInput('lesson_name', $item['lesson_name']);?>
                                    <? echo Html::hiddenInput('fio', $fio);?>

<!--                                    <button type="button" class="btn btn-primary pull-right">-->
<!--                                    Пур кардани пурсишнома</button>-->
                                    <? echo Html::submitButton('Пур кардани пурсишнома', ['name' => 'bapesh', 'class' => 'btn btn-primary']);?>

                                </p>

                            </div><!-- /.box-body -->

                            <?php echo Html::endForm(); ?>
                        </div><!-- /.box -->
                    </div>
                    <? endforeach;?>

                </div><!-- /.box-body -->
            </div><!-- /. box -->
        </div><!-- /.col -->
    </div>

</section>

