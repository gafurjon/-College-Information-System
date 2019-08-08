<table id="ExampleTable" class="data table table-striped table-bordered table-hover" cellpadding="0" cellspacing="0">
    <thead>
    <tr>
        <th><p class="ss">Синфҳо/Фанҳо</p></th>
        <?php $i = 0;
        foreach ($fanho as $row) {
            $i++;
            echo "<th ><p class='ss table-striped float-center'><bold>" . $row['name'] . "</bold></p></th>";
        }
        ?>
    </tr>
    </thead>
    <tbody class="table table-striped table-bordered table-hover float center">
    <?php
    foreach ($ms as $row) {

        echo "<tr ><td>".$row['course'].'-'.$row['profession']."</td>";
        foreach ($row['fanhoi'] as $pow) {

            echo "<td  ><a class='s'  href='#' id='" . $pow['id_lesson'] . "' data-type='text' data-pk=" . $row['id_group'] . " data-url='?r=mamuriyat/ravand/insert-fan-sinf' >" . $pow['mq'] . "</a></td>";
        }
        echo "</tr>";
    }
    ?>
    </tbody>
</table>