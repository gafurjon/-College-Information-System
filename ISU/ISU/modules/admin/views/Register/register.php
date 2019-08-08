         <!-- Кисми асоси контент-->
        <section class="page-content">
            <div class="row">
             <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Рӯйхати давомоти омӯзгорон</h3>
                  
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                  <table class="table table-hover" >
                    <tr>
                      <th><P align="center">№</P></th>
                      <th><p align="center">Омузгор</p></th>
                      <th><p align="center">Сана</p></th>
                      <th><p align="center">Вакти омадан</p></th>
                      <th><p align="center">Вакти рафтан</p></th>
                      <!--<th><p align="center">Статус</p></th>-->
                    </tr>

                      <?php
                         $time=date(' H:i:s');
                         $date=date('Y-m-d');
                         $raqam=1;
                      foreach ($data as $item) {
//                          echo "<pre>";
//                          print_r($item);
//                          echo "</pre>";
                           $fio=$item['person']['0']['surname'].' '.$item['person']['0']['name'].' '.
                               $item['person']['0']['middle_name'];
                            $item['teacher_stat_register'];

                             $id_teacher=$item['id_teacher'];


                      ?>
                          <?php if($item['teacher_stat_register']==1){ ?>
                        <tr align='center'>
                          <td><?php echo $raqam;?></td>
                          <td align='left'><?php echo $fio?></td>
                          <td><?php echo $date?></td>

                            <form action="" method="POST">
                                <td>
                                    <a href="<?php echo \yii\helpers\Url::to(['admin/register','id'=> $id_teacher, 'time_in'=>$time, 'oper' => 'in'])?>" >
                                        <input  type="button" name="daromad" class="btn btn-xs btn-success " value="Бақайдгирӣ" /></a></td>
                                <td>
                                    <a href="<?php echo  \yii\helpers\Url::to(['admin/register','id'=> $id_teacher, 'time_out'=>$time, 'oper' => 'out'])?>" >
                                        <input type="button" name="baromad" class="btn btn-xs btn-danger " value="Бақайдгирӣ" /></a>
                                </td>



                            </form>


                            <!--<td><?//if($item['teacher_stat_register']==1){?>
                                <span class='label label-success'>
                                    Бояд аз қайд гузаранд</span><?//}?></td>-->
                         </tr>
                      <?php $raqam++; } }?>
                  </table>

                  </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
          </section>


