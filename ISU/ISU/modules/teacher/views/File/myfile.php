<?
use yii\helpers\Html;
?>
<section class="page-content">
    <div class="row">
        <div class="col-xs-12">
            <table id="simple-table" class="table table-bordered table-striped dataTable">
                <thead>
                <tr>
                    <th><p  align="center">№</p></th>
                    <th><p  align="center">Номи ҳуҷҷат ва эзоҳот</p></th>
                    <th><p  align="center">Санаи сабт</p></th>
                    <th><p  align="center">Ки сабт кардааст</p></th>
                    <th><p  align="center">Барои ки сабт шудааст</p></th>
                </tr>
                </thead>

                <tbody>

                <?php
				
              $nomer=1;

              for($i=0; $i<=count($personsave); $i++) {
			  $id_file=$personsave[$i]['id_file'];

                   if($personsave[$i]['user_id']<> "" && $personsave[$i]['id_teacher']== 0 or $personsave[$i]['id_teacher']==\Yii::$app->session['id_teacher']){

                ?>
                <tr>
                    <td align="center">
                    <?=$nomer?>
                    </td>

                    <td>
                        <? $id='$.get("index.php?r=teacher/file/status&id_file='.$personsave[$i]['id_file'].'", function(data){$("").html(data);})';?>
                        <a  href="<?=$personsave[$i]['file']?>" id="<?=$id_file?>" onclick='<?=$id;?>'><?=$personsave[$i]['name']?></a>
                        <br><?=$personsave[$i]['text'];?>

                    </td>

					

                    <td nowrap="" align="center" <?php if($personsave[$i]['status']==1){?>
                        bgcolor="#99FF66">

                        <font color="red">Нав<?} else{?><font color="#CC3300"><?}?></font>
                        <br>
                        <b><?=$personsave[$i]['date']?></b>
                    </td>
                    <td align="center">


                        <b><font color="#CC3300">
                                <?=$personsave[$i]['personsave']['surname']
                                .' '.$personsave[$i]['personsave']['name']?> </font></b>

                    </td>
                    <td align="center"><b><? if($personsave[$i]['user_id']==2 && $personsave[$i]['id_teacher']==0){echo 'Барои ҳамаи омӯзгорон';}
					elseif($personsave[$i]['id_teacher'] <> 0 && $personsave[$i]['id_teacher']==\Yii::$app->session['id_teacher']) {echo 'Танҳо барои Шумо';}
					
					else {echo $personsave[$i]['personsave']['surname']
                        .' '.$personsave[$i]['personsave']['name']
                        .' '.$personsave[$i]['personsave']['middle_name']; }
					
					//debug($myfile[$i]);
					?></b></td>
                </tr>

                   <?}$nomer++;} ?>
                </tbody>
            </table>
        </div>
    </div>
	
	
	
</section>



