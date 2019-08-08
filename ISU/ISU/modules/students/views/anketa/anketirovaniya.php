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
   <? debug($persons);?>
             <? echo Html::beginForm('@web/index.php?r=students/anketa/anketa');?>
                        
                        <div class="box box-primary">
                          <div class="box-header with-border">

                          <i class="fa  fa-book"></i>
                          <h3 class="box-title">Практикуми тахассусӣ</h3><p class="pull-right">Худойбердиев Хуршед Атохонович</p>                          </div><!-- /.box-header -->
                          <div class="box-body no-padding">


                            <ul><br><p style="font-size:16px;">Бо мақсади баланд бардоштани сифати таҳсил аз Шумо хоҳиш менамоем, ки ба саволҳои зерин ҷавоб диҳед/В целях повышения качества обучения просим Вас ответить на поставленные вопросы анкеты</p></ul>                            <br>
                                <div class="col-md-12">
                                  <div class="box box-solid">
                                    <div class="box-header with-border" style="background-color: #CCFFFF">
                                      <i class="fa  fa-hand-o-right"></i>
                                      <h5 class="box-title">1. То чӣ андоза омӯзгор маводҳои дарсиро саривақт ба Шумо мефиристад?/Насколько преподаватель вовремя отправляет Вам учебные материалы?</h5>
                                      <p class="pull-right"> </p>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                    Интихоб кунед:<div class="radio">
                                                    <label>
                                                      <input type="radio" name="CQhmCWcG" value="1">
                                                        1
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQhmCWcG" value="2">
                                                        2
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQhmCWcG" value="3">
                                                        3
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQhmCWcG" value="4" checked="checked">
                                                        4
                                                    </label>

                                                  </div>
                                      <h3></h3>
                                    </div><!-- /.box-body -->
                                  </div><!-- /.box -->
                                </div>

                                                        <br>
                                <div class="col-md-12">
                                  <div class="box box-solid">
                                    <div class="box-header with-border" style="background-color: #CCFFFF">
                                      <i class="fa  fa-hand-o-right"></i>
                                      <h5 class="box-title">2. Омӯзгор то чӣ андоза бо мисол ва масъалаҳои мушаххас ҳар мавзӯъро пурра мекунад?/Насколько преподаватель дополняет занятия конкретными примерами?</h5>
                                      <p class="pull-right"> </p>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                    Интихоб кунед:<div class="radio">
                                                    <label>
                                                      <input type="radio" name="CQhmCWcF" value="1">
                                                        1
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQhmCWcF" value="2">
                                                        2
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQhmCWcF" value="3">
                                                        3
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQhmCWcF" value="4" checked="checked">
                                                        4
                                                    </label>

                                                  </div>
                                      <h3></h3>
                                    </div><!-- /.box-body -->
                                  </div><!-- /.box -->
                                </div>

                                                        <br>
                                <div class="col-md-12">
                                  <div class="box box-solid">
                                    <div class="box-header with-border" style="background-color: #CCFFFF">
                                      <i class="fa  fa-hand-o-right"></i>
                                      <h5 class="box-title">3. Омӯзгор то чӣ андоза  ба кори фиристодашудаи Шумо саривақт  баҳо мегузорад?/Насколько преподаватель вовремя оценивает отправленную Вами работу?</h5>
                                      <p class="pull-right"> </p>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                    Интихоб кунед:<div class="radio">
                                                    <label>
                                                      <input type="radio" name="CQhmCWcE" value="1">
                                                        1
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQhmCWcE" value="2">
                                                        2
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQhmCWcE" value="3">
                                                        3
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQhmCWcE" value="4" checked="checked">
                                                        4
                                                    </label>

                                                  </div>
                                      <h3></h3>
                                    </div><!-- /.box-body -->
                                  </div><!-- /.box -->
                                </div>

                                                        <br>
                                <div class="col-md-12">
                                  <div class="box box-solid">
                                    <div class="box-header with-border" style="background-color: #CCFFFF">
                                      <i class="fa  fa-hand-o-right"></i>
                                      <h5 class="box-title">4. Омӯзгор то чӣ андоза баҳои гузоштаашро эзоҳ медиҳад?/ Насколько преподаватель комментирует поставленную  оценку? </h5>
                                      <p class="pull-right"> </p>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                    Интихоб кунед:<div class="radio">
                                                    <label>
                                                      <input type="radio" name="CQhmCWcD" value="1">
                                                        1
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQhmCWcD" value="2">
                                                        2
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQhmCWcD" value="3">
                                                        3
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQhmCWcD" value="4" checked="checked">
                                                        4
                                                    </label>

                                                  </div>
                                      <h3></h3>
                                    </div><!-- /.box-body -->
                                  </div><!-- /.box -->
                                </div>

                                                        <br>
                                <div class="col-md-12">
                                  <div class="box box-solid">
                                    <div class="box-header with-border" style="background-color: #CCFFFF">
                                      <i class="fa  fa-hand-o-right"></i>
                                      <h5 class="box-title">5. Омӯзгор то чӣ андоза вебинарро шавқовар мегузарад?/ Насколько преподаватель интересно проводит вебинар?</h5>
                                      <p class="pull-right"> </p>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                    Интихоб кунед:<div class="radio">
                                                    <label>
                                                      <input type="radio" name="CQhmCWcC" value="1">
                                                        1
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQhmCWcC" value="2">
                                                        2
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQhmCWcC" value="3">
                                                        3
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQhmCWcC" value="4" checked="checked">
                                                        4
                                                    </label>

                                                  </div>
                                      <h3></h3>
                                    </div><!-- /.box-body -->
                                  </div><!-- /.box -->
                                </div>

                                                        <br>
                                <div class="col-md-12">
                                  <div class="box box-solid">
                                    <div class="box-header with-border" style="background-color: #CCFFFF">
                                      <i class="fa  fa-hand-o-right"></i>
                                      <h5 class="box-title">6. То чӣ андоза барои Шумо маводҳои фиристодаи устод (назария, презентатсия, видеофрагментҳо) шавқоваранд?/ Насколько интересны отправленные учебные материалы (лекционные, презентации, видеофрагменты ) преподавателя?</h5>
                                      <p class="pull-right"> </p>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                    Интихоб кунед:<div class="radio">
                                                    <label>
                                                      <input type="radio" name="CQhmCWcB" value="1">
                                                        1
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQhmCWcB" value="2">
                                                        2
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQhmCWcB" value="3">
                                                        3
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQhmCWcB" value="4" checked="checked">
                                                        4
                                                    </label>

                                                  </div>
                                      <h3></h3>
                                    </div><!-- /.box-body -->
                                  </div><!-- /.box -->
                                </div>

                                                        <br>
                                <div class="col-md-12">
                                  <div class="box box-solid">
                                    <div class="box-header with-border" style="background-color: #CCFFFF">
                                      <i class="fa  fa-hand-o-right"></i>
                                      <h5 class="box-title">7. То чӣ андоза умеди Шумо аз ин фан иҷро шуд?/ Насколько оправдались Ваши ожидания от данной дисциплины?</h5>
                                      <p class="pull-right"> </p>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                    Интихоб кунед:<div class="radio">
                                                    <label>
                                                      <input type="radio" name="CQhmCWcA" value="1">
                                                        1
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQhmCWcA" value="2">
                                                        2
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQhmCWcA" value="3">
                                                        3
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQhmCWcA" value="4" checked="checked">
                                                        4
                                                    </label>

                                                  </div>
                                      <h3></h3>
                                    </div><!-- /.box-body -->
                                  </div><!-- /.box -->
                                </div>

                                                        <br>
                                <div class="col-md-12">
                                  <div class="box box-solid">
                                    <div class="box-header with-border" style="background-color: #CCFFFF">
                                      <i class="fa  fa-hand-o-right"></i>
                                      <h5 class="box-title">8. Оё омӯзгор боадолатона ба дониши Шумо баҳо медиҳад?/Объективен ли преподаватель в оценке Ваших знаний и умений?</h5>
                                      <p class="pull-right"> </p>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                    Интихоб кунед:<div class="radio">
                                                    <label>
                                                      <input type="radio" name="CQhmCWcP" value="1">
                                                        1
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQhmCWcP" value="2">
                                                        2
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQhmCWcP" value="3">
                                                        3
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQhmCWcP" value="4" checked="checked">
                                                        4
                                                    </label>

                                                  </div>
                                      <h3></h3>
                                    </div><!-- /.box-body -->
                                  </div><!-- /.box -->
                                </div>

                                                        <br>
                                <div class="col-md-12">
                                  <div class="box box-solid">
                                    <div class="box-header with-border" style="background-color: #CCFFFF">
                                      <i class="fa  fa-hand-o-right"></i>
                                      <h5 class="box-title">9. Баҳои умумии Шумо ба сифати дарс./ Ваша оценка занятиям в целом.</h5>
                                      <p class="pull-right"> </p>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                    Интихоб кунед:<div class="radio">
                                                    <label>
                                                      <input type="radio" name="CQhmCWcO" value="1">
                                                        1
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQhmCWcO" value="2">
                                                        2
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQhmCWcO" value="3">
                                                        3
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQhmCWcO" value="4" checked="checked">
                                                        4
                                                    </label>

                                                  </div>
                                      <h3></h3>
                                    </div><!-- /.box-body -->
                                  </div><!-- /.box -->
                                </div>

                                                        <br>
                                <div class="col-md-12">
                                  <div class="box box-solid">
                                    <div class="box-header with-border" style="background-color: #CCFFFF">
                                      <i class="fa  fa-hand-o-right"></i>
                                      <h5 class="box-title">10. Тавассути илтимос ё хоҳиш гирифтани баҳо имкон дорад?/ Возможно ли получить хорошую оценку по просьбе? </h5>
                                      <p class="pull-right"> </p>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                    Ҳа/Не:<div class="radio">
                                                    <label>
                                                      <input type="radio" name="CQtmCWcGBw==" value="Yes">
                                                        Ҳа
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQtmCWcGBw==" value="No" checked="checked">
                                                        Не
                                                    </label>

                                                  </div>
                                      <h3></h3>
                                    </div><!-- /.box-body -->
                                  </div><!-- /.box -->
                                </div>

                                                        <br>
                                <div class="col-md-12">
                                  <div class="box box-solid">
                                    <div class="box-header with-border" style="background-color: #CCFFFF">
                                      <i class="fa  fa-hand-o-right"></i>
                                      <h5 class="box-title">11. Бо воситаи пул ё чиз гирифтани баҳо имконпазир аст?/Возможно ли получить хорошую оценку за плату?</h5>
                                      <p class="pull-right"> </p>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                    Ҳа/Не:<div class="radio">
                                                    <label>
                                                      <input type="radio" name="CQtmCWcGBg==" value="Yes">
                                                        Ҳа
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQtmCWcGBg==" value="No" checked="checked">
                                                        Не
                                                    </label>

                                                  </div>
                                      <h3></h3>
                                    </div><!-- /.box-body -->
                                  </div><!-- /.box -->
                                </div>

                                                        <br>
                                <div class="col-md-12">
                                  <div class="box box-solid">
                                    <div class="box-header with-border" style="background-color: #CCFFFF">
                                      <i class="fa  fa-hand-o-right"></i>
                                      <h5 class="box-title">12. Мехоҳед, ки ҳамин омузгор дар семестрҳои оянда ба Шумо дарс диҳад?/Хотите ли Вы чтобы этот преподаватель вел у Вас занятия в следующих семестрах?</h5>
                                      <p class="pull-right"> </p>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                    Ҳа/Не:<div class="radio">
                                                    <label>
                                                      <input type="radio" name="CQtmCWcGBQ==" value="Yes">
                                                        Ҳа
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label>
                                                      <input type="radio" name="CQtmCWcGBQ==" value="No" checked="checked">
                                                        Не
                                                    </label>

                                                  </div>
                                      <h3></h3>
                                    </div><!-- /.box-body -->
                                  </div><!-- /.box -->
                                </div>

                            
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