<!-- Кисми асоси контент-->
<section class="page-content">
    <div class="row">

    <!-- SELECT2 EXAMPLE -->

    <table class="table table-bordered table-striped dataTable" >


        <tr>
            <th class="hidden-sm hidden-xs"><p align="center">Курс<p></th>
            <th class="hidden-sm hidden-xs"><p align="center">Раками гурух<p></th>
            <th class="hidden-sm hidden-xs"><p align="center">Факултет<p></th>
            <th><p align="center">Соли дохилшави<p></th>
            <th><p align="center">Соли хатм<p></th>
            <th><p align="center">Статуси гурух<p></th>
            <!--<th><p align="center">Ивази маълумот<p></th>-->
        </tr>

        <?php
        foreach ($group as $items)
        {
//        echo "<pre>";
//        print_r($items);
//        echo "</pre>";


        ?>


        <tbody>
        <tr>
            <td align="center"><?php echo $items['course']?></td>
            <td class="hidden-sm hidden-xs" align="center">
                <a href='index.php?r=admin/admin/group-student&id=<?php echo $items['id_group'];?>'>
                    <?php echo $items['profession']['0']['profession']?> </a></td>

            <td class="hidden-sm hidden-xs" align="center"><?php echo $items['faculty']['0']['faculty_name']?></td>
            <td class="hidden-sm hidden-xs" align="center"><?php echo $items['year']?></td>
            <td align="center"><?php echo $items['final_year']?></td>
            <td align="center">


                <div class="col-xs-3">

                    <label>
                        <input name="switch-field-1" class="ace ace-switch" type="checkbox"
                               <?php if ($items['group_status'] > '0' ){ ?> checked="checked"<?php } ?>
                               />
                        <span class="lbl middle" ></span>
                    </label>
                </div>



          <!--  <td  align="center">
                <a href="" class="btn btn-primary">
                    <i class="fa fa-fw fa-edit" ></i></a></td>
            </td>-->

        </tr>
        <?php } ?>




        </tbody>
    </table>

</section><!-- /.content -->