<div class="page-header">
    <h1>
        Саҳифаи
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            аввал
        </small>
    </h1>
</div>
<div class="row">
    <div class="col-xs-12">

        <!-- PAGE CONTENT BEGINS --><!-- PAGE CONTENT BEGINS --><!-- PAGE CONTENT BEGINS --><!-- PAGE CONTENT BEGINS -->

        <div class="row">
            <div class="col-sm-12">
                <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTab">
                        <?php
                        foreach($faculty as $facult):?>

                        <?php if($facult['id_faculty']==1){?>
                        <li class="active">
                            <a data-toggle="tab" href="index.php?r=admin/admin/groups&id=<?php echo $facult['id_faculty'];?>" aria-expanded="true">
                                <i class="green ace-icon fa  fa-fire bigger-120"></i>
                                <?php echo $facult['faculty_name'];?>
                            </a>
                        </li>
                        <?php }?>

                        <?php if($facult['id_faculty'] <> '' and $facult['id_faculty'] <> 1){?>
                        <li class="">
                            <a data-toggle="tab" href="index.php?r=admin/admin/groups&id=<?php echo $facult['id_faculty'];?>" aria-expanded="false">
                                <i class="green ace-icon fa   fa-leaf bigger-120"></i>
                                <?php echo $facult['faculty_name'];?>
                            </a>
                        </li>
                        <?php }?>
                        <?php endforeach; ?>
                    </ul>

                    <?php
                    foreach($faculty as $facult):
                    $group=$facult->group;?>
                    <div class="tab-content">
                        <div id="ibtidoi" class="tab-pane fade active in">
                            <div class="row">
                                <div class="col-xs-12">
                                    <?php foreach($group as $row):?>

                                        <button class="btn btn-white btn-success" onclick='select_sinf(<?php echo $row['id_group']?>)'>
                                            <p><?php echo $row['course'].'-'.$row['profession']['0']['profession'];?></p>
                                            <span class="label label-inverse arrowed-in"><?php echo count($row['students']);?></span>
                                        </button>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div><!-- /.col -->
        </div>

        <div class="space-6"></div>
        <div class="row" id="select_sinf">

        </div>

        <?php // echo '<pre>'; print_r($sinfho); echo "</pre>"; ?>
        <!--<div class="space-6"></div>-->

        <!-- dialog-message -->
        <div id="dialog-message" class="hide">


        </div>

        <script src="/ktk.tj/web/admin/css/jquery-ui.min.css"></script>
        <!-- PAGE CONTENT ENDS --><!-- PAGE CONTENT ENDS --><!-- PAGE CONTENT ENDS --><!-- PAGE CONTENT ENDS --><!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->

<script type="text/javascript">
    function add_khonanda(id_s) {
        $.ajax({
            type: 'POST',
            url: '<?//=site_url('ajaxcontrol/add_khonanda')?>',
            data: 'id=' + id_s,
            success: function (returnData) {
                if (returnData) {
                    $('#dialog-message').html(returnData);
                } else {
                }
            }
        });

        var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
            modal: true,
            title: "Илова кардани хонанда",
            width: '90%',
            top: '33px',

            title_html: true,
            buttons: [
                {
                    text: "Cancel", "class" : "btn btn-minier",
                    click: function() { $( this ).dialog( "close" );
                    }
                },
                {
                    text: "OK", "class" : "btn btn-primary btn-minier",
                    click: function() { $( this ).dialog( "close" );
                    }
                }
            ]
        });
    };

</script>

<script type='text/javascript'>
    function select_sinf(id)
    {
        $.ajax({
            type: 'POST',
            url: '<?="?r=admin/control/select-group"?>/'+id,
            data: 'id='+id,
            success: function(returnData){
                if (returnData) {
                    $('#select_sinf').html(returnData);
                } else {
                    $('#select_sinf').html('');
                }
            }
        });
    };
    function talabagoni(id) {
        $.ajax({
            type: 'POST',
            url: '<?//=site_url('ajaxcontrol/talabagoni')?>/'+id,
            data: 'id=' + id,
            success: function (returnData) {
                if (returnData) {
                    $('#talabagon').html(returnData);
                } else {
                }
            }
        });

    };

    function jadvali_darsi(id) {
        $.ajax({
            type: 'POST',
            url: '<?//=site_url('ajaxcontrol/timetable_sinf_read')?>/'+id,
            data: 'id=' + id,
            success: function (returnData) {
                if (returnData) {
                    $('#jadvali_darsi').html(returnData);
                } else {
                }
            }
        });

    };


    function select_id_khonanda(id)
    {
        $.ajax({
            type: 'POST',
            url: '<?//=site_url('ajaxcontrol/select_id_konanda')?>',
            data: 'id=' + id,
            success: function (returnData) {
                if (returnData) {
                    $('#dialog-message').html(returnData);
                } else {
                }
            }
        });

        var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
            modal: true,
            title: "Маълумоти пурра оиди хонанда",
            width: '85%',
            top: '33px',

            title_html: true,
            buttons: [
                {
                    text: "Cancel", "class" : "btn btn-minier",
                    click: function() { $( this ).dialog( "close" );
                    }
                },
                {
                    text: "OK", "class" : "btn btn-primary btn-minier",
                    click: function() { $( this ).dialog( "close" );
                    }
                }
            ]
        });
    };
</script>


