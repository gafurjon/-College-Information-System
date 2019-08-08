<section class="page-content">
    <div class="row">
        <div class="col-xs-12">
            <table id="simple-table" class="table  table-bordered table-hover">
                <thead>
                <tr>
                    <th>№</th>
                    <th>Номи ҳуҷҷат ва эзоҳот</th>
                    <th>Санаи сабти ҳуҷҷат</th>
                    <th>Ки сабт кардааст</th>
                    <th>Барои ки сабт шудааст</th>
                </tr>
                </thead>

                <tbody>

                <?php

              $nomer=1;

              for($i=0; $i<=count($myfile); $i++) {

                   if($myfile[$i]['user_id']<> "" && $myfile[$i]['id_teacher']== 0){

                ?>
                <tr>
                    <td class="center">
                    <?=$nomer?>
                    </td>

                    <td class="center">
                        <a href="<?=$myfile[$i]['file']?>"><?=$myfile[$i]['name']?></a>
                        <br><?=$myfile[$i]['text']?>
                    </td>

                    <td nowrap="" align="center" <?php if($myfile[$i]['status']==1){?>
                        bgcolor="#99FF66">

                        <font color="red">Нав<?} else{?><font color="#CC3300"><?}?></font>
                        <br>
                        <b><?=$myfile[$i]['date']?></b>
                    </td>
                    <td>


                        <b><font color="#CC3300">
                                <?=$personsave[$i]['personsave']['surname']
                                .' '.$personsave[$i]['personsave']['name']?> </font></b>

                    </td>
                    <td align="center"><b><?=$myfile[$i]['user']['name_user']?></b></td>
                </tr>

                   <?}$nomer++;} ?>
                </tbody>
            </table>
        </div>
    </div>
</section>


