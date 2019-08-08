<div class="table-header">
    <center>
        <p style="font-size: 20px;">Тартибдиҳии ҷадвали раванди таълим</p></center>
</div>
<section class="page-content">
    <div class="row">
        <?php
        if(count($data) > 0) {
            ?>

            <h3 class="col-xs-3">
                <?php

                $form = \yii\widgets\ActiveForm::begin();
                // получаем всех авторов

                // формируем массив, с ключем равным полю 'id' и значением равным полю 'name'
                $items = \yii\helpers\ArrayHelper::map($data, 'id_group','groupcourse');
                $params = [
                    'prompt' => 'Гурӯҳро интихоб кунед...',

                    'onchange'=>'$.get("index.php?r=admin/plan/plan&id_group="+$(this).val(), function(data){$("#content").html(data);})'

                ];
                echo $form->field($model, 'profession')->dropDownList($items, $params, ['class' => 'form-control select2', 'style' => 'border-radius:4px; width:100%'])->label(false);

                \yii\widgets\ActiveForm::end();

                ?>
            </h3>
        <?php }?>


    </div>


    <div class="box-body" id="content">
           </div>


</section>