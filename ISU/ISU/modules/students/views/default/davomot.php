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
                            <h3 class='box-title'>Давомот</h3>
                        </div><!-- /.box-header -->
                        <div class='box-body'>

                            <?php
                            $id_lesson = \Yii::$app->request->get('id_lesson');


                                if (count($lessons) > 0) {
                                    echo '<table id="tmp_fio" border="0" class="table table-bordered table-striped dataTable">';
                                    echo "<tr><th nowrap='' rowspan='2'><p align='center'>№</p></th>
                                    <th nowrap='' rowspan='2'><p align='center'>Номи фан</p></th>
                                    <th nowrap='' rowspan='2'><p align='center'>Ному насаби устод</p></th>";
                            

                                    echo "<th nowrap='' colspan='1'><p align='center'>Миқдори умумӣ<br></p><span style='color: red'>";

                                   
                                    echo "</tr>";
                                   
                                    echo "<tr>";

                                    echo "</tr>";
                                    $r = 1;
                                    foreach ($lessons as $lesson) {
                                        echo "<tr><td nowrap=''><p align='center'>$r</td><td nowrap=''><p align='center'>". $lesson['lesson_name'] . "</p></td>
                                <td nowrap=''><p align='center'>" . $lesson['persons_surname'] . " " . 
                                $lesson['persons_name'] . " " . $lesson['persons_middle_name'] . "</p></td>";
                                        
                                       
                                           
                                            echo "<td style='text-align: center'>";
                                            foreach ($lesson_days as $lesson_day) {

                                                debug($lesson);
                                                exit;
                                                
                                               
                                                if(isset($marks[$lesson['id_lesson']][$lesson_day['datedars']])){
                                                    if(isset($marks[$lesson['id_lesson']][$lesson_day['datedars']][1])){
                                                        
                                                        
                                                        if($marks[$lesson['id_lesson']][$lesson_day['datedars']][1]['mark']=='ғ' or 
                                                            $marks[$lesson['id_lesson']][$lesson_day['datedars']][3]['mark']=='ғ'){
                                                             $rrr=$rrr+1;

                                                            
                                                           }

                                                       // echo $rrr;

                                                       // echo $marks[$lesson['id_lesson']][$lesson_day['datedars']][1]['mark'];}
                                                       

                                                        echo "</td>";

                                                    }
                                                   
                                                   
                                                       
                                                      

                                                   
                                                }
                                               



                                            }

                                        
                                        echo "</tr>";
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