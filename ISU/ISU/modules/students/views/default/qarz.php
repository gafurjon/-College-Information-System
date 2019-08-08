    <div class="row" style="font-size: 12px">

   <div class="col-md-12">
                        <div class="box box-primary">
                          <div class="box-header with-border">
                            <h3 class="box-title">Фанҳое, ки Шумо қарздор ҳастед:</h3>

                          </div><!-- /.box-header -->
                          <div class="box-body no-padding"><br>
                              <?
                              $r=1;


                              foreach($transcript['Transkprit'] as $skprit){



                              $lesson_name=$skprit['lestable']['lesson']['name'];
                              $lesson_kredit=$skprit['lestable']['lesson']['lesson_kredit'];
                              $Teacher_FIO=$skprit['lestable']['teacher']['persons']['surname'].' '
                                  .$skprit['lestable']['teacher']['persons']['name'].' '.$skprit['lestable']['teacher']['persons']['middle_name'];

                              $Teacher_picture=\yii\helpers\Url::to('@web/image/no_name.jpg');//$skprit['lestable']['teacher']['persons']['picture'];
                              $final=$skprit['exam_mark_final'];
                              $latter=$skprit['letter'];
                              $smestr=$skprit['smestr'];



									  
									  if ($latter=='F' or $latter=='FX'){
									
								 ?>


                          <form name="f1" enctype="multipart/form-data" method="post">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="info-box" style="border: 0.5px;border: groove; ">
                                                      <span class="info-box-icon bg-aqua">
                                                    <img src='<?=$Teacher_picture;?>'
													 class='user-image' alt='User Image' style=height:165%;>



                                                      </span>
                                                      <div class="info-box-content" style="background-color: #DD4B39">
														
                                                      <? echo $r; ?>. <br>
													  <table style="font-size: larger;border-spacing: 8px 2px; ">
                                                            <tbody><tr>
                                                                <td style="padding: 4px;">Фан</td>
                                                                <td style="padding: 4px;"><?=$lesson_name; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding: 4px;">Омӯзгор</td>
                                                                <th style="padding: 4px;"><?= $Teacher_FIO;?> </th>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding: 4px;">Маводи имтиҳонӣ</td>
                                                                <th style="padding: 4px;">
                                                                  <a href="#">Хониш</a>                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding: 4px;">Бал</td>
                                                                <th style="padding: 4px;">
                                                                  <?= $final;?>

                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" style="padding: 4px; text-align: center">
                                                                        
                                                            </td>
                                                            </tr>
                                                        </tbody></table>
                                                      </div><!-- /.info-box-content -->
                                                    </div><!-- /.info-box -->
                                         </div><?$r++;}}
										 
										 ?>
                                         </form>
                              </div>
                        </div>
   </div>
   </div>

	 			