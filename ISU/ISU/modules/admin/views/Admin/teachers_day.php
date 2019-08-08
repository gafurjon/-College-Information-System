        <!-- Кисми асоси контент-->
        <section class="page-content">
            <div class="row">

            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Рӯйхати давомоти омӯзгорон</h3>

                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-striped table-bordered table-hover" >
                    <tr>
                      <th><P align="center">№</P></th>
                      <th><p align="center">Омузгор</p></th>
                      <th><p align="center">Сана</p></th>
                      <th><p align="center">Вакти омадан</p></th>
                      <th><p align="center">Вакти рафтан</p></th>
                      <th><p align="center">Статус</p></th>
                    </tr>

                      <?php
                        $raqam=1;
                      foreach ($teacher as $item) {


                          $fio=$item['person']['0']['surname'].' '.$item['person']['0']['name'].' '.
                              $item['person']['0']['middle_name'];?>
                      <tr align='center'>
                          <td><?php echo $raqam; ?></td>
                      <td align='left'><?php echo $fio;?></td>
                      <td><?php echo $item['teacher']['0']['date'];?></td>
                      <td><?php echo $item['teacher']['0']['time_in'];?></td>
                      <td><?php echo  $item['teacher']['0']['time_out'];?></td>
                      <td><?php
                          if($item['teacher']['0']['time_in']<='08:30:00'){
                              echo "<span class='label label-success'>
                                  Ҳузур доранд</span>";}
                          elseif($item['teacher']['0']['time_in'] < '08:31:00' ){
                            echo "<span class='label label-warning'>Дер омадаанд</span>";
                          }
                          else{
                          echo "<span class='label label-danger'>Хузур надоранд</span>";
                           }?>

                      </td>
                      <td></td>
                      </tr>
                      <?php $raqam++; } ?>

                  </table>
                  </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.box -->


                  <div class="box">

                  <table class="table table">
                  <tr>
                    <td><p><span class="label label-success">  </span> - Омузгороне, ки дар вакти муайянкарда шуда ба КТ хозир шудаанд</p></td>

                     <td><p><span class="label label-warning">  </span> - Омузгороне, ки дар вакти муайянкарда шуда ба КТ хозир шуда натавониста дер омаданд!</p></td>

                     <td><p><span class="label label-danger">  </span> - Омузгороне, ки дар вакти муайянкарда шуда ба КТ тамоман хозир нашудаанд!</p></td>
                    </tr>

                  </table>
                  </div>
          </div>
        </section>
        <!-- /.content -->

