<!-- Кисми асоси контент-->
<section class="page-content">
    <div class="row">

    <div class="col-md-12">

        <div class="box ">
            <div class='table-responsive mailbox-messages'>
                <div class="box-header with-border">

                    <h3 class="box-title">Рӯйхати гурӯҳҳо</h3>
                </div><!-- /.box-header -->
                <div class="box-content" align="center">
                   <?php foreach ($group_student as $item) {


                       $groups = $item['group']['profession']['0']['profession'];
                       $course= $item['group']['course'];

                   }
                   ?>

                    <label><p>Рӯйхати донишҷӯёни гурӯҳи <?php echo $groups;?> курси-<?php echo $course;?><br>
                                           миқдори донишҷӯён-<?php echo count($group_student);?>

                        </p></label>

                    <table class="table table-bordered">
                        <tr>
                            <td style="width: 10px" align='center'><b>№</b></td>
                            <td align='center' style='min-width:300px'><b>Ному ва насаби донишҷӯён</b></td>
                            <td align='center' style='min-width:100px'></td>
                            <?php
                            $raqam=1;
                            foreach ($group_student as $item){

                            /*  echo "<pre>";
                             print_r($item);
                              echo "</pre>";*/
                            $FIO=$item['person']['0']['surname'].' '.$item['person']['0']['name'].' '.
                                $item['person']['0']['middle_name'];
                                  


                            ?>

                           <tr><td align='center'><?php echo $raqam?></td>
            <ul >
            <td class='panelll' >
                <font color='black' ><p><?php echo $FIO?></p></font>
            </td>
            <td></td>
                <?php $raqam++;} ?>
            </ul>

            </table>

                </div><!-- /.box-body -->
            </div><!-- /.box-body -->
        </div><!-- /.box-body -->

    </div><!-- /.box -->


</div><!-- /.box -->
</section><!-- /.content -->