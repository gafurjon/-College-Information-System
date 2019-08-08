<?php


use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Pjax;
Use kartik\date\DatePicker;

?>

<section class="content-header">
    <h1>
        Системаи иттилоотии идоракунии
        <small>Коллеҷи омӯзгории ба номи М.Турсунзода</small>
    </h1>
    
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Интихоб</a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">





    <div class="box box-primary" style="">

        <div class="table-responsive mailbox-messages">

        
        <div class="box-header with-border">

            <div class="col-ms-12" style="text-align: center">




            <h3 class="box-title" style="text-align: center">Гузоштани бал</h3></div>

            <?php
            if(count($id_group)<>1) {
                
                ?>

                <h3 class="box-title">
                    <?php
                    $id_lesson = Yii::$app->request->get('id_lesson');
                    $form = ActiveForm::begin();
                    // получаем всех авторов

                    // формируем массив, с ключем равным полю 'id' и значением равным полю 'name'
                    $items = ArrayHelper::map($id_group, 'id_group', 'groupcourse');
                    $params = [
                        'prompt' => 'Гурӯҳро интихоб кунед...',

                        'onchange'=>'$.get("@web/index.php?r=teacher/default/select&id_lesson='.$id_lesson.'&id_group="+$(this).val(), function(data){
            $("#content").html(data);})'

                    ];
                    echo $form->field($model, 'profession')->dropDownList($items, $params, ['class' => 'form-control select2', 'style' => 'border-radius:4px; width:100%'])->label(false);

                    ActiveForm::end();
                    ?>
                </h3>
           <? } ?>
        </div>

          


                <div   id="content">

                <?php
                //debug($marks);
                if(count($id_group)===1) {
                    $id_lesson = Yii::$app->request->get('id_lesson');
                    $id_group=Yii::$app->request->get('id_group');

                    if(count($datas)>0){
                        echo Html::beginForm('@web/index.php?r=teacher/default/insert_marks&id_lesson='.$id_lesson,'post');
                                                echo "


        <div class='table-responsive mailbox-messages'>

        
        
        <div  class='box-body' id='content'>

<div id='tmp_fio' style='position:absolute; width:328px; background:
rgb(255, 255, 255); display: block; left: 0px;'>
<table class='table table-bordered table-striped dataTable'>

<tr align='center'>
<tr ><th  style='padding-top: 105px; height: 90px'>№</th>
<th nowrap=''  style='padding-top: 40px'><p align='center'>Ному насаби донишҷӯ</p></th>
</tr>";
 $r=1; foreach ($datas as $fio) {

echo "<tr style='height:43px;'><td style='text-align: center;'>".$r."</td>
<td nowrap=''>". $fio['surname'] . ' ' . $fio['name'] . ' ' . $fio['middle_name']."</td></tr>";


 $r++;} 

echo "<tr><td style='text-align: center; height: 64px'></td>
<td nowrap>";


echo Html::submitButton('Сабт намудан',['class'=>'btn btn-success','name'=>'save','style'=>'padding-left: 10px','onclick'=>'return check()']);
                        echo "</td></tr>

</table></div>";


                       

                        echo '<table class="table table-bordered table-striped dataTable">';
                        $r = 1;
                        echo "<tr><th rowspan='2' style='padding-top: 40px; height: 100px'>№</th>
                        <th nowrap='' rowspan='2' style='padding-top: 40px; width:282px;'>
                        <p align='center'>Ному насаби донишҷӯ</p></th>";
                        if(count($lesson_days)>0) {
                            foreach ($lesson_days as $lesson_day) {
                                sort($lesson_day);


                                foreach ($lesson_day as $day) {
                                    if ($day['type'] === 'дарсӣ') {
                                        if ($r <= $lesson_count[0]['count']) {
                                            echo "<th nowrap='' colspan='1'><p align='center'>Рӯзи №$r<br><span style='color: red'>"
                                                . $day['datedars'] .
                                                "</span><br><span style='color: blue'>" . $day['name_tj'] . "</span></p></th>";
                                            $r++;

                                        }
                                    }

                                    elseif($day['type'] <> 'дарсӣ' && $day['type'] <> 'истироҳат'){
                                        if ($r <= $lesson_count[0]['count']) {
                                            echo "<th nowrap='' bgcolor='red' colspan='1'";
                                            
                                            echo "' style='color: white'><p align='center'>Рӯзи №$r<br><span style='color: white'>"
                                                . $day['datedars'] .
                                                "</span><br><span style='color: white'>" . $day['name_tj'] . "</span></p></th>";
                                            $r++;

                                        }
                                    }
                                }
                            }
                        }
                      

                        echo "</tr>";
                        $r=1;
                        echo "<tr>";
                        if(count($lesson_days)>0) {
                            foreach ($lesson_days as $lesson_day) {
                                sort($lesson_day);
                                foreach ($lesson_day as $day) {
                                    if ($day['type'] === 'дарсӣ') {
                                        if ($r <= $lesson_count[0]['count']) {


                                            echo "<th ><p align='center'>сан.ҷор.</p></th>";
                                            
                                            $r++;
                                        }


                                    }


                                    elseif($day['type'] <> 'дарсӣ' && $day['type'] <> 'истироҳат'){
                                        if ($r <= $lesson_count[0]['count']) {
                                            echo "<th style='color: white; background-color: red'>сан.ҷор.</th>";
                                           
                                            $r++;
                                        }
                                    }

                                }

                            }

                        }
                         

                        $r = 1;
                        foreach ($datas as $groups) {
                            //debug($groups);
                            echo '<tr><td style="text-align: center;">' . $r . '</td><td nowrap="">' . $groups["surname"] . ' ' . $groups["name"] . ' ' . $groups["middle_name"] . '</td>';
                            if(count($lesson_days)>0) {
                                $q=1;
                                foreach($lesson_days as $lesson_day) {
                                    sort($lesson_day);

                                    foreach ($lesson_day as $day) {
                                        if (count($marks) > 0) {
                                            if ($day['type'] === 'дарсӣ') {
                                                if ($q <= $lesson_count[0]['count']) {
                                                    if (isset($marks[$groups["id_students"]][$day['datedars']])) {
                                                        if (isset($marks[$groups["id_students"]][$day['datedars']][1])) {
                                                            echo "<td style='text-align: center'>";
                                                            echo $marks[$groups["id_students"]][$day['datedars']][1]['mark'];
                                                            echo "</td>";

                                                        } else {
                                                            echo "<td><center";
                                                            if (!isset($marks[$groups["id_students"]][$day['datedars']][1])) {

                                                                if ($day['open_close'] <> 0) {
                                                                    echo " style='color: red'";
                                                                }
                                                            }
                                                            echo ">";
                                                            if ($day['open_close'] == 0) {

                                                               echo Html::input('text', 'lek[' . $groups["id_students"] . '][' . $q . ']', '', ['maxlength' => 2, 'size' => 2, 'id' => 'lek' . $groups["id_students"] . $q]);
                                                            } else {
                                                                echo "x";
                                                            }
                                                            echo "</center></td>";
                                                        }
                                                        
                                                        
                                                    } else {
                                                        echo '<td style="text-align: center';
                                                        if ($day['open_close'] <> 0) {
                                                            echo "; color: red";
                                                        }
                                                        echo '">';
                                                        if ($day['open_close'] == 0) {
                                                            echo Html::input('text', 'lek[' . $groups["id_students"] . '][' . $q . ']', '', ['maxlength' => 2, 'size' => 2, 'id' => 'lek' . $groups["id_students"] . $q]);
                                                        } else {
                                                            echo "x";
                                                        }
                                                        echo '</td>';

                                                        

                                                        
                                                    }


                                                }


                                            } elseif ($day['type'] <> 'дарсӣ' && $day['type'] <> 'истироҳат') {
                                                if ($q <= $lesson_count[0]['count']) {
                                                    echo "<th style='color: white; background-color: red'></th>";
                                                    //<th style='color: white; background-color: red'></th>";
                                                   // if (!($q % (7 * $lesson_count[0]['count_time']))) 
                                                        // echo "<th style='color: white; background-color: red'></th>";
                                                    $q++;
                                                }
                                            }


                                        } else {
                                            if ($q <= $lesson_count[0]['count']) {

                                                echo '<td style="text-align: center;';
                                                if ($day['open_close'] <> 0) {echo "color: red";}
                                                echo '">';
                                                if ($day['open_close'] == 0) {
                                                    echo Html::input('text', 'lek[' . $groups["id_students"] . '][' . $q . ']', '', ['maxlength' => 2, 'size' => 2, 'id' => 'lek' . $groups["id_students"] . $q]);
                                                } else {
                                                    echo "x";
                                                }
                                               
                                                echo '</center></td>';


                                            }
                                            $q++;
                                        }
                                    }

                                }

                                echo '</tr>';

                                $r++;

                            }

                            else{
                                $r++;
                            }


                        }
                        echo '<input type="hidden" value="'.($r - 1).'" name="kol_stud" id="kol_stud">';
                        echo '<input type="hidden" value="'.$lesson_count[0]['count'].'" name="count" id="count">';
                        echo '<input type="hidden" value="';
                        foreach ($datas as $groups) {
                            echo $groups["id_students"].",";
                        }
                        echo '" name="id_students" id="id_students">';
                        echo "<tr><td nowrap=''></td><td nowrap=''></td>";
                        $q=1;
                        if(count($lesson_days)>0) {
                            foreach ($lesson_days as $lesson_day) {
                                sort($lesson_day);

                                foreach ($lesson_day as $day) {
                                    if ($day['type'] === 'дарсӣ') {
                                        if ($q <= $lesson_count[0]['count']) {
                                            if(isset($marks[$groups["id_students"]][$day['datedars']])){
                                                if(isset($marks[$groups["id_students"]][$day['datedars']])){
                                                    if(isset($marks[$groups["id_students"]][$day['datedars']][1])){
                                                        echo "<td nowrap='' style='text-align: center'>";
                                                        echo $marks[$groups['id_students']][$day['datedars']][1]['date_save'];

                                                        echo "</td>";

                                                    }
                                                    else{

                                                        echo "<td nowrap='' style='text-align: center'; height=65px;>";
                                                        if($day['open_close']==0){
                                                            echo "Тасдиқ ";
                                                            echo Html::checkbox('tas_lek[' . $q . ']','',['id'=>'tas_lek_'.$q, 'onchange' => '$.get("@web/index.php?r=teacher/default/getdate", function(data){$("#date_lek_'.$q.'").val(data);})']);
                                                            echo "<br>";

                                                            echo Html::input('text','date','',['id'=>'date_lek_'.$q,'size'=>'3','disabled'=>'disabled']);
                                                        }
                                                        else{

                                                        }

                                                        echo "</td>";
                                                    

                                                    }
                                                    $q++;
                                                }
                                                 echo "";
                                            }

                                           

                                            else {

                                                echo "<td nowrap='' style='text-align: center'>";
                                                if($day['open_close']==0) {
                                                    echo "Тасдиқ ";
                                                    echo Html::checkbox('tas_lek[' . $q . ']', '', ['id' => 'tas_lek_' . $q, 'onchange' => '$.get("@web/index.php?r=teacher/default/getdate", function(data){$("#date_lek_'.$q.'").val(data);})']);
                                                    echo "<br>";
                                                    echo Html::input('text', 'date', '', ['id' => 'date_lek_'.$q, 'size' => '3', 'disabled' => 'disabled']);
                                                }
                                                echo "</td>";

                                                

                                               

                                                $q++;
                                            }

//                                          

                                        }
                                    }
                                    elseif($day['type'] <> 'дарсӣ' && $day['type'] <> 'истироҳат'){

                                        // if ($q <= $lesson_count[0]['count']) {
                                        //     echo "<th style='color: white; background-color: red'></th>
                                        //     ";
                                        //     // if (!($q % (7 * $lesson_count[0]['count_time']))) 
                                        //     //     // echo "<th style='color: white; background-color: red'></th>";
                                        //     // $q++;
                                        // }
                                    }
                                    else {
                                        $q++;
                                    }
                                }

                            }
                        }




                        echo '</tr></table>';

                        echo '</div></div>';
                        //echo Html::submitButton('Сабт намудан',['class'=>'btn btn-primary','name'=>'save','style'=>'float:left','onclick'=>'return check()']);
                        echo Html::endForm();
                    }

                }

                ?>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <table border="1" style="border-collapse:collapse;border-color:#FF0066;">
                    <tbody><tr><td colspan="2" align="center"><b>Қимматҳои имконпазир ҳамчун баҳои донишҷӯ</b></td></tr>
                    <tr><td>Баҳо</td><td><center><b>Аз 0 то 10</b></center></td></tr>
                    <tr><td>Агар донишҷӯ ба назди устод наояд</td><td><center><b>г</b></center></td></tr>
                    <tr><td>Агар устод иконияти донишҷӯйро пурсидан надошта бошад</td><td><center><b>х</b></center></td></tr>
                </tbody></table>
            </div>
        </div><!-- /.table-responsive -->
    </div><!-- /.box -->
</section>


<script type="text/JavaScript">

    <!--
    function MM_jumpMenu3(){
        if (group_selection.group_id.value!=-1)
            group_selection.submit();
    }

    function check(){
        var flag=false;
        var count = document.getElementById('count').value;
        var kol_stud = document.getElementById('kol_stud').value;
        var id_students = document.getElementById('id_students').value;
        var strArray = id_students.split(",");
        for(i=1;i<=count;i++) {
            if (document.getElementById('tas_lek_' + i)) {
                if (document.getElementById('tas_lek_' + i).checked == true) {
//                    var baho=[];
//                    for(var i = 0; i<=11; i++){
//                        if(i==11){
//                            baho[i] = 'г';
//                        }
//                        else{
//                            baho[i] = i
//                        }
//
//                    }
                    flag = true;
                    if (document.getElementById('date_lek_' + i).value == '' || document.getElementById('date_lek_' + i).value == null) {
                        flag = false;
                    }
                    else {
                        for (var j = 0; j < (strArray.length - 1); j++) {
                            if (document.getElementById('lek' + strArray[j] + i).value == '') {
                                document.getElementById('lek' + strArray[j] + i).style.backgroundColor = 'rgba(255, 0, 0, 0.72)';
                                document.getElementById('lek' + strArray[j] + i).style.color = 'white';
                                flag = false;
                                //alert(document.getElementById('kmro'+).value)
                            }
                            else if(document.getElementById('lek' + strArray[j] + i).value >=11){
                                document.getElementById('lek' + strArray[j] + i).style.backgroundColor = 'rgba(255, 0, 0, 0.72)';
                                document.getElementById('lek' + strArray[j] + i).style.color = 'white';
                                flag = false;
                            }

                            else if(document.getElementById('lek' + strArray[j] + i).value !== 'г' && document.getElementById('lek' + strArray[j] + i).value !== 'х'){
                                if(document.getElementById('lek' + strArray[j] + i).value <=10){
                                   
                                }
                                else{
                                    document.getElementById('lek' + strArray[j] + i).style.backgroundColor = 'rgba(255, 0, 0, 0.72)';
                                    document.getElementById('lek' + strArray[j] + i).style.color = 'white';
                                    flag = false;
                                }

                            }

//                            else if(document.getElementById('lek' + strArray[j] + i).value != 'г'){
//                                document.getElementById('lek' + strArray[j] + i).style.backgroundColor = 'rgba(255, 0, 0, 0.72)';
//                                document.getElementById('lek' + strArray[j] + i).style.color = 'white';
//                                flag = false;
//
//                            }


                        }
                    }
                }
            }

            if (document.getElementById('tas_kmro_' + i)) {
                if (document.getElementById('tas_kmro_' + i).checked == true) {
                    flag = true;
                    if (document.getElementById('date_kmro_' + i).value == '' || document.getElementById('date_kmro_' + i).value == null) {
                        flag = false;
                    }
                    else {
                        for (var j = 0; j < (strArray.length - 1); j++) {
                            if (document.getElementById('kmro' + strArray[j] + i).value == '') {
                                document.getElementById('kmro' + strArray[j] + i).style.backgroundColor = 'rgba(255, 0, 0, 0.72)';
                                document.getElementById('kmro' + strArray[j] + i).style.color = 'white';
                                flag = false;
                                //alert(document.getElementById('kmro'+).value)
                            }
                            else if(document.getElementById('kmro' + strArray[j] + i).value >= 11){
                                document.getElementById('kmro' + strArray[j] + i).style.backgroundColor = 'rgba(255, 0, 0, 0.72)';
                                document.getElementById('kmro' + strArray[j] + i).style.color = 'white';
                                flag = false;
                            }

                            else if(document.getElementById('kmro' + strArray[j] + i).value !== 'г' && document.getElementById('lek' + strArray[j] + i).value !== 'х'){
                                if(document.getElementById('kmro' + strArray[j] + i).value <= 10){
                                     
                                }
                                else{
                                    document.getElementById('kmro' + strArray[j] + i).style.backgroundColor = 'rgba(255, 0, 0, 0.72)';
                                    document.getElementById('kmro' + strArray[j] + i).style.color = 'white';
                                    flag = false;
                                }

                            }
                        }
                    }

                }
            }
            if (document.getElementById('tas_kmd_' + i)) {
                if (document.getElementById('tas_kmd_' + i).checked == true) {
                    flag = true;
                    if (document.getElementById('date_kmd_' + i).value == '' || document.getElementById('date_kmd_' + i).value == null) {
                        flag = false;
                    }
                    else {
                        for (var j = 0; j < (strArray.length - 1); j++) {
                            if (document.getElementById('kmd' + strArray[j] + i).value == '') {
                                document.getElementById('kmd' + strArray[j] + i).style.backgroundColor = 'rgba(255, 0, 0, 0.72)';
                                document.getElementById('kmd' + strArray[j] + i).style.color = 'white';
                                flag = false;
                                //alert(document    .getElementById('kmro'+).value)
                            }
                            else if(document.getElementById('kmd' + strArray[j] + i).value >= 21){
                                document.getElementById('kmd' + strArray[j] + i).style.backgroundColor = 'rgba(255, 0, 0, 0.72)';
                                document.getElementById('kmd' + strArray[j] + i).style.color = 'white';
                                flag = false;
                            }

                            else if(document.getElementById('kmd' + strArray[j] + i).value !== 'г' && document.getElementById('lek' + strArray[j] + i).value !== 'х'){
                                if(document.getElementById('kmd' + strArray[j] + i).value <= 20){
                                     
                                }
                                else{
                                    document.getElementById('kmd' + strArray[j] + i).style.backgroundColor = 'rgba(255, 0, 0, 0.72)';
                                    document.getElementById('kmd' + strArray[j] + i).style.color = 'white';
                                    flag = false;
                                }

                            }

                        }
                    }
                }
            }
        }

        if(flag==false){
            //document.getElementById('tas_kmd_' + i).style.background='red';
            alert("Тасдикро пахш кунед ва санаи бахомондаатонро дохил кунед!");
            return false;
        }else{
            if (confirm("Шумо дар ҳақиқат мехоҳед, ки бали донишҷӯёнро сабт намоед? Зеро баъди гузоштани бал Шумо имконияти онро иваз намудан ва ё аз нав дохил намуданро надоред!")){
                sabt_ball.submit();
            }else return false;
            flag=false;
        }
        //document.getElementById('sabt_ball').disabled=false;


    }
    //-->
</script>