<div class="page-header">
    <h1>
        Руйхати
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Омузгорон
        </small>
    </h1>
</div>
<div class="row">
    <div class="col-xs-12">
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
    </div><!-- /.col -->
</div><!-- /.row -->


<!-- page specific plugin scripts -->
<script src="/ktk.tj/web/admin/js/bootstrap-datepicker.min.js"></script>
<script src="/ktk.tj/web/admin/js/jquery.jqGrid.min.js"></script>
<script src="/ktk.tj/web/admin/js/grid.locale-en.js"></script>

<script src="/ktk.tj/web/admin/js/jquery-ui.min.js"></script>
<script src="/ktk.tj/web/admin/js/jquery.ui.touch-punch.min.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">

    var grid_data =
        [
            <?php foreach($teacher as $row):?>
            {id:"<?=$row['id_teacher']?>",
                fio_o:"<?=$row['person']['0']['name']?>",
                ihtisos:"<?=$row['person']['0']['name']?>",
                hujjati_tah:"<?=$row['person']['0']['name']?>",
                daraja:"<?=$row['person']['0']['name']?>",
                adres:"<?=$row['person']['0']['name']?>",
                telefon:"<?=$row['id_teacher']?>",
                sobiqai_kori:"<?=$row['id_teacher']?>",
                omf:"<button class='btn btn-xs btn-warning' onclick='funcvazia(<?=$row['id_teacher']?>)'><i class='ace-icon fa fa-flag bigger-120'></i></button>"},
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
            {id:"8", name:"sub grid item 8", qty: 8}
        ],
        12: [
            {id:"1", name:"vfv 1", qty: 11},
            {id:"2", name:"sub grid item 2", qty: 3},
            {id:"3", name:"sub grid item 3", qty: 12},
            {id:"4", name:"sub grid item 4", qty: 5},
            {id:"5", name:"sub grid item 5", qty: 2},
            {id:"6", name:"sub grid item 6", qty: 9},
            {id:"7", name:"sub grid item 7", qty: 3},
            {id:"8", name:"sub grid item 8", qty: 8}
        ]
    };
    function funcvazia( id ) {
        $.ajax({
            type: 'get',
            url: '<?=\yii\helpers\Url::to('@web/site/index.php?r=admin/control/teacher')?>&id_teacher='+id,
            data: 'savolid='+id,
            success: function(data){
                $('#dialog-message').html(data);
            }
        });
        var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
            modal: true,
            title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i> Вазифадиҳи ба омузгор</h4></div>",
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
            mtype: 'get',
            height: 350,
            colNames:['', 'ID','Насаб ном номи падар','Ихтисос', 'Ҳуҷати таҳсил', 'Дараҷа','Суроға','Телефон','Собиқаи кори','fanho'/*,'Расм'*/],
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
                {name:'fio_o',index:'fio_o', width:300, editable: true,editoptions:{size:"20",maxlength:"30"}},
                {name:'ihtisos',index:'ihtisos', width:250,editable: true,editoptions:{size:"20",maxlength:"30"}},
                {name:'hujjati_tah',index:'hujjati_tah', width:250,editable: true,editoptions:{size:"20",maxlength:"30"}},
                {name:'daraja',index:'daraja', width:90, editable: true,edittype:"select",editoptions:{value:"Оли:Оли;Миёна:Миёна"}},
                {name:'adres',index:'adres', width:200,editable: true,editoptions:{size:"20",maxlength:"30"}},
                {name:'telefon',index:'telefon', width:150,editable: true,editoptions:{size:"20",maxlength:"30"}},
                {name:'sobiqai_kori',index:'sobiqai_kori', width:100,editable: true,editoptions:{size:"20",maxlength:"30"}},
                {name:'omf',index:'omf', width:100,editable: false}
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

            editurl: "<?=\yii\helpers\Url::to('@web/site/index.php?r=admin/control/teachers')?>",//nothing is saved
            caption: "Руйхати омузгорони муасиса"

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

            { 	//navbar options
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
