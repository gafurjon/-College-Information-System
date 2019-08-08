<section class="page-content">
    <div class="row">
        <div class="col-xs-12">
            <table id="simple-table" class="table  table-bordered table-hover">
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

              for($i=0; $i<=count($myfile); $i++) {

                   if($myfile[$i]['user_id']<> "" && $myfile[$i]['id_teacher']== 0){

                ?>
                <tr>
                    <td align="center">
                    <?=$nomer?>
                    </td>
					
                    <td >
                        <a  href="<?=$myfile[$i]['file']?>"><?=$myfile[$i]['name']?></a>
                        <br><?=$myfile[$i]['text']?>
                    </td>
					

                    <td nowrap="" align="center" <?php if($myfile[$i]['status']==1){?>
                        bgcolor="#99FF66">

                        <font color="red">Нав<?} else{?><font color="#CC3300"><?}?></font>
                        <br>
                        <b><?=$myfile[$i]['date']?></b>
                    </td>
                    <td align="center">


                        <b><font color="#CC3300">
                                <?=$personsave[$i]['personsave']['surname']
                                .' '.$personsave[$i]['personsave']['name']?> </font></b>

                    </td>
                     <td align="center"><b><? if($myfile[$i]['user_id']==2 && $myfile[$i]['id_teacher']==0){echo 'Барои ҳамаи омӯзгорон';}
					elseif($myfile[$i]['user_id']==4 && $myfile[$i]['id_teacher']==0 && $personsave['personsave']['surname']==$myfile[$i]['teacher']['person']['0']['surname']) {echo 'Танҳо барои Шумо';}
					
					else {echo $myfile[$i]['teacher']['person']['0']['surname'].' '.$myfile[$i]['teacher']['person']['0']['name'].' '.$myfile[$i]['teacher']['person']['0']['middle_name']; }
					
					
					?></b></td>
                </tr>
				
                   <?}$nomer++;} ?>
                </tbody>
				
            </table>
			
        </div>
    </div>
</section>




