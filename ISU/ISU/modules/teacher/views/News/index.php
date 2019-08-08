<?php
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use yii\widgets\Pjax;
use yii\helpers\Html;

?>



<section class="page-content">
    <div class="row">
        <div class="col-xs-8">
            <div class="box-body">
                <?php
                if(isset($save)){
                    ?>

                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-info"></i>Огоҳӣ</h4>
                        Хабар ворид гашт.
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
                <table class="table table-striped table-bordered table-hover">
                    <tbody><tr><th>Файлро интихоб кунед:</th><td>
                            <?= $form->field($model, 'picture')->fileInput()->label(false)?></td></tr>
                    <tr><th>Номи хабарро нависед:</th><td>
                            <?=$form->field($model, 'name')->textInput(['autofocus' => true, 'class'=>'form-control','placeholder'=>'Номи хабар'])->label(false);?>
                            <div id="errormsg" style="color:red;"></div></td>
                    </tr>
                    <tr><th>Маводи заруриро ворид кунед:</th>
                        <td>
                            <?= $form->field($model, 'news')->textarea(['autofocus' => true, 'class'=>'form-control','placeholder'=>'Мавъзӯи хабар'])->label(false); ?>
                        </td></tr>
                    <tr><th>Барои:</th>
                        <td>
                            <input type="radio" value="2" name="status"> <b>Омӯзгор</b> &nbsp;&nbsp;&nbsp;
                            <select name="teacher"><option selected="selected" value="0">----</option>
                                <?php $i=1; foreach ($teachers as $teacher){ ?>
                                    <option value="<?=$teacher['id_teacher']?>"><?=$teacher['person']['0']['surname'].' '.$teacher['person']['0']['name'].' '.$teacher['person']['0']['middle_name']?></option>
                                    <?php $i++;}?>
                        </td>
                    </tr>


                    <?php $i=1; foreach($users as $user) {

                        if($user['user_id']==2){
                            echo "<tr><th>Барои:</th><td>";?>
                            <input type='radio' value='<?=$user['user_id']?>' name='status'> <b><?=$user['name_user'].'он'?></b></td>
                            <?php echo "</tr>";
                        }

                        elseif($user['user_id']==3){
                            echo "<tr><th>Барои:</th><td>";?>
                            <input type='radio' value='<?=$user['user_id']?>' name='status'> <b><?=$user['name_user'].'ён'?></b></td>
                            <?php echo "</tr>";
                        }
                        else {
                            echo "<tr><th>Барои:</th><td>";?>
                            <input type='radio' value='<?=$user['user_id']?>' name='status'> <b><?=$user['name_user']?></b></td>
                            <?php echo "</tr>";}
                        $i++;

                    }?>
                    <tr><th>&nbsp;</th>
                        <td>

                            <?= Html::resetButton('Сбрось', ['class' => 'btn btn-default']) ?>

                            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success pull-right']) ?>


                        </td>
                    </tr></tbody></table>
                <?php ActiveForm::end() ?>




            </div>
        </div>
</section>









