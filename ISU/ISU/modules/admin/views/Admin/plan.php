<link href="/ktk.tj/web/admin/css/bootstrap-editable.css" rel="stylesheet">




        <style>
            .corner-frame {
                float: left;
            }

            .scrollable-rows-frame {
                float: left;
                overflow: hidden;
            }

            .scrollable-columns-frame {
                overflow: hidden;
            }

            .scrollable-data-frame {
                overflow: auto;
            }

            table.data th, table.data td {
                font-family: "Palatino Linotype";
                font-size: 14px;
                padding: 2px;
                border: 1px solid grey;
                border-spacing: 0px;
            }
            .ss{
        -moz-transform: rotate(180deg);
        -webkit-transform: rotate(180deg);
        -o-transform: rotate(180deg);
        writing-mode: tb-rl;
    }
</style>


<table id="ExampleTable" class="data table table-striped table-bordered table-hover" cellpadding="0" cellspacing="0">
<div id="content"></div>

 <thead>
    <tr>
        <th style="height:230px"><p class="ss"><br><br>Фанҳо/
                Гурӯҳҳо<br><br><br></p></th>
        <?php $i = 0;
        foreach ($lesson as $row) {
            $i++;
            echo "<th  style='height:230px'><p class='ss table-striped float-center'><bold>" . $row['name'] . "</bold></p></th>";
        }
        ?>
    </tr>
    </thead>
    <tbody class="table table-striped table-bordered table-hover float center">
    <?php
       foreach ($ms as $row) {

        echo "<tr ><td>" .$row['course'].' '.$row['profession']['0']['profession']. "</td>";

        foreach ($row['fanhoi'] as $pow) {

            echo "<td ><a class='s'  href='#' id='".$pow['id_lesson']."'
            data-type='text' data-pk=" . $row['id_group'] . "
            data-url='".\yii\helpers\Url::to('@web/index.php?r=admin/control/insert-table')."' >".$pow['mq']."</a></td>";
        }
        echo "</tr>";
    }
    ?>
    </tbody>
</table>

        <div id="scrollableTable"></div>

<script language="javascript" src="/ktk.tj/web/admin/js/tablescroller.js"></script>
<script language="javascript" src="/ktk.tj/web/admin/js/tablescroller.jquery.js"></script>

<script type="text/javascript" defer async>
    var options = {
        width: '99%',
        pinnedRows: 0,
        height: 300+(($('#ExampleTable tr').length - 1)*20),
        pinnedCols: 1,
        container: "#scrollableTable",
        removeOriginal: true
    };

    $("#ExampleTable").tablescroller(options);

</script>


<script src="/ktk.tj/web/admin/js/bootstrap-editable.js"></script>

<script>
    //turn to inline mode
    $.fn.editable.defaults.mode = 'popup';
    $(document).ready(function() {
        $('.s').editable();
    });
</script>


