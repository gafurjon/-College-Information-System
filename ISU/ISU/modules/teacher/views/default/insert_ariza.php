<?php
/**
 * Created by PhpStorm.
 * User: Хуршед
 * Date: 19.05.2017
 * Time: 03:55
 */

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<?php
/**
 * Created by PhpStorm.
 * User: Хуршед
 * Date: 19.05.2017
 * Time: 00:18
 */
?>
<section class="content-header">
    <h1>
        Ариза барои ислоҳи баҳо
        <small></small>
    </h1>
    <?php //Yii::$app->getSecurity()->generatePasswordHash('0000'); ?>
    <ol class="breadcrumb">
        <li><a href="<?php echo \yii\helpers\Url::to('@web/index.php?r=teacher/default/index'); ?>"><i class="fa fa-dashboard"></i>Саҳифаи асосӣ</a></li>
        <li class="active">Ариза барои ислоҳи баҳо</li>
    </ol>
</section>
<section class="content">
    <div class="row">


        <div class='col-md-12'>
            <div class='box box-primary'>

                <div class='box-header with-border'>
                    <div class="table-responsive mailbox-messages" style="position: relative" id="scroll">
                        <div class='box-header with-border'>


                            <i class=''></i>
                            <h3 class='box-title'>Ариза барои ислоҳи баҳо</h3>
                        </div><!-- /.box-header -->
                        <div class='box-body'>
                            <div class="col-sm-5">


                            </div>
                            <div class="col-sm-5" id="group">


                            </div>
                            <div class="col-md-12" id="content">
                                <blockquote class="col-md-3 pull-right" >
                                    <p style='text-align: justify;'>Ба номи директори
                                        Коллеҷи омӯзгорӣ ба номи М.Турсунзода</p><b class='center text-align: center;'>Ному  насаб</b>
                                    <br>
                                    <p class='pull-left'> Аз номи омӯзгор </p><br>
                                    <p class='center pull-right '>
                                        <b> <?= Yii::$app->user->identity['surname']," ". Yii::$app->user->identity['name']," ". Yii::$app->user->identity['middle_name'] ?> </b>
                                    </p>
                                </blockquote>
                                <div class='clearfix'><br></div>
                                <h2 style="text-align: center">АРИЗА</h2>
                                <div style="text-align: center">
                                <?php
                                echo \yii\helpers\Html::beginForm('@web/index.php?r=teacher/default/ariza');
                                echo \yii\helpers\Html::textarea('sabab','Бо баробари навиштани аризаи худ аз Шумо эҳтиромона хоҳиш менамоям , ки барои ислоҳи баҳо ба',['class'=>'col-md-12','style'=>'']);
                                ?>
                                </div>
                                <?php
                                echo '<table id="tmp_fio" border="0" class="table table-bordered table-striped dataTable">';
                                echo "<tr>";
                                echo "<th nowrap=''><p align='center'>№</p></th><th nowrap=''><p align='center'>Ному насаб</p></th><th nowrap=''><p align='center'>Баҳо</p></th><th nowrap=''><p align='center'>Баҳои ивазшаванда</p></th>";
                                echo "</tr>";
                                $r=1;
                                foreach ($students as $student) {
                                    if (isset($post[$student['id_students']])) {
                                        echo "<tr>";
                                        echo "<td nowrap='' style='text-align: center'>" . $r . "</td><td nowrap=''>" . $student['surname'] . " " . $student['name'] . " " . $student['middle_name'] . " " . "</td><td nowrap='' style='text-align: center'>" . $mark[$student['id_students']][0]['mark'] . "</td><td nowrap='' style='text-align: center'>".\yii\helpers\Html::input('',$student['id_students'],'',['size'=>1])."</td>";
                                        echo "</tr>";
                                        $r++;
                                    }
                                }
                                echo "</table>";
                                echo \yii\helpers\Html::hiddenInput('guruh',$post['guruh']);


                                ?>
                                 <div class='col-md-12' style='font-size: 20px'>
                                    Аризадиҳанда : <b class='pull-right'> <?= Yii::$app->user->identity['surname']," ". Yii::$app->user->identity['name']," ". Yii::$app->user->identity['middle_name'] ?> </b>
                                </div>
                                <div class='clearfix'></div>
                                <div class='col-md-12' style='font-size: 20px'>
                                    Сана :<b class='pull-right'> <?= date('d.m.Y'); ?> </b>
                                </div>
                            </div>


                        </div>
                        <div class="box-footer">
                            <?php
                            echo \yii\helpers\Html::submitButton('Сабт ва ба тасдиқ фиристонидан',['class'=>'btn btn-primary']);
                            echo \yii\helpers\Html::endForm();
                            ?>
                        </div>
                    </div>

                </div>

            </div>




        </div>
</section>

