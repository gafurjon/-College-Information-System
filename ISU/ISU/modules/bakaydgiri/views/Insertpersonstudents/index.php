<?php
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use yii\widgets\Pjax;
use yii\helpers\Html;

?>



<section class="page-content">
    <div class="row">
        <div class="col-xs-8">
            <div class="box-body">
                <?php
                if(isset($save)){
                    ?>

                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-info"></i>Огоҳӣ</h4>
                        Маълумотҳои зарури ворид карда шуд!
                    </div>
                <?}?>

                <?php
                $form = ActiveForm::begin([
                    'id'                          =>    'about-form',
                    'method'                      =>    'post',
                    'options' => [
                        'onctype' => 'multipart/form-data',
                    ],
                ]); ?>


                <div class="box-header">
                    <h3 class="box-title">Иловаи донишҷӯ</h3>
                </div>
                <??>
                <form name='Guest' method='post' enctype='Multipart/form-data' >
                    <div class="box-body">

                    <table border="0px" width="100%" >
                
                <tr>
                    <td>

                        <div class="form-group">
                            <label>Насаб</label>
                            <input style='width:270px' type="text" name='surname' class="form-control" placeholder="Насаб...">
                        </div>
                        <!-- Ном -->
                        <div class="form-group">
                            <label>Ном</label>
                            <input style='width:270px' type="text" name='name' class="form-control" placeholder="Ном...">
                        </div>
                        <!-- Номи падар -->
                        <div class="form-group">
                            <label>Номи падар</label>
                            <input style='width:270px' type="text" name='middle_name' class="form-control" placeholder="Номи падар...">
                        </div>
<!--                        <!-- Логин -->
<!--                        <div class="form-group">-->
<!--                            <label>Логин</label>-->
<!--                            <input style='width:270px' type="text" name='login' class="form-control" placeholder="Логин...">-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <label for="exampleInputPassword1">Парол</label>-->
<!--                            <input style='width:270px' type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Парол...">-->
<!--                        </div>-->
                        <!-- Date dd/mm/yyyy -->
                        <div class="form-group">
                            <label>Соли таваллуд</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input style='width:232px' name="s_tav" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                            </div><!-- /.input group -->
                        </div><!-- /.form group -->

                        <!-- radiobutton -->
                        <div class="form-group">
                            <label>Ҷинс</label><br>
                            <label>
                                <input type="radio" value="0" name="jins" class="minimal" checked>
                                Мард
                            </label>
                            <label>
                                <input type="radio" name="jins" value="1" class="minimal">
                                Зан
                            </label>
                        </div>
                        <!-- Вилоят -->
                        <div class="form-group">
                            <label>Вилоят</label><br>
                            <select name="viloyat"><option selected="selected" value="0">----</option>
                                <?php $i=1; foreach ($region as $viloyat){ ?>
                                    <option value="<?=$viloyat['id_regions']?>"><?=$viloyat['regions_name']?></option>
                                    <?php $i++;}?>
                            </select>
                        </div>
                        
                        <!-- Ноҳия -->
                        <div class="form-group">
                            <label>Ноҳия</label><br>
                            <select name="nohiya"><option selected="selected" value="0">----</option>
                                <?php $i=1; foreach ($zoning as $item){ ?>

                                    <option value="<?=$item['id_zoning']?>"><?=$item['zoning_name']?></option>
                                    <?php $i++;}?>
                            </select>
                        </div>
                        </td> 
                        <!--- YACHEYKAI 2-->
                        <td>
                        <!-- Суроға -->
                        <div class="form-group">
                            <label>Суроға</label>
                            <input style='width:270px' type="text" name='suroga' class="form-control" placeholder="Суроға...">
                        </div>
                        <!-- Миллат -->
                        <div class="form-group">
                            <label>Миллат</label><br>
                            <select name="millat"><option selected="selected" value="0">----</option>
                                <?php $i=1; foreach ($nation as $millat){ ?>

                                    <option value="<?=$millat['id_nation']?>"><?=$millat['nation_name']?></option>
                                    <?php $i++;}?>
                            </select>
                        </div>

                        <!-- Ихтисос -->
                        <div class="form-group">
                            <label>Ихтисос</label><br>

                            <select name="group"><option selected="selected" value="0">----</option>
                                <?php $i=1; foreach ($group_students as $group){ ?>

                                    <option value="<?=$group['id_group']?>"><?=$group['course'].'-'.$group['profession']['0']['profession'].' '.$group['profession']['0']['name'];?></option>
                                    <?php $i++;}?>
                            </select>
                        </div>

                        <!--Намуди таҳсил-->
                        <div class="form-group">
                            <label>Намуди таҳсил</label><br>
                            <label>
                                <input type="radio" name="tahsil" value="1" class="minimal"  checked>
                                Рӯзона
                            </label>
                            <label>
                                <input type="radio" name="tahsil" value="2" class="minimal">
                                Ғоибона
                            </label>
                        </div>

                        <!--Намуди таҳсил-->
                        <div class="form-group">
                            <label>Намуди таҳсил</label><br>
                            <label>
                                <input type="radio" name="bujet" value="1" class="minimal"  >
                                Ройгон
                            </label>
                            <label>
                                <input type="radio" name="bujet" value="0" class="minimal" checked>
                                Шартномавӣ
                            </label>
                        </div>
                        <!-- phone mask -->
                        <div class="form-group">
                            <label>Тел:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input name= "telefon" style='width:235px' type="text" class="form-control" data-inputmask='"mask": "(999) 99-99-99"' data-mask>
                            </div><!-- /.input group -->
                        </div><!-- /.form group -->

                        <div class="form-group">

                            <label for="exampleInputFile">Расми донишҷӯро интихоб намоед</label>
                            <?= $form->field($model, 'picture')->fileInput()->label(false)?>

                        </div>


                    </div><!-- /.box-body -->
                    <div class="box-footer">


                        <?= Html::resetButton('Сбрось', ['class' => 'btn btn-primary']) ?>

                        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>


                    </div>

                        </td>
                </tr>

                 

            </table>
                        
                        


                        <!--Намуди таҳсил-->

    <hr>                                
    <div class="page-header">
        <h1>
            Руйхати
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Донишҷӯён
            </small>
        </h1>
    </div>
    
       
            <!-- PAGE CONTENT BEGINS --><!-- PAGE CONTENT BEGINS --><!-- PAGE CONTENT BEGINS --><!-- PAGE CONTENT BEGINS -->

            <!-- PAGE CONTENT BEGINS -->
            <table id="grid-table"></table>

            <div id="grid-pager"></div>

            <script type="text/javascript">
                var $path_base = ".";//in Ace demo this will be used for editurl parameter
            </script>

            <!-- PAGE CONTENT ENDS -->

            <div id="dialog-message" class="hide">
                <p id="vazifaho">

                </p>

            </div><!-- #dialog-message -->

            <!-- PAGE CONTENT ENDS --><!-- PAGE CONTENT ENDS --><!-- PAGE CONTENT ENDS --><!-- PAGE CONTENT ENDS --><!-- PAGE CONTENT ENDS -->
      


           </div><!-- /.box-body -->
                    
                    <?php ActiveForm::end() ?>
            </div><!-- /.box -->



        </div><!-- /.col (left) -->

    </div><!-- /.row -->

    <!-- page specific plugin scripts -->
<script src="admin/js/bootstrap-datepicker.min.js"></script>
<script src="admin/jquery.jqGrid.min.js"></script>
<script src="admin/grid.locale-en.js"></script>

<script src="admin/jquery-ui.min.js"></script>
<script src="admin/js/jquery.ui.touch-punch.min.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">

    var grid_data =
        [
            <?php foreach($students as $row): 

           // debug($row);
           //  exit;

            if($row['bujet'] <> 0) { $namud='Буҷавӣ';}  else $namud='Шартномавӣ';

            if($row['status_st'] == 1) { $shakl='Рӯзона';}  elseif ($row['status_st'] == 2) { $shakl='Ғоибона';}
            elseif ($row['status_st'] == 3) { $shakl='Хориҷшуда';} elseif ($row['status_st'] == 4) {$shakl='Барқароршуда';}
             else  $shakl='Номаълум';
            ;
            ?>


             


            {id:"<?=$row['id_students'];?>",
                fio_surname:"<?=$row['person'][0]['surname']?>",
                fio_name:"<?=$row['person'][0]['name']?>",
                fio_middlename:"<?=$row['person'][0]['middle_name']?>",
                work: "<?=$namud; ?>",
                daraja:"<?=$shakl;?>",
                adres:"<?=$row['person'][0]['adress'];?>",
                telefon:"<?=$row['person'][0]['telefon'];?>"//,
                // omf:"<button class='btn btn-xs btn-warning' " +
                // "onclick='funcvazia(<?=$row['id_teacher']?>)'><i class='ace-icon fa fa-flag bigger-120'></i></button>"
            },
            <?php endforeach;?>

        ];

    var subgrid_data =
        {
            1:[
                {id:"1", name:"sfsdfsdfsdf 1", qty: 11},
                {id:"2", name:"sub grid item 2", qty: 3},
                {id:"3", name:"sub grid item 3", qty: 12},
                {id:"4", name:"sub grid item 4", qty: 5},
                {id:"5", name:"sub grid item 5", qty: 2},
                {id:"6", name:"sub grid item 6", qty: 9},
                {id:"7", name:"sub grid item 7", qty: 3},
            ],
            12: [
                {id:"1", name:"vfv 1", qty: 11},
                {id:"2", name:"sub grid item 2", qty: 3},
                {id:"3", name:"sub grid item 3", qty: 12},
                {id:"4", name:"sub grid item 4", qty: 5},
                {id:"5", name:"sub grid item 5", qty: 2},
                {id:"6", name:"sub grid item 6", qty: 9},
                {id:"7", name:"sub grid item 7", qty: 3},
            ]
        };
    function funcvazia( id ) {
        $.ajax({
            type: 'POST',
            url: '<?=\yii\helpers\Url::to('@web/index.php?r=admin/control/teacher&id_teacher=')?>'+id,
            data: 'savolid='+id,
            success: function(data){
                $('#dialog-message').html(data);
            }
        });
        var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
            modal: true,
            title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>Вазифадиҳи ба омӯзгор</h4></div>",
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

    jQuery(function($) {

        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";
        //override dialog's title function to allow for HTML titles
        $.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
            _title: function(title) {
                var $title = this.options.title || '&nbsp;'
                if( ("title_html" in this.options) && this.options.title_html == true )
                    title.html($title);
                else title.text($title);
            }
        }));

        //resize to fit page size
        $(window).on('resize.jqGrid', function () {
            $(grid_selector).jqGrid( 'setGridWidth', $(".page-content").width() );
        })
        //resize on sidebar collapse/expand
        var parent_column = $(grid_selector).closest('[class*="col-"]');
        $(document).on('settings.ace.jqGrid' , function(ev, event_name, collapsed) {
            if( event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed' ) {
                //setTimeout is for webkit only to give time for DOM changes and then redraw!!!
                setTimeout(function() {
                    $(grid_selector).jqGrid( 'setGridWidth', parent_column.width() );
                }, 0);
            }
        })

        //if your grid is inside another element, for example a tab pane, you should use its parent's width:

        $(window).on('resize.jqGrid', function () {
            var parent_width = $(grid_selector).closest('.tab-pane').width();
            $(grid_selector).jqGrid( 'setGridWidth', parent_width );
        })
        //and also set width when tab pane becomes visible
        $('#myTab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            if($(e.target).attr('href') == '#mygrid') {
                var parent_width = $(grid_selector).closest('.tab-pane').width();
                $(grid_selector).jqGrid( 'setGridWidth', parent_width );
            }
        })






        jQuery(grid_selector).jqGrid({
            //direction: "rtl",

            //subgrid options
            subGrid : false,
            //subGridModel: [{ name : ['No','Item Name','Qty'], width : [55,200,80] }],
            //datatype: "xml",
            subGridOptions : {
                plusicon : "ace-icon fa fa-plus center bigger-110 blue",
                minusicon  : "ace-icon fa fa-minus center bigger-110 blue",
                openicon : "ace-icon fa fa-chevron-right center orange"
            },
            //for this example we are using local data
            subGridRowExpanded: function (subgridDivId, rowId) {
                var subgridTableId = subgridDivId + "_t";
                $("#" + subgridDivId).html("<table id='" + subgridTableId + "'></table>");
                $("#" + subgridTableId).jqGrid({
                    datatype: 'local',
                    data: subgrid_data[rowId],
                    colNames: ['No','Item Name','Qty'],
                    colModel: [
                        { name: 'id', width: 50 },
                        { name: 'name', width: 150 },
                        { name: 'qty', width: 50 }
                    ]
                });

            },

            data: grid_data,
            datatype: "local",
            contentType: 'multipart/form-data',
            mtype: 'POST',
            height: 350,
            colNames:['', 'ID','Насаб', 'Ном', 'Номи падар','Намуди таҳсил', 'Шакли таҳсил','Суроға','Телефон',/*'Вазифадиҳӣ','Расм'*/],
            colModel:[
                {name:'myac',index:'', width:70, fixed:true, sortable:false, resize:false,
                    formatter:'actions',
                    formatoptions:{
                        keys:true,
                        //delbutton: false,//disable delete button

                        delOptions:{recreateForm: true, beforeShowForm:beforeDeleteCallback},
                        //editformbutton:true, editOptions:{recreateForm: true, beforeShowForm:beforeEditCallback}
                    }
                },
                {name:'id',index:'id', width:0.5, sorttype:"int", editable: false},
                {name:'fio_surname',index:'fio_surname', width:250, editable: true,editoptions:{size:"20",maxlength:"30"}},
                {name:'fio_name',index:'fio_name', width:250, editable: true,editoptions:{size:"20",maxlength:"30"}},
                {name:'fio_middlename',index:'fio_middlename', width:250, editable: true,editoptions:{size:"20",maxlength:"30"}},
                //{name:'work',index:'work', width:150,editable: true,editoptions:{size:"20",maxlength:"255"}},
                {name:'work',index:'work', width:150, editable: true,edittype:"select",editoptions:{value:"0:Шартномавӣ;1:Буҷавӣ"}},

                {name:'daraja',index:'daraja', width:150, editable: true,edittype:"select",editoptions:{value:"1:Рӯзона;2:Ғоибона;3:Хориҷшуда; 4:Барқароршуда "}},
                {name:'adres',index:'adres', width:200,editable: true,editoptions:{size:"20",maxlength:"30"}},
                {name:'telefon',index:'telefon', width:150,editable: true,editoptions:{size:"20",maxlength:"30"}},
                //{name:'omf',index:'omf', width:100,editable: false}
                /* { name: 'FilePath', index: 'FilePath', sortable: false, title: false, align: 'left', editable: true, edittype: 'file', width: 190, allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],
                 search: false, editoptions: {
                 enctype: "multipart/form-data"
                 }
                 },*/
            ],

            viewrecords : true,
            rowNum:10,
            rowList:[10,20,30],
            pager : pager_selector,
            altRows: true,
            //toppager: true,

            multiselect: true,
            //multikey: "ctrlKey",
            multiboxonly: true,
            width: 950,
            /* imgpath: '/Content/themes/smoothness/images',
             url: "/Master/GetCompanies",*/
            loadComplete : function() {
                var table = this;
                setTimeout(function(){
                    styleCheckbox(table);
                    updateActionIcons(table);
                    updatePagerIcons(table);
                    enableTooltips(table);
                }, 0);
            },




            editurl: "<?=\yii\helpers\Url::to('@web/index.php?r=bakaydgiri/insertpersonstudents/students')?>",//nothing is saved
            caption: "Руйхати донишҷӯён"

            //,autowidth: true,


            /**
             ,
             grouping:true,
             groupingView : {
                         groupField : ['name'],
                         groupDataSorted : true,
                         plusicon : 'fa fa-chevron-down bigger-110',
                         minusicon : 'fa fa-chevron-up bigger-110'
                    },
             caption: "Grouping"
             */

        });
        $(window).triggerHandler('resize.jqGrid');//trigger window resize to make the grid get the correct size



        //enable search/filter toolbar
        //jQuery(grid_selector).jqGrid('filterToolbar',{defaultSearch:true,stringResult:true})
        //jQuery(grid_selector).filterToolbar({});


        //switch element when editing inline
        function aceSwitch( cellvalue, options, cell ) {
            setTimeout(function(){
                $(cell) .find('input[type=checkbox]')
                    .addClass('ace ace-switch ace-switch-5')
                    .after('<span class="lbl"></span>');
            }, 0);
        }
        //enable datepicker
        function pickDate( cellvalue, options, cell ) {
            setTimeout(function(){
                $(cell) .find('input[type=text]')
                    .datepicker({format:'yyyy-mm-dd' , autoclose:true});
            }, 0);
        }


        //navButtons
        jQuery(grid_selector).jqGrid('navGrid',pager_selector,

            {   //navbar options
                edit: true,
                editicon : 'ace-icon fa fa-pencil blue',
                add: true,
                addicon : 'ace-icon fa fa-plus-circle purple',
                del: false,
                delicon : 'ace-icon fa fa-trash-o red',
                search: true,
                searchicon : 'ace-icon fa fa-search orange',
                refresh: true,
                refreshicon : 'ace-icon fa fa-refresh green',
                view: true,
                viewicon : 'ace-icon fa fa-search-plus grey',
            },
            {
                //edit record form
                //closeAfterEdit: true,
                //width: 700,
                recreateForm: true,
                beforeShowForm : function(e) {
                    var form = $(e[0]);
                    form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                    style_edit_form(form);
                }
            },
            {
                //new record form
                //width: 700,
                closeAfterAdd: true,
                recreateForm: true,
                viewPagerButtons: false,
                beforeShowForm : function(e) {
                    var form = $(e[0]);
                    form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar')
                        .wrapInner('<div class="widget-header" />')
                    style_edit_form(form);
                }
            },
            {
                //delete record form
                recreateForm: true,
                beforeShowForm : function(e) {
                    var form = $(e[0]);
                    if(form.data('styled')) return false;

                    form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                    style_delete_form(form);

                    form.data('styled', true);
                },
                onClick : function(e) {
                    //alert(1);
                }
            },
            {
                //search form
                recreateForm: true,
                afterShowSearch: function(e){
                    var form = $(e[0]);
                    form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
                    style_search_form(form);
                },
                afterRedraw: function(){
                    style_search_filters($(this));
                }
                ,
                multipleSearch: true,
                /**
                 multipleGroup:true,
                 showQuery: true
                 */
            },
            {
                //view record form
                recreateForm: true,
                beforeShowForm: function(e){
                    var form = $(e[0]);
                    form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
                }
            }
        )



        function style_edit_form(form) {
            //enable datepicker on "sdate" field and switches for "stock" field
            form.find('input[name=sdate]').datepicker({format:'yyyy-mm-dd' , autoclose:true})

            form.find('input[name=stock]').addClass('ace ace-switch ace-switch-5').after('<span class="lbl"></span>');
            //don't wrap inside a label element, the checkbox value won't be submitted (POST'ed)
            //.addClass('ace ace-switch ace-switch-5').wrap('<label class="inline" />').after('<span class="lbl"></span>');


            //update buttons classes
            var buttons = form.next().find('.EditButton .fm-button');
            buttons.addClass('btn btn-sm').find('[class*="-icon"]').hide();//ui-icon, s-icon
            buttons.eq(0).addClass('btn-primary').prepend('<i class="ace-icon fa fa-check"></i>');
            buttons.eq(1).prepend('<i class="ace-icon fa fa-times"></i>')

            buttons = form.next().find('.navButton a');
            buttons.find('.ui-icon').hide();
            buttons.eq(0).append('<i class="ace-icon fa fa-chevron-left"></i>');
            buttons.eq(1).append('<i class="ace-icon fa fa-chevron-right"></i>');
        }

        function style_delete_form(form) {
            var buttons = form.next().find('.EditButton .fm-button');
            buttons.addClass('btn btn-sm btn-white btn-round').find('[class*="-icon"]').hide();//ui-icon, s-icon
            buttons.eq(0).addClass('btn-danger').prepend('<i class="ace-icon fa fa-trash-o"></i>');
            buttons.eq(1).addClass('btn-default').prepend('<i class="ace-icon fa fa-times"></i>')
        }

        function style_search_filters(form) {
            form.find('.delete-rule').val('X');
            form.find('.add-rule').addClass('btn btn-xs btn-primary');
            form.find('.add-group').addClass('btn btn-xs btn-success');
            form.find('.delete-group').addClass('btn btn-xs btn-danger');
        }
        function style_search_form(form) {
            var dialog = form.closest('.ui-jqdialog');
            var buttons = dialog.find('.EditTable')
            buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'ace-icon fa fa-retweet');
            buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'ace-icon fa fa-comment-o');
            buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-purple').find('.ui-icon').attr('class', 'ace-icon fa fa-search');
        }

        function beforeDeleteCallback(e) {
            var form = $(e[0]);
            if(form.data('styled')) return false;

            form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
            style_delete_form(form);

            form.data('styled', true);
        }

        function beforeEditCallback(e) {
            var form = $(e[0]);
            form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
            style_edit_form(form);
        }



        //it causes some flicker when reloading or navigating grid
        //it may be possible to have some custom formatter to do this as the grid is being created to prevent this
        //or go back to default browser checkbox styles for the grid
        function styleCheckbox(table) {
            /**
             $(table).find('input:checkbox').addClass('ace')
             .wrap('<label />')
             .after('<span class="lbl align-top" />')


             $('.ui-jqgrid-labels th[id*="_cb"]:first-child')
             .find('input.cbox[type=checkbox]').addClass('ace')
             .wrap('<label />').after('<span class="lbl align-top" />');
             */
        }


        //unlike navButtons icons, action icons in rows seem to be hard-coded
        //you can change them like this in here if you want
        function updateActionIcons(table) {
            /**
             var replacement =
             {
                 'ui-ace-icon fa fa-pencil' : 'ace-icon fa fa-pencil blue',
                 'ui-ace-icon fa fa-trash-o' : 'ace-icon fa fa-trash-o red',
                 'ui-icon-disk' : 'ace-icon fa fa-check green',
                 'ui-icon-cancel' : 'ace-icon fa fa-times red'
             };
             $(table).find('.ui-pg-div span.ui-icon').each(function(){
                        var icon = $(this);
                        var $class = $.trim(icon.attr('class').replace('ui-icon', ''));
                        if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
                    })
             */
        }

        //replace icons with FontAwesome icons like above
        function updatePagerIcons(table) {
            var replacement =
                {
                    'ui-icon-seek-first' : 'ace-icon fa fa-angle-double-left bigger-140',
                    'ui-icon-seek-prev' : 'ace-icon fa fa-angle-left bigger-140',
                    'ui-icon-seek-next' : 'ace-icon fa fa-angle-right bigger-140',
                    'ui-icon-seek-end' : 'ace-icon fa fa-angle-double-right bigger-140'
                };
            $('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .ui-icon').each(function(){
                var icon = $(this);
                var $class = $.trim(icon.attr('class').replace('ui-icon', ''));

                if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
            })
        }

        function enableTooltips(table) {
            $('.navtable .ui-pg-button').tooltip({container:'body'});
            $(table).find('.ui-pg-div').tooltip({container:'body'});
        }

        //var selr = jQuery(grid_selector).jqGrid('getGridParam','selrow');

        $(document).one('ajaxloadstart.page', function(e) {
            $(grid_selector).jqGrid('GridUnload');
            $('.ui-jqdialog').remove();
        });
    });
</script>