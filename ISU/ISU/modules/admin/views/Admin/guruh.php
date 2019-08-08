<section class="page-content">

<?php if(isset($data))
{ ?>

    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Гурӯҳи интихобкардашуда</h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <div class="row" >
                        <div class="col-sm-6">
                            <dl id="dt-list-1" class="dl-horizontal">
                                <dt>Гурӯҳ:</dt>
                                <dd><?=$data['course']. '-"'.$data['profession']['0']['profession'].'"'?></dd>
                                <dt>Забони таълим:</dt>
                                <dd><?=$data['language'];?></dd>

                                <dt>Роҳбари гурӯҳ:</dt>
                                <dd><?=$data['teacher']['0']['person']['0']['surname'].' '.
                                    $data['teacher']['0']['person']['0']['name'].' '.$data['teacher']['0']['person']['0']['middle_name'];?></dd>
                            </dl>
                        </div>
                        <div class="col-sm-6">
                        </div>
                    </div>
                    <div class="row" >
                        <div class="tabbable">
                            <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
                                <li class="">
                                    <a data-toggle="tab" class="talabagon" onclick='talabagoni(<?=$data['id_group']?>)' href="#talabagon">
                                        <i class="green ace-icon fa fa-users bigger-120"></i>
                                        Талабагон</a>
                                </li>

                                <li>
                                    <a data-toggle="tab" class="jadvali_darsi" onclick='jadvali_darsi(<?=$data['id_group']?>)' href="#jadvali_darsi">
                                        <i class="green ace-icon fa fa-calendar bigger-120"></i>
                                        Ҷадвали дарси</a>
                                </li>

                            </ul>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/ktk.tj/web/admin/js/jquery-ui.min.js"></script>
</section>
    <?php
}elseif(isset($data)){
    ?>
    <div>
        <div class="wizard-actions">
            <button class="btn btn-success" onclick="add_khonanda(<?//=$id_s?>)">
                <i class="ace-icon fa fa-pencil align-top bigger-125"></i>
                Иловаи хонандаи нав
            </button>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th class="center">№</th>
                <th>ННН</th>
                <th class="hidden-xs">Ткелефон ( худ / падар / модар )</th>
                <th class="hidden-480">Сатҳи хониш</th>
                <th> Амал</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=0; foreach($data as $row):$i++; ?>
                <tr>
                    <td class="center"><?//=$i;?></td>

                    <td>
                        <?////=$row['fio_h']?>
                    </td>
                    <td class="hidden-xs">
                        <?//=$row['telefon_h'].' | '.$row['telefon_p'].' | '.$row['telefon_m']?>
                    </td>
                    <td class="hidden-480">5</td>
                    <td>

                        <div class="hidden-sm hidden-xs btn-group">
                            <button class="btn btn-xs btn-success" onclick="select_id_khonanda(<?//=$row['id_h']?>)">
                                <i class="ace-icon fa fa-search-plus bigger-120"></i>
                            </button>

                            <button class="btn btn-xs btn-info">
                                <i class="ace-icon fa fa-pencil bigger-120"></i>
                            </button>

                            <button class="btn btn-xs btn-danger">
                                <i class="ace-icon fa fa-trash-o bigger-120"></i>
                            </button>


                        </div>

                        <div class="hidden-md hidden-lg">
                            <div class="inline pos-rel">
                                <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto" >
                                    <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                    <li>
                                        <a href="#" class="tooltip-info" data-rel="tooltip" title="" data-original-title="View" onclick="select_id_khonanda(<?//=$row['id_h']?>)">
                                        <span class="blue">
                                            <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                        </span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" class="tooltip-success" data-rel="tooltip" title="" data-original-title="Edit">
                                        <span class="green">
                                            <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                        </span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" class="tooltip-error" data-rel="tooltip" title="" data-original-title="Delete">
                                        <span class="red">
                                            <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                        </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </td>
                </tr>
            <?php endforeach;?>


            </tbody>
        </table>

    </div>

    <?php
}
?>
