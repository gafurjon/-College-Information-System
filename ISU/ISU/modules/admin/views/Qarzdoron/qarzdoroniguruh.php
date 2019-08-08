<table  width="100%"  class="text" colspan="2">
    <tr>
        <td>
            <tr>
            <table class="table table-striped table-bordered table-hover" border="1px" align="left" style="margin-right: 20px; margin-bottom: 20px;
width:506px; height: 610px; ">
                <tbody >
                <tr >
                    <th ><p align="center">#</p></th>
                    <th ><p align="center">Ному насаб</p></th>
                    <th ><p align="center">Миқдори қарзҳо</p></th>
                </tr>
                <? $r=1; foreach ($students as $student):?>

                    <tr><th><p align="center"><?=$r?></p></th>
                        <td>
                            <!--            <a  onclick='$.get("index.php?r=admin/qarzdoron/index", function(data){$("#content").html(data);})'>-->
                            <!--                </a>-->

                            <a  onclick='$.get("index.php?r=admin/qarzdoron/select_qarzho&id_students=<?=$student['id_students']?>", function(data){$("#qarzho").html(data);})'>
                                <?=$student['surname'].' '.$student['name'].' '.$student['middle_name'];?>
                            </a>
                        </td>
                        <? $miqdor=0; foreach ($qarzdoron as $item){?>
                            <?

                            if($item['id_students']==$student['id_students'] ){

                                if($item['letter']=='F' or $item['letter']=='FX'){


                                    $miqdor=$miqdor+1;
                                }



                            }

                            ?>


                        <? } ?>
                        <td><p align="center"><?=$miqdor;?></p></td>

                    </tr>
                    <? $r++;
                endforeach; ?>

                </tbody></table>

        </td>
        <td>
            <table id="qarzho" class="table table-striped table-bordered table-hover" style="width: 495px; height: 82px">
            </table>
        </td>
    </tr>
    </tr>
</table>








