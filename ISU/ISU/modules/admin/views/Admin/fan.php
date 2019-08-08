<section class="page-content">
    <div class="row">
                    <!-- PAGE CONTENT BEGINS --><!-- PAGE CONTENT BEGINS --><!-- PAGE CONTENT BEGINS --><!-- PAGE CONTENT BEGINS -->
                    <?php //echo "<pre>"; print_r($menu); echo '</pre>';?>


                            <div id="accordion" class="accordion-style1 panel-group">
                                <?php
                                $a=true;
                                foreach($category as $pow):
                                    ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#home<?=$pow->id_category?>">
                                                    <i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                                    &nbsp;<?=$pow->name_category?>
                                                </a>
                                            </h4>
                                        </div>

                                        <div class="panel-collapse collapse" id="home<?=$pow->id_category?>">


                                            <table id="simple-table" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <th class="center"> №</th>
                                                    <th>Номи фан</th>
                                                    <th class="hidden-480">Ҳолати фан</th>
                                                    <th>Амалиётҳо</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $raqam=1;
                                                $lesson= $pow->lesson;
                                                foreach ($lesson as $lesson){?>
                                                    <tr>
                                                        <td class="center">  <?php echo $raqam;?> </td>
                                                        <td> <?=$lesson-> name?> </td>
                                                        <td align="center"> <?php if($lesson-> status)
                                                                echo "<input type='button' class='btn btn-xs btn-success' value='Меомӯзад'/>";
                                                            else echo "<input type='button' class='btn btn-xs btn-danger' value='Намеомӯзад'/>";?>  </td>

                                                        <td align="center">
                                                            <div class="hidden-sm hidden-xs btn-group">
                                                                <button class="btn btn-xs btn-info">
                                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                </button>

                                                                <button class="btn btn-xs btn-danger">
                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                </button>
                                                            </div>

                                                        </td>

                                                        <div class="hidden-md hidden-lg">
                                                            <div class="inline pos-rel">
                                                                <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                    <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
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
                                                    <?php $raqam++;?>
                                                <?php }?>

                                                </tbody>
                                            </table>



                                        </div>
                                    </div>
                                    <?php $a=false; endforeach;?>
                            </div>
                        </div><!-- /.col -->
    </section>


