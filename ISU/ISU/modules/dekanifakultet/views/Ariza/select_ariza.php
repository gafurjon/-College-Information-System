<section class="content">
    <div class="row">


        <div class='col-md-12'>
            <div class='box box-primary'>

                <div class='box-header with-border'>
                    <div class="table-responsive mailbox-messages" style="position: relative" id="scroll">
                        <div class='box-header with-border'>


                            <i class=''></i>
                            <h3 class='box-title'>Азназаргузаронидани ариза</h3>
                        </div><!-- /.box-header -->
                        <div class='box-body'>
                            <div class="col-sm-5">


                            </div>
                            <div class="col-sm-5" id="group">


                            </div>
                            <div class="col-md-12" id="content">
                                <blockquote class="col-md-3 pull-right" >
                                    <p style='text-align: justify;'>Ба номи директори
                                        коллеҷи технологи </p><b class='center text-align: center;'>Ҳомидов М.Т.</b>
                                    <br>
                                    <p class='pull-left'> Аз номи омӯзгор </p><br>
                                    <p class='center pull-right '>
                                        <? foreach ($ariza as $item) :?>
                                        <b><?=$fio=$item['teacher']['person']['0']['surname'].' '.$item['teacher']['person']['0']['name'].' '.
                                                $item['teacher']['person']['0']['middle_name'];?></b>
                                    </p>
                                </blockquote>
                                <div class='clearfix'><br></div>
                                <h2 style="text-align: center">АРИЗА</h2>
                                <div style="text-align: justify">
                                    <h3> <?=$item['sababi_ivaz']?><p align="center">Баҳои  <?=$item['mark_old']?>
                                            ба баҳои <?=$item['mark_new']?> иваз карда шавад!</p></h3>
                                </div>

                                <div class='col-md-12' style='font-size: 20px'>
                                    Аризадиҳанда : <b class='pull-right'> <?=$fio?></b>
                                </div>

                                <div class='clearfix'></div>
                                <div class='col-md-12' style='font-size: 20px'>
                                    Сана :<b class='pull-right'> <?= date('d.m.Y'); ?> </b>
                                </div>
                                <div class='col-md-12' style='font-size: 20px'>
                                    <?  echo \yii\helpers\Html::beginForm('@web/index.php?r=dekanifakultet/ariza/save'); ?>
                                    Имзо :<b class='pull-right'> <?= \yii\helpers\Html::submitButton('Гузоштани имзо',['class'=>'btn btn-primary']); ?> </b>

                                    <? echo \yii\helpers\Html::hiddenInput('id_ariza',$item['id_ariza']);?>

                                <? echo \yii\helpers\Html::endForm();?>
                                </div>
                                <? endforeach;?>
                            </div>


                        </div>

                    </div>

                </div>

            </div>




        </div>
</section>