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
                        Маълумотҳои зарури ворид карда шуд!
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


                <div class="box-header">
                    <h3 class="box-title">Иловаи фанн</h3>
                </div>
                <??>
                <form name='Guest' method='post' enctype='Multipart/form-data' >
                    <div class="box-body">


                        <!-- Ном -->
                        <!-- <div class="form-group">
                            <label>Номи фан</label>
                            <input style='width:270px' type="text" name='name' class="form-control" placeholder="Номи фан...">
                        </div> -->

                <div class="input-group" style='width:270px'>
                     <label>Номи фан</label>

                     <select class="form-control" name='name' id="form-field-select-1">
                          <option value="">Номи фан...</option>

                          <?php 

                          foreach ($lesson as $les) { ?>
                         
                            

                            <option name="name" value=<?=$les['id_lesson'];?>><?=$les['name'];?></option>

                           

                          <?php }?>
                            
                            
                                                                
                    </select>
                </div>

                        <div class="form-group">
                            <label>Коди фан</label>
                            <input style='width:270px' type="text" name='code_lesson' class="form-control" placeholder="Коди фан...">
                        </div>

                        <!-- radiobutton -->
                        <div class="form-group">
                            <label>Mикдори кредит:</label><br>
                            <label>
                                <input type="radio" value="1" name="kredit" class="minimal" checked>
                                1
                            </label>
                            <label>
                                <input type="radio" name="kredit" value="2" class="minimal">
                                2
                            </label>
                            <label>
                                <input type="radio" name="kredit" value="3" class="minimal">
                                3
                            </label>
                            <label>
                                <input type="radio" name="kredit" value="4" class="minimal">
                                4
                            </label>
                            <label>
                                <input type="radio" name="kredit" value="5" class="minimal">
                                5
                            </label>
                            <label>
                                <input type="radio" name="kredit" value="6" class="minimal">
                                6
                            </label>
                        </div>
                        <!-- Вилоят -->
                        <div class="form-group">
                            <label>Категория</label><br>
                            <select name="kategoriya">
                                <option selected="selected" value="0">----</option>
                                <?php $i=1; foreach ($categoriya as $cat){ ?>
                                    <option value="<?=$cat['id_category']?>"><?=$cat['name_category']?></option>
                                    <?php $i++;}?>
                            </select>
                        </div>

                        <!-- Ноҳия -->
                        <div class="form-group">
                            <label>Ихтисос</label><br>
                            <select name="profession">
                                <option selected="selected" value="0">----</option>
                                <?php $i=1; foreach ($profession as $item){ ?>

                                    <option value="<?=$item['id_profession']?>"><?=$item['profession'].'-'.$item['name']?></option>
                                    <?php $i++;}?>
                            </select>
                        </div>
                        <!-- Суроға -->


                        <!--Kafedra-->
                        <div class="form-group">
                            <label>Кафедра</label><br>
                            <select name="kafedra">
                                <option selected="selected" value="0">----</option>
                                <?php $i=1; foreach ($kafedra as $kafedra){ ?>

                                    <option value="<?=$kafedra['id_kafedra']?>"><?=$kafedra['id_kafedra'].'-'.$kafedra['name_kafedra']?></option>
                                    <?php $i++;}?>
                            </select>
                        </div>
                        <!--Намуди таҳсил-->

                        <div class="form-group">
                            <label>Cместр:</label><br>
                            <label>
                                <input type="radio" value="1" name="smestr" class="minimal" checked>
                                1
                            </label>
                            <label>
                                <input type="radio" name="smestr" value="2" class="minimal">
                                2
                            </label>
                            <label>
                                <input type="radio" name="smestr" value="3" class="minimal">
                                3
                            </label>
                            <label>
                                <input type="radio" name="smestr" value="4" class="minimal">
                                4
                            </label>
                            <label>
                                <input type="radio" name="smestr" value="5" class="minimal">
                                5
                            </label>
                            <label>
                                <input type="radio" name="smestr" value="6" class="minimal">
                                6
                            </label>
                            <label>
                                <input type="radio" name="smestr" value="7" class="minimal">
                                7
                            </label>
                            <label>
                                <input type="radio" name="smestr" value="8" class="minimal">
                                8
                            </label>
                        </div>


                    </div><!-- /.box-body -->
                     

                        <!-- radiobutton -->
                        <div class="form-group">
                            <label>Миқдори кмд:</label><br>
                            <label>
                                <input type="radio" value="0" name="kmd" class="minimal" checked>
                                0
                            </label>
                            <label>
                                <input type="radio" name="kmd" value="1" class="minimal">
                                1
                            </label>
                            <label>
                                <input type="radio" name="kmd" value="2" class="minimal">
                                2
                            </label>
                            <label>
                                <input type="radio" name="kmd" value="3" class="minimal">
                                3
                            </label>
                            
                        </div>
                    <div class="box-footer">


                        <?= Html::resetButton('Сбрось', ['class' => 'btn btn-primary']) ?>

                        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>


                    </div>
                    <?php ActiveForm::end() ?>
            </div><!-- /.box -->



        </div><!-- /.col (left) -->

    </div><!-- /.row -->

</section><!-- /.content -->