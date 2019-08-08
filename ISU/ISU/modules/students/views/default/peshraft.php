
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
        <div class="col-md-12">

    <div class="box box-primary" style="">

        <div class="table-responsive mailbox-messages">

        
        <div class="box-header with-border">

            <div class="col-ms-12" style="text-align: center">

                        <h3 class='box-title'>Пешрафт</h3>
                    </div><!-- /.box-header -->

                   <div   id="content">

                        <?php
                        $id_lesson = \Yii::$app->request->get('id_lesson');
                        if(isset($id_lesson)){

                          echo "


        <div class='table-responsive mailbox-messages'>

        
        
        <div  class='box-body' id='content'>

<div id='tmp_fio' style='position:absolute; width:336px; background:
rgb(255, 255, 255); display: block; z-indez:4; left: 0px;'>
<table class='table table-bordered table-striped dataTable'>

<tr align='center'>
<tr ><th  style='padding-top: 106px; height: 90px'>№</th>
<th nowrap=''  style='padding-top: 40px'><p align='center'>Ному насаби донишҷӯ</p></th>
</tr>";
 $r=1; foreach ($datas as $fio) {

echo "<tr style='height:33px;'><td style='text-align: center;'>".$r."</td>
<td nowrap='' style='height:47px; width:282px;'>". $fio['surname'] . ' ' . $fio['name'] . ' ' . $fio['middle_name']."</td></tr>";


 $r++;} 

                        echo "</td></tr>

</table></div>";
                            echo '<table id="tmp_fio" border="0" class="table table-bordered table-striped dataTable" >';
                            echo "<tr><th  nowrap='' rowspan='2' style='padding-top: 40px; height: 100px'><p align='center'>№</p></th>
                            <th nowrap='' rowspan='2' style='padding-top: 40px; width:282px;>
                            <p align='center'>Ному насаб</p></th>";
                            $r=1;
                        if(count($lesson_days)>0) {

                            foreach ($lesson_days as $lesson_day){
                                sort($lesson_day);
								foreach ($lesson_day as $day) {
								
                                    echo "<th nowrap='' colspan='";
                                    if (!($r % (8 * $lesson_count[0]['count_time']))) echo 2;
                                    else echo 1;
                                    echo "'><p align='center'>Рӯзи №$r<br><span style='color: red'>"
                                        . $day['datedars'] .
                                        "</span><br><span style='color: blue'>" . $day['name_tj'] . "</span></p></th>";
                                    $r++;
                                }
                            }
                            echo "</tr>";
                            $r=1;
                            echo "<tr>";

                            foreach ($lesson_days as $lesson_day) {

                                foreach ($lesson_day as $day) {
                                    echo "<th><p align='center'>сан.ҷор.</p></th>";
                                    if (!($r % (8 * $lesson_count[0]['count_time']))) echo "<th style='background-color: #FFD7FF; width=45px;'> КМД </th>";

                                    $r++;
                                }
                            }

                        }



                            echo "</tr>";
                            $q=1;
                            foreach($students as $student){
                                $r=1;
                                echo "<tr>";
                                echo "<td nowrap=''><p align='center'>".$q."</p></td>";
                                echo "<td nowrap=''>".$student['surname']." ".$student['name']." ".$student['middle_name']."</td>";
                                if(count($lesson_days)>0) {

                                    foreach ($lesson_days as $lesson_day) {
                                           sort($lesson_day);
                                        foreach ($lesson_day as $day) {

										

                                            if (isset($mark[$student["id_students"]][$day['datedars']])) {
                                                if (isset($mark[$student["id_students"]][$day['datedars']][1])) {
													
																								
                                                    if ($mark[$student["id_students"]][$day['datedars']][1]['id_lesson_time'] == $day['id_lesson_time']) {
                                                        echo "<td style='text-align: center'>";
                                                        echo $mark[$student["id_students"]][$day['datedars']][1]['mark'];
                                                        echo "</td>";
                                                    } else {
                                                        echo "<td><center>";
                                                        echo "-";
                                                        echo "</center></td>";
                                                    }


                                                } else {
                                                    echo "<td><center>";
                                                    echo "-";
                                                    echo "</center></td>";

                                                }

													
                                               												
												$kmd=$mark[$student["id_students"]][$day['datedars']][3]['mark'];
                                               if (!($r % (8 * $lesson_count[0]['count_time']))){
												
                                                    if (isset($mark[$student["id_students"]][$day['datedars']][3])) {
													//debug($mark[$student["id_students"]][$day['datedars']][3]);
                                                      echo "<td style='text-align: center; background-color: #FFD7FF'>";
													  
                                                       echo $kmd;
                                                           echo "</td>";
                                                  } else {
                                                        echo "<td style='background-color: #FFD7FF'><center>";
                                                        echo "-";
                                                     	echo "</center></td>";

                                                    }

                                                }
												
												
                                            } 
											else {
                                                echo "<td 'text-align: center'><p align='center'> - </p></td>";
                                        
                                                if (!($r % (8 * $lesson_count[0]['count_time']))) {
                                                    echo "<td style='background-color: #FFD7FF'> <p align='center'> - </p></td>";
                                                }

                                            }
                                            $r++;
                                        }
                                    }
                                }


                                echo "</tr>";
                                $r++;
                                $q++;
                            }


                            echo '</table>';
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