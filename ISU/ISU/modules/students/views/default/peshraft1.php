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


        <div class='col-md-12'>
            <div class='box box-default'>

                <div class='box-header with-border'>
                    <div class="table-responsive mailbox-messages" style="position: relative" id="scroll">
                    <div class='box-header with-border' style="text-align: center">


                        <i class=''></i>
                        <h3 class='box-title'>Пешрафт</h3>
                    </div><!-- /.box-header -->
                    <div class='box-body'>

                        <?php
                        $id_lesson = \Yii::$app->request->get('id_lesson');
                        if(isset($id_lesson)){
                            echo '<table id="tmp_fio" border="0" class="table table-bordered table-striped dataTable" >';
                            echo "<tr><th  nowrap='' rowspan='2'><p align='center'>№</p></th><th nowrap='' rowspan='2'><p align='center'>Ному насаб</p></th>";
                            $r=1;
                        if(count($lesson_days)>0) {

                            foreach ($lesson_days as $lesson_day){
                                sort($lesson_day);
								foreach ($lesson_day as $day) {
								
                                    echo "<th nowrap='' colspan='";
                                    if (!($r % (4 * $lesson_count[0]['count_time']))) echo 3;
                                    else echo 2;
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
                                    echo "<th>Лексия</th><th>КМРО</th>";
                                    if (!($r % (4 * $lesson_count[0]['count_time']))) echo "<th style='background-color: #FFD7FF'>КМД</th>";

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


                                                if (isset($mark[$student["id_students"]][$day['datedars']][2])) {
													
                                                    echo "<td style='text-align: center'>";
                                                    echo $mark[$student["id_students"]][$day['datedars']][2]['mark'];
                                                    echo "</td>";


                                                } else {
                                                    echo "<td><center>";
                                                    echo "-";
                                                    echo "</center></td>";

                                                }
												
												
												
                                               if (!($r % (4 * $lesson_count[0]['count_time']))){
												debug($mark[$student["id_students"]][$day['datedars']][3]['mark']);
                                                    if (isset($mark[$student["id_students"]][$day['datedars']][3])) {

                                                        echo "<td style='text-align: center'>";
                                                        echo $mark[$student["id_students"]][$day['datedars']][3]['mark'];
                                                        echo "</td>";

                                                    } else {
                                                        echo "<td><center>";
                                                        echo "-";
                                                        echo "</center></td>";

                                                    }

                                                }
                                            } else {
                                                echo "<td style='text-align: center'> - </td>";
                                                echo "<td style='text-align: center'> - </td>";
                                                if (!($r % (4 * $lesson_count[0]['count_time']))) {
                                                    echo "<td style='text-align: center'> - </td>";
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
                        else {
                            if (count($lessons) > 0) {
                                echo '<table id="tmp_fio" border="0" class="table table-bordered table-striped dataTable">';
                                echo "<tr><th nowrap='' rowspan='2'>№</th><th nowrap='' rowspan='2'>Номи фан</th><th nowrap='' rowspan='2'>Ному насаби устод</th>";
                                $r=1;
                                foreach ($lesson_days as $lesson_day) {
                                        echo "<th nowrap='' colspan='";
                                        if (!($r % 36)) echo 3;
                                        else echo 2;
                                        echo "'>Рӯзи №$r<br><span style='color: red'>"
                                            .$lesson_day['datedars'].
                                            "</span><br><span style='color: blue'>" . $lesson_day['name_tj'] . "</span></th>";
                                        $r++;

                                }
                                echo "</tr>";
                                $r=1;
                                echo "<tr>";

                                foreach ($lesson_days as $lesson_day) {

                                        echo "<th>Лексия</th><th>КМРО</th>";
                                        if (!($r % 36)) echo "<th style='background-color: #FFD7FF'>КМД</th>";

                                        $r++;

                                }
                                echo "</tr>";
                                $r = 1;
                                foreach ($lessons as $lesson) {
                                    echo "<tr><td nowrap=''>$r</td><td nowrap=''><a href='index.php?r=students/default/peshraft&id_lesson=" . $lesson['id_lesson'] . "'>" . $lesson['lesson_name'] . "</a></td>
                                <td nowrap=''>" . $lesson['persons_surname'] . " " . $lesson['persons_name'] . " " . $lesson['persons_middle_name'] . "</td>";
                                    $r++;
                                    $q=1;
                                    if (isset($marks[$lesson['id_lesson']])) {

                                        foreach ($lesson_days as $lesson_day) {

                                            if(isset($marks[$lesson['id_lesson']][$lesson_day['datedars']])){
                                                if(isset($marks[$lesson['id_lesson']][$lesson_day['datedars']][1])){
                                                    echo "<td style='text-align: center'>";
                                                    echo $marks[$lesson['id_lesson']][$lesson_day['datedars']][1]['mark'];
                                                    echo "</td>";

                                                }
                                                else{
                                                    echo "<td><center>";
                                                    echo ' - ';
                                                    echo "</center></td>";

                                                }

                                                if(isset($marks[$lesson['id_lesson']][$lesson_day['datedars']][2])){
                                                    echo "<td style='text-align: center'>";
                                                    echo $marks[$lesson['id_lesson']][$lesson_day['datedars']][2]['mark'];
                                                    echo "</td>";

                                                }
                                                else{
                                                    echo "<td><center>";
                                                    echo '-';
                                                    echo "</center></td>";

                                                }
                                                if (!($r%36)) {
                                                    if(isset($marks[$lesson['id_lesson']][$lesson_day['datedars']][3])){
                                                        echo "<td style='text-align: center'>";
                                                        echo $marks[$lesson['id_lesson']][$lesson_day['datedars']][3]['mark'];
                                                        echo "</td>";

                                                    }
                                                    else{
                                                        echo "<td><center>";
                                                        echo '-';
                                                        echo "</center></td>";

                                                    }

                                                }
                                                $q++;

                                        }
                                            else{
                                                echo "<td style='text-align: center'> - </td><td style='text-align: center'> - </td>";
                                                if(!($q % 36)){echo "<td style='background-color: #FFD7FF ; text-align: center'> - </td>";}
                                                $q++;
                                            }



                                    }
                                    } else {
                                        foreach ($lesson_days as $lesson_day) {
                                            echo "<td style='text-align: center'> - </td><td style='text-align: center'> - </td>";
                                            if(!($q%36)){
                                                echo "<td style='background-color: #FFD7FF; text-align: center'> - </td>";
                                            }
                                            $q++;
                                        }
                                    }
                                    echo "</tr>";
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