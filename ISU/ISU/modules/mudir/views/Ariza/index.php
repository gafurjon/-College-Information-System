<?
use yii\helpers\Html;
?>
<!-- Кисми асоси контент-->
<section class="page-content">
    <div class="row">

        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Рӯйхати аризаҳо</h3>

                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <? echo Html::beginForm('@web/index.php?r=mudir/default/insert_ariza');?>
                    <table class="table table-striped table-bordered table-hover" >
                        <tr>
                            <th><P align="center">№</P></th>
                            <th><p align="center">Омузгор</p></th>
                            <th><p align="center">Сана</p></th>

                        </tr>

                        <?php
                        $raqam=1;

                        foreach ($arizaho as $item) {
                            if($item['teacher']['id_kafedra']===$session['id_kafedra']){
                          $fio=$item['teacher']['person']['0']['surname'].' '.$item['teacher']['person']['0']['name'].' '.
                                $item['teacher']['person']['0']['middle_name'];?>
                            <tr align='center'>
                                <td><?php echo $raqam; ?></td>
                                <td align='left'><a href="<?= \yii\helpers\Url::to('/web/index.php?r=mudir/ariza/select_ariza&id=').$item['id_ariza']?>"><?php echo $fio;?></a> </td>
                                <td><?php echo $item['date_save'];?></td>


                            </tr>
                            <?php }
                            $raqam++; } ?>

                    </table>
                    <? echo Html::endForm();?>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.box -->
    </div>
</section>
<!-- /.content -->

