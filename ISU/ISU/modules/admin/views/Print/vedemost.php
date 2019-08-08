 <div class="box-body">

 

 <?php
                if($save==2){
                    ?>

                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-info"></i>Огоҳӣ</h4>
                        Ҳоло натиҷаи имтиҳонҳонот ба Шумо дастраст нашудаст!!! Сохтани варақаи корӣ ноимкон аст.
                    </div>
                <?} else {?>

                <font color="#000000" face="Palatino Linotype">
                    <p style="text-align: center;">
            <?php 

            




               $teacherFIO=$vedemosttitle['surname'].' '.$vedemosttitle['name'].' '. $vedemosttitle['middle_name'];
                
                
            ?>
            <p align="center" style="font-size:20px"><b>Коллеҷи технологии ба номи  А. Қаҳҳоров</b></p>
            <p align="center" style="font-size:20px; margin-top:-15px;"><b>ВАРАҚАИ ИМТИҲОНИ ҶАМЪБАСТИИ № <?=$vedemosttitle['vedomost_number']?></b></p>
            <p align="center" style="font-size:16px; margin-left:-15px; margin-top:15px;">Курс - <b><u><?=$vedemosttitle['course']?></u></b>    Гурўҳ -    <b><u><?=$vedemosttitle['profession']?></u></b>  Семестр - <b><u><?=$vedemosttitle['smestr']?></u></b>  Соли таҳсили <b><u><?=$vedemosttitle['studies_year']?></u></b></p>
            <p align="center" style="font-size:16px; margin-left:-75px;  margin-top:-15px;">Ихтисос <b><u>«<?=$vedemosttitle['proname']?>»</u></b></p>
            <p align="center" style="font-size:16px; margin-left:-50px;  margin-top:-15px;">Факултети <b><u>«<?=$vedemosttitle['faculty_name']?>»</u></b></p>
            <p align="center" style="font-size:16px; margin-left:-184px;  margin-top:-15px;">Кафедраи: <b><u><?=$vedemosttitle['name_kafedra']?></u></b></p>
            <p align="center" style="font-size:16px; margin-left:-408px; margin-top:-15px;">Фан: <b><u><?=$vedemosttitle['lessonname']?></u></b>  </p><br>                    
            <p align="center" style="margin-bottom:16px; font-size:16px; margin-left:-45px;">Насабу номи омӯзгор: <b><u><?=$teacherFIO;?></u></b></p> 
            <p align="center" style="margin-bottom:16px; font-size:16px; margin-left:-120px; margin-top:-15px;">Таърихи рўзи гузаронидани  имтиҳон   <b><u><?=$vedemosttitle['date']?> с.</u></b></p> 
  
</div><br>




<table align="center"  border='1px' style='width:100%; border-collapse: collapse;' >
                    <thead>
                    <tr>
                        <td rowspan="2" valign="middle" style="text-align:center; font-size:16px;">№</td>
                        <td rowspan="2" valign="middle" style="text-align:center; font-size:16px;">Ному насаби донишҷӯ</td> 

                        <td rowspan="2" valign="middle" style="text-align:center; font-size:16px;">Холи имт.</td>   
                        <td rowspan="2" valign="middle" style="text-align:center; font-size:16px;">Холи <br>ҷамбастӣ</td>   

                        <td colspan="3" style="text-align:center; font-size:16px;">Меъёри баҳогузорӣ</td>              
                    </tr>
                    <tr>
                        <td style="text-align:center; font-size:16px;">Баҳо</td>
                        <td style="text-align:center; font-size:16px;">Ифодаи <br> ададии<br> баҳо </td>
                        <td style="text-align:center; font-size:16px;">Ифодаи <br> анъанавии<br> баҳо </td> 

                    </tr>


                    </thead>
                    <tbody>
                    <?php
                    $i=0;
                    foreach($group as $key){
                        $i++;

                        // debug($key);
                       

                        //echo $key['students']['person']['0']['name'];

                         $fio=$key['surname'].' '. $key['pname']. ' ' .$key['middle_name'];
                         
                        $admin_exam=$key['admin_exam'];

                         $SF1=$key['exam_one'];
                         $SF2=$key['exam_two'];

                        $summ_sf=$SF2+$SF1;



                        
                        $kholi_jambasti=($summ_sf/4)+($admin_exam/2);
                       
                       $khol=0;
                       $ananavi='';



                        if($kholi_jambasti>=95 or $kholi_jambasti==100){$harf='A';$bA++; $khol=4; $ananavi='Аъло';}
                        elseif($kholi_jambasti>=90 and  $kholi_jambasti<=95){$harf='A-';$bA++; $khol=3.67; $ananavi='Аъло';}

                        elseif($kholi_jambasti>=85 and $kholi_jambasti<=89){$harf='B+';$bB++; $khol=3.33; $ananavi='Хуб';}
                        elseif($kholi_jambasti>=80 and  $kholi_jambasti<=84){$harf='B';$bB++; $khol=3; $ananavi='Хуб';}
                        elseif($kholi_jambasti>=75 and $kholi_jambasti<=79){$harf='B-';$bB++; $khol=2.67; $ananavi='Хуб';}

                        elseif($kholi_jambasti>=70 and $kholi_jambasti<=74){$harf='C+';$bC++; $khol=2.33; $ananavi='Қаноатбахш';}
                        elseif($kholi_jambasti>=65 and $kholi_jambasti<=69){$harf='C';$bC++;  $khol=2; $ananavi='Қаноатбахш';}
                        elseif($kholi_jambasti>=60 and $kholi_jambasti<=64){$harf='C-';$bC++; $khol=1.67; $ananavi='Қаноатбахш';}


                        elseif($kholi_jambasti>=55 and $kholi_jambasti<=59){$harf='D';$bD++;  $khol=1.33; $ananavi='Қаноатбахш';}
                        elseif($kholi_jambasti>=50 and $kholi_jambasti<=54){$harf='D+';$bD++; $khol=1; $ananavi='Қаноатбахш';}


                        elseif($kholi_jambasti>=45 and $kholi_jambasti<=49){$harf='FX';$bFX++; $khol=0; $ananavi='Ғайриқаноатбахш';}

                        else{$harf='F';$bF++; $khol=0; $ananavi='Ғайриқаноатбахш';}

                        

                        echo '<tr>
                            <td style="text-align:center; font-size:16px;">'.$i.'</td>
                            <td style="padding-left:10px; font-size:16px;">'.$fio.'</td>
                            <td style="text-align:center; font-size:16px;">'.$admin_exam.'</td>
                            <td style="text-align:center; font-size:16px;">'.$kholi_jambasti.'</td>
                            <td style="text-align:center; font-size:16px;">'.$harf.'</td>
                            <td style="text-align:center; font-size:16px;">'.$khol.'</td>
                            <td style="text-align:center; font-size:16px;">'.$ananavi.'</td>

                        </tr>';
                    }
                    ?>
                                         

                        </tbody>
                </table>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                
                <p align="center" style="font-size:16px; margin-left:-160px;">Сардори офиси бақайдгирӣ:  &nbsp;&nbsp;&nbsp;&nbsp;  Ғаниева Ф . __________ </p> 
                <p align="center" style="font-size:16px; margin-left:-190px;">Сардори маркази тестӣ:     &nbsp;&nbsp;&nbsp;&nbsp; Ғафуров А. ___________ </p> 
            </li> 
            <? }?>






