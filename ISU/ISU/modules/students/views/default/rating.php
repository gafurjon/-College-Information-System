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
        Рейтинг
        <small></small>
    </h1>
    <?php //Yii::$app->getSecurity()->generatePasswordHash('0000'); ?>
    <ol class="breadcrumb">
        <li><a href="<?php echo \yii\helpers\Url::to('@web/index.php?r=Teacher/default/index'); ?>"><i class="fa fa-dashboard"></i>Саҳифаи асосӣ</a></li>
        <li class="active">Рейтинг</li>
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
                            <h3 class='box-title'>Рейтинг</h3>
                        </div><!-- /.box-header -->
                        <div class='box-body'>

                            <?php
                            if(isset($id_group)) {
                                if ($lessons > 0) {
                                    echo '<table id="tmp_fio" border="0" class="table table-bordered table-striped dataTable">';
                                    echo "<tr>";
                                    echo "<th nowrap='' rowspan='2'>№</th>";
                                    echo "<th nowrap='' rowspan='2'>Ному насаб</th>";
                                    foreach($lessons as $lesson){
                                        echo "<th nowrap='' colspan='3'>".$lesson['name']."</th>";
                                    }
                                    echo "</tr>";
                                    echo "<tr>";
                                    foreach($lessons as $lesson){
                                        echo "<th nowrap=''>Лексия</th><th nowrap=''>КМРО</th><th nowrap='' style='background-color: #FFD7FF'>КМД</th>";
                                    }
                                    echo "</tr>";
                                    $r=1;
                                    foreach ($students as $student) {
                                        echo "<tr><td>".$r."</td><td nowrap=''>" .$student['surname']." ". $student['name']." ".$student['middle_name']. "</a></td>";
                                        foreach($lessons as $lesson){
                                            for($i=1;$i<=3;$i++) {
                                                echo "<td style='text-align: center";
                                                if($i==3)echo "; background-color: #FFD7FF";
                                                echo "'>";
                                                if ($rating[$student['id_students']][$lesson['id_lesson']][$i]['rating'] <> '') {
                                                    echo round($rating[$student['id_students']][$lesson['id_lesson']][$i]['rating'], 2);
                                                } else {
                                                    echo "-";
                                                }

                                                echo "</td>";
                                            }
                                        }
                                        echo "</tr>";
                                        $r++;
                                    }

                                    echo '</table>';
                                }
                            }

                            ?>

                        </div>
                        <div class="box-footer">
                        </div>
                    </div>

                </div>

            </div>




        </div>
</section>
