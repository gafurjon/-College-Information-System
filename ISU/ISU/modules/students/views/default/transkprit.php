<section class="content-header">
    <h1>
        Системаи иттилоотии идоракунии
        <small>Коллеҷи технологӣ ба номи А. Қаҳҳоров</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=\yii\helpers\Url::to('@web/index.php?r=students/default/index')?>"><i class="fa fa-dashboard"></i>Саҳифаи асосӣ</a></li>
    </ol>
</section>
<?
foreach($transcript['Group'] as $Group){
    $course=$Group['course'];
    $prfession=$Group['profession']['0']['profession'];}
?>
<?foreach($transcript['Student'] as $student){
    $StPersons_adress=$student['person']['adress'];
    $StPersons_gender=$student['person']['gender'];
    $StFIO=$student['person']['surname'].' '.$student['person']['name'].' '.$student['person']['middle_name'];
}?>
<section class="content">
    <div class="row">
        <div class='col-md-12'>
            <div class='box box-default'>
                <div class='box-header with-border'>
                    <h3 class="box-title">Транскрипт</h3>
                </div>
                <div class="box-content">
                    <table class="table table-hover table-striped">
                        <tbody><tr>
                            <td colspan="6">
                                <table class="table">
                                    <tbody><tr>
                                        <th>Номи муассиса:</th>
                                        <th>Коллеҷи технологии шаҳри Конибодом
                                            ба номи ходими сиёсӣ ва давлатӣ А. Қаҳҳоров</th>
                                    </tr>
                                    <tr>
                                        <th>Телефон</th>
                                        <th>3-26-00,  3-15-19</th>
                                    </tr>
                                    <tr>
                                        <th>E-mail</th>
                                        <th>tekhnikum@mail.ru</th>
                                    </tr>
                                    <tr>
                                        <th>Ном ва насаби донишҷӯ</th>
                                        <th><?=$StFIO;?> </th>
                                    </tr>
                                    <tr>
                                        <th>Ихтисос</th>
                                        <th><?=$course.'- '.$prfession;?></th>
                                    </tr>
                                    <tr>
                                        <th>Суроға</th>
                                        <th><?=$StPersons_adress; ?></th>
                                    </tr>
                                    <tr>
                                        <th>Ҷинс</th>
                                        <th><? if($StPersons_gender==1){echo "Зан";}
                                            else{echo "Мард";}?></th>
                                    </tr>
                                    </tbody></table>
                            </td>
                        </tr>
                        <tr>
                            <th><p align="center">#</p></th>
                            <th><p align="center">Фан</p></th>
                            <th><p align="center">Баҳои ниҳоӣ</p></th>
                            <th><p align="center">Баҳои ҳарфӣ</p></th>
                            <th><p align="center">Миқдори кредит</p></th>
                            <th><p align="center">Омӯзгор</p></th>
                        </tr>
                        <?
                        $r=1;


                        foreach($transcript['Transkprit'] as $skprit){



                            $lesson_name=$skprit['lestable']['lesson']['name'];
                            $lesson_kredit=$skprit['lestable']['lesson']['lesson_kredit'];
                            $Teacher_FIO=$skprit['lestable']['teacher']['persons']['surname'].' '
                                .$skprit['lestable']['teacher']['persons']['name'].' '.$skprit['lestable']['teacher']['persons']['middle_name'];

                            $final=$skprit['exam_mark_final'];
                            $latter=$skprit['letter'];
                            $smestr=$skprit['smestr'];

                            ?>





                            <!--								<th colspan="6" style="text-align:center;">Семестри-->
                            <!--								   --><?////=$smestr?>
                            <?


                            echo'<tr><td align="center">'.$r.'</td>
								  <td align="center">'.$lesson_name.'</td>
								  <td align="center">'.$final.'</td>
								  <td align="center">'.$latter.'</td>
								  <td align="center">'.$lesson_kredit.'</td>
								  <td align="center">'.$Teacher_FIO.'</td>
								  </tr>';
                            $r++;
                        }
                        echo '</th>';
                        ?>
                        </tbody></table>

                </div>
            </div>
        </div>

    </div>

</section>






