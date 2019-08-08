<div class="col-sm-12">
    <link href="/web/admin/timetable_files/subdomain.css" type="text/css" rel="stylesheet">
    <div class="group">

        <?php //echo "<pre>"; print_r($timetable_sinf); echo "</pre";?>
        <div class="title_box">
            <?php foreach($group as $groups):?>

                <h3>Ҷадвали дарсии барои курси <?=$groups['course'];?> гурӯҳи <?=$groups['profession']['0']['profession']; ?></h3>

            <?php endforeach;?>
        </div>

        <?php  $sana=date('Y-m-d'); $rh=(date('w', strtotime("$sana")));?>

        <table class="standart_table standart_timetable">
            <thead>
            <tr>
                <td class="number">Соат</td>
                <td class="bells">Вақт</td>
                <td class="day <?php if($rh==1)echo 'today'?>">Душанбе</td>
                <td class="day <?php if($rh==2)echo 'today'?>">Сешанбе</td>
                <td class="day <?php if($rh==3)echo 'today'?> ">Чоршанбе</td>
                <td class="day <?php if($rh==4)echo 'today'?>">Панҷшанбе</td>
                <td class="day <?php if($rh==5)echo 'today'?>">Ҷумъа</td>
                <td class="day <?php if($rh==6)echo 'today'?>">Шанбе</td>
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
                                echo "<div class='lesson subject'>";
                                echo $pow['lesson'];
                                echo "</div>";
                                echo "<div class='subgroup'>";
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
    </div>

</div>
