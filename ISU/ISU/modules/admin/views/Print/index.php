<?php
/**
 * Created by PhpStorm.
 * User: Гафурджон
 * Date: 29.04.2017
 * Time: 22:17
 */
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\Html;

?>
<div class="table-header">
    <center>
        <p style="font-size: 20px;">Кор бо варақаи имтиҳонот</p></center>
</div>
<section class="content">
    <div class="row" style="margin-left: 50px;">
        <div class="col-xs-6" style="text-align: center">
            <!-- general form elements -->
            
            <?php
                $form = ActiveForm::begin([
                    'id'                          =>    'about-form',
                    'action'                        =>    'index.php?r=admin/print/vedemost',
                    'method'                      =>    'post',
                    'options' => [
                        'onctype' => 'multipart/form-data',
                    ],
                ]); ?>

                <div class="box-body" align="center">
                 
                <div class="col-xs-12 col-sm-10">
                <div class="row">
                <div class="input-group">
                     <span class="input-group-addon">
                        <i class="ace-icon fa fa-check"> Гурӯҳро интихоб намоед</i>
                     </span>
                     <select class="form-control" name='groups' id="form-field-select-1" onchange = '$.get("index.php?r=admin/print/abc&id_group="+$(this).val(), function(data){$("#select_lesson").html(data);})'>
                        <option value="">Гурӯҳро интихоб намоед...</option>
                        <?php foreach ($data as $group) { ?>

                        <option value=<?=$group['id_group']?>><?=$group['groupcourse']?></option>

                        <?php }
                        ?>
                         
                                                                
                    </select>

                </div><br>



                <div id="select_lesson">
                <div class="input-group">
                     <span class="input-group-addon">
                        <i class="ace-icon fa fa-check"> Фанро интихоб намоед</i>
                     </span>

                     <?php if($groups==0 or $groups==''){?>

                     <select class="form-control"  name='lesson' id="form-field-select-1"  disabled="disabled">

                     <? } else {?>
                     <select class="form-control"  name='lesson' id="form-field-select-1" > <? }?>

                        <option value="">Фанро интихоб намоед...</option>
                       
                                                                
                    </select>
                </div></div><br>


                <div class="input-group">
                     <span class="input-group-addon">
                        <i class="ace-icon fa fa-check"> Кӯшишро интихоб намоед</i>
                     </span>

                     <select class="form-control" name='kushish' id="form-field-select-1">
                          <option value="">Кӯшишро интихоб намоед...</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                                                                
                    </select>
                </div><br>


               <!--  <div class="input-group">
                     <span class="input-group-addon">
                        <i class="ace-icon fa fa-check"> Соли хониш</i>
                     </span>

                     <input type="text" name='studies_year' class="form-control search-query" placeholder="Соли хониш" />
                      
                </div><br> -->


                <div class="input-group">
                     <span class="input-group-addon">
                        <i class="ace-icon fa fa-check"> Сана *</i>
                     </span>

                     <input type="text" name='date' class="form-control search-query" placeholder="Санаи сохтани ведемост" />
                      
                </div><br>


                <div class="input-group">
                     <span class="input-group-addon">
                        <i class="ace-icon fa fa-check"> №ведемост</i>
                     </span>

                     <input type="text" name='vedomost' class="form-control search-query" placeholder="Рақами ведемост" />
                      
                </div><br>

                 <div class="input-group">
                     <span class="input-group-addon">
                        <i class="ace-icon fa fa-check"> С.м.бақайдгирӣ</i>
                     </span>

                     <input type="text" name='bakaydgiri_FIO' class="form-control search-query" value="Ганиева Ф ." />
                      
                </div><br>

                <div class="input-group">
                     <span class="input-group-addon">
                        <i class="ace-icon fa fa-check"> С.м.тестӣ</i>
                     </span>

                     <input type="text" name='testi_FIO' class="form-control search-query" value="Ғафуров А." />
                      
                </div><br>


                <?= Html::resetButton('Тоза кардан', ['class' => 'btn btn-default']) ?>

                <?= Html::submitButton('Сохтани ведемост', ['class' => 'btn btn-primary pull-right']) ?>


                <?php ActiveForm::end() ?>
               
                </div><!-- /.box-body -->
                </div>
                </div>

                <div class="box-footer">
                    <div class="form-group">



                    </div>
                </div>

            </div><!-- /.box -->

            
        </div>
    </div>


    
</section>