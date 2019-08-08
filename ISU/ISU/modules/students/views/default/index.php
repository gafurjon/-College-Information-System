<?php


$this->title = 'Интихоб';
//$this->params['breadcrumbs'][] = $this->title;
?>
<?php //echo Html::img(Yii::getAlias('@web').'/image/logo-orginal.jpg', ['width' => '120px']);

?>
<section class="content-header">
    <h1>
        Системаи иттилоотии идоракунии
        <small>Коллеҷи технологӣ ба номи А. Қаҳҳоров</small>
    </h1>
    <?php //Yii::$app->getSecurity()->generatePasswordHash('0000'); ?>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Саҳифаи асосӣ</a></li>
    </ol>
</section>
<section class="content">
    <div class="row">

        <?php
        if(isset($news)){
        foreach ($news as $item){
        $nom=$item['name'];
        $rasm=$item['picture'];
        $rasm=substr($rasm, 3);
        $khabar=$item['news'];
        $sana=$item['date'];
        $ico=$item['ico'];
        $news_type=$item['news_type'];

        if ($rasm=='')
        {?>
        <div class='col-md-12'>
            <div class='box box-default'>
                <?php if ($news_type==1){?>
                <div class='box-header with-border'>
                    <?php }
                    elseif ($news_type==2){?>
                    <div class='box-header with-border' style='background-color: red;color: white;'>
                        <?php
                        }
                        ?>

                        <i class='fa  fa-bullhorn'></i>
                        <h3 class='box-title'><?php echo $nom;?></h3>
                    </div><!-- /.box-header -->
                    <div class='box-body'>
                        <div class='alert'>
                            <h4><i class='icon fa  <?php echo $ico; ?>'></i><?php echo $sana;?></h4>
                            <p style='text-align:justify;'><font color='black' face='Palatino Linotype'><?php echo $khabar; ?></font></p></div>
                    </div>

                </div>

            </div>
            <?php }
            else {?>

                <div class='col-md-12'>
                    <div class='box box-default'>
                        <div class='box-header with-border'>
                            <i class='fa  fa-bullhorn'></i>
                            <h3 class='box-title'>
                                <?php echo $nom; ?>
                            </h3>
                        </div><!-- /.box-header -->
                        <div class='box-body'>
                            <div class='alert'>
                                <h4><i class='icon fa  <?php echo $ico; ?>'></i>
                                    <?php echo $sana;?>
                                </h4>
                                <p>
                                    <?php echo $khabar;?>
                                </p><br>
                                <center><img style='max-height: 700px;max-width:100%;' src='
                      <?php echo yii\helpers\Url::to('@web/'.$rasm);?> '>
                                </center>
                            </div>

                        </div><!-- /.box-body -->
                    </div><!-- /.box -->




                </div><!-- /.col -->




                <?php
            }
            }  }
            ?>
        </div>
</section>