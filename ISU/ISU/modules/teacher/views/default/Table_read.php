<!--<section class="content-header">
    <h1>
        Системаи иттилоотии идоракунии
        <small>Коллеҷи омӯзгорӣ ба номи М.Турсунзода</small>
    </h1>
    <?php //Yii::$app->getSecurity()->generatePasswordHash('0000'); ?>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Интихоб</a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">





            <div class="box box-primary" style="">
                <div class="table-responsive mailbox-messages" style="position: relative" id="scroll">
                    <div class="box-header with-border">
                        <div class="col-ms-12" style="text-align: center">-->

                            <?php foreach($group as $groups):?>
                            <h3 class="box-title" style="text-align: center">Ҷадвали дарсии барои курси <?=$groups['course'];?> гурӯҳи <?=$groups['profession'];?></h3></div>
                        <?php endforeach;?>
                    </div>
                    <div class="box-body">
                        <?php  $sana=date('Y-m-d'); $rh=(date('w', strtotime("$sana")));?>

                        <table class="table table-bordered table-striped dataTable">
                            <thead>
                            <tr>
                                <th class="number">Соат</th>
                                <th class="bells">Вақт</th>
                                <th class="day <?php if($rh==1)echo 'today'?>">Душанбе</th>
                                <th class="day <?php if($rh==2)echo 'today'?>">Сешанбе</th>
                                <th class="day <?php if($rh==3)echo 'today'?> ">Чоршанбе</th>
                                <th class="day <?php if($rh==4)echo 'today'?>">Панҷшанбе</th>
                                <th class="day <?php if($rh==5)echo 'today'?>">Ҷумъа</th>
                                <th class="day <?php if($rh==6)echo 'today'?>">Шанбе</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $n=0; foreach($ms as $row): $n++;
                                ?>
                                <tr <?php if($n%2<>0) echo "class='even'"?>>
                                    <td><?=$n;?>.</td>
                                    <?php foreach($row['satr'] as $pow):?>

                                        <td class="<?php if(!isset($pow['lesson'])) echo "bells";?>">
                                            <?php if(!isset($pow['lesson'])) {
                                                echo '<span>'.$pow['soat']['time'].'</span>';
                                            }
                                            else
                                            {
                                                echo "<div class='pull-left'>";
                                                echo $pow['lesson'];
                                                echo "</div>";
                                                echo "<div class='pull-right' style='font-weight: bold'>";
                                                echo $pow['fio_om'];
                                                echo "</div>";
                                            }

                                            ?>
                                        </td>
                                    <?php endforeach;?>

                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    <!--</div>
                    <div class="box-footer">

                    </div>
                </div></div></div></div>
    </section>


<div class="col-md-12">

    <div class="group">

        <?php //echo "<pre>"; print_r($timetable_sinf); echo "</pre";?>
        <div class="title_box">



            <h3></h3>


        </div>


        </div>

    </div>
-->