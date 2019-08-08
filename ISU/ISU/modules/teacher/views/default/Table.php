<section class="content-header">
    <h1>
        Системаи иттилоотии идоракунии
        <small>Коллеҷи омӯзгорӣ ба номи М.Турсунзода</small>
    </h1>
    <?php //Yii::$app->getSecurity()->generatePasswordHash('0000'); ?>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Интихоб</a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">





            <div class="box box-primary" style="">
                <div class="table-responsive mailbox-messages" style="position: relative" id="scroll">
                    <div class="box-header with-border">
                        <div class="col-ms-12" style="">


                            <h3 class="box-title" style="">

                                <?php

                                $form = \yii\widgets\ActiveForm::begin();
                                // получаем всех авторов

                                // формируем массив, с ключем равным полю 'id' и значением равным полю 'name'
                                $items =  \yii\helpers\ArrayHelper::map($id_group, 'id_group', 'profession');
                                $params = [
                                    'prompt' => 'Гурӯҳро интихоб кунед...',

                                    'onchange'=>'$.get("@web/index.php?r=Teacher/default/table-read&id_group="+$(this).val(), function(data){
            $("#content").html(data);})'

                                ];
                                echo $form->field($model, 'id_profession')->dropDownList($items, $params, ['class' => 'form-control select2', 'style' => 'border-radius:4px; width:100%'])->label(false);

                                \yii\widgets\ActiveForm::end();
                                ?>

                            </h3></div>

                    </div>
                    <div class="box-body"  id="content">

                    </div>
                    <div class="box-footer">

                    </div>
                </div></div></div></div>
    </section>


<div class="col-md-12">

    <div class="group">

        <?php //echo "<pre>"; print_r($timetable_sinf); echo "</pre";?>
        <div class="title_box">



            <h3></h3>


        </div>


        </div>

    </div>
