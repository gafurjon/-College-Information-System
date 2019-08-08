<?php
use \yii\widgets\ActiveForm;
?>
<section class="page-content">
    <div class="row">
        <div class="col-xs-12">
            <div id="accordion" class="accordion-style1 panel-group">
                <?php
                $a=true;
                foreach($user as $pow):
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#home<?=$pow['user_id'];?>">
                                    <i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                    &nbsp;<?=$pow['name_user'];?>
                                </a>
                            </h4>
                        </div>

                        <div class="panel-collapse collapse" id="home<?=$pow['user_id'];?>">


                            <table id="simple-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center">№</th>
                                    <th class="center">Дастраси ба функсияҳо(менюҳо)</th>
                                    <th class="center">Ҳолати дастрасӣ</th>
                                    <th class="center">Амалиётҳо</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $raqam=1;
                                $menus= $pow->menu;

                                foreach ($menus as $menu){?>
                                    <tr>
                                        <td class="center">  <?php echo $raqam;?> </td>
                                        <td> <?=$menu->page;?> </td>
                                        <td align="center"> <?php if($menu->status== 1){
                                                echo "<input type='button' class='btn btn-xs btn-success' value='Дастраси дорад'/>";}
                                            else echo "<input type='button'
                                    class='btn btn-xs btn-danger' value='Дастраси надорад'/>";?>  </td>

                                        <td class="center">
                                            <div class="col-xs-3">
                                                <label>
                                                    <?php if($menu['status']==1){?>
                                                        <input id="<?=$menu['id_menu']?>" name="chek" class="ace ace-switch ace-switch-6" type="checkbox" checked   /><?php }

                                                    ?>
                                                    <span class="lbl"></span>
                                                </label>

                                            </div>
                                        </td>


                                    </tr>
                                    <?php $raqam++;?>
                                <?php }?>

                                </tbody>
                            </table>



                        </div>
                    </div>
                    <?php $a=false; endforeach;?>
            </div>
        </div><!-- /.col -->
    </div>
</section>




<script>

</script>
