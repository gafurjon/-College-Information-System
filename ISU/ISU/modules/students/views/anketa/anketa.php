<?php
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use yii\widgets\Pjax;
use yii\helpers\Html;

?>
<section class='content'>
    <!-- Small boxes (Stat box) -->
    <div class='row' style='font-size: 12px'>

   <div class='col-md-12'>
  
             <? echo Html::beginForm('@web/index.php?r=students/anketa/save');?>

                        <? echo Html::hiddenInput('id_lesson', $id_lesson);?>
                        <? echo Html::hiddenInput('id_teacher', $id_teacher);?>
                        
                        <div class="box box-primary">
                          <div class="box-header with-border">

                          <i class="fa  fa-book"></i>
                          <h3 class="box-title"><?=$lesson;?></h3><p class="pull-right"><?=$fio;?></p>                          </div><!-- /.box-header -->
                          <div class="box-body no-padding">


                            <ul><br><p style="font-size:16px;">Бо мақсади баланд бардоштани сифати таҳсил аз Шумо хоҳиш менамоем, ки ба саволҳои зерин ҷавоб диҳед/В целях повышения качества обучения просим Вас ответить на поставленные вопросы анкеты</p></ul><? $i=1; foreach ($model as $itme) { ?>  

                            <? if($itme['type']==1){?>
                                                        <br>
                                <div class="col-md-12">
                                  <div class="box box-solid">
                                    <div class="box-header with-border" style="background-color: #CCFFFF">
                                      <i class="fa  fa-hand-o-right"></i>
                                      <h5 class="box-title"><?=$i.'.'.' '.$itme['savol'];?></h5>
                                      <p class="pull-right"> </p>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                    Интихоб кунед:<div class="radio">
                                                    <label>
                                                      <input type="radio" name="<?=$itme['id_savol'];?>" value="1">
                                                        1
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="<?=$itme['id_savol'];?>" value="2" checked>
                                                        2
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="<?=$itme['id_savol'];?>" value="3">
                                                        3
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="<?=$itme['id_savol'];?>" value="4" ="checked">
                                                        4
                                                    </label>

                                                  </div>
                                      <h3></h3>
                                    </div><!-- /.box-body -->
                                  </div><!-- /.box -->
                                </div>
                                
                                 <br>
                                 <? } ?>

                              <? if($itme['type']==2){?>
                                                        <br>
                                <div class="col-md-12">
                                  <div class="box box-solid">
                                    <div class="box-header with-border" style="background-color: #CCFFFF">
                                      <i class="fa  fa-hand-o-right"></i>
                                      <h5 class="box-title"><?=$i.'.'.' '.$itme['savol'];?></h5>
                                      <p class="pull-right"> </p>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                    Ҳа/Не:<div class="radio">
                                                    <label>
                                                      <input type="radio" name="<?=$itme['id_savol'];?>" value="1">
                                                        Ҳа
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="<?=$itme['id_savol'];?>" value="0" checked="checked">
                                                        Не
                                                    </label>

                                                  </div>
                                      <h3></h3>
                                    </div><!-- /.box-body -->
                                  </div><!-- /.box -->
                                </div>
                                <br>
                                <? } 
                                $i++; } ?>

                            
                          </div><!-- /.box-body -->

                          <div class="box-footer">
                  <div class="pull-right">
                     <button type="submit" name="send" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Фиристодан</button>
                  </div>
                  <a href="javascript:history.back()" type="reset" name="cancel" class="btn btn-default"><i class="fa  fa-reply"></i> Бозгашт</a>
                </div><!-- /.box-footer -->


                        </div><!-- /. box -->
                    <?php echo Html::endForm(); ?>
                      </div><!-- /.col -->
</div>
</section>