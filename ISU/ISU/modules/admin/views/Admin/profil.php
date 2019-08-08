<section class="page-content">
<h3>Профили	истифодабаранда</h3>
<div class="row">
    <div class="col-md-3" style="font-size:small">
        <!-- Profile Image -->
        <?php foreach($teachers as $teacher):?>

        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class='profile-user-img img-responsive img-circle' src='' alt='User profile picture'>
                <h3 class="profile-username text-center"><?php echo $teacher['person']['0']['surname'].' '.$teacher['person']['0']['name'];?> </h3>

                <?php if ($teacher['person']['0']['user_id']==2)
                {
                    echo "<p align='center'>Омӯзгор</p>";
                }
                ?>


                <ul class="list-group list-group-unbordered" style="font-size: 12px;">
                    <li class="list-group-item">
                        <b>Санаи таваллуд</b> <a class="pull-right"><?php echo $teacher['person']['0']['brithday'];?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Миллат</b> <a class="pull-right"><?php echo $teacher['person']['0']['nations']['nation_name'];?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Ҷинс</b> <a class="pull-right"><?php if($teacher['person']['0']['gender']==0){echo "Мард";}else echo "Зан";?></a>
                    </li>
                    <li class="list-group-item">
                        <b> Почтаи дохила</b><a class="pull-right"><?php echo $teacher['person']['0']['login'];?>@ktk.tj</a>
                    </li>
                </ul>

            <?php endforeach;?>
            </div><!-- /.box-body -->
        </div><!-- /.box -->


    </div><!-- /.col -->

    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#password" data-toggle="tab" aria-expanded="false"> Ивази парол</a></li>

            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="contacts">

                    <form class="form-horizontal" method="post" a>
                        <div class="form-group">

                            <label for="inputEmail" class="col-sm-4 control-label" >Пароли ҳозира</label>
                            <div class="col-sm-8">
                                <input name="old_password" id="inputName" class="form-control" placeholder="Пароли ҳозира" type="password">
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-4 control-label">Пароли нав</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="new_password" placeholder="Пароли нав" vk_1b4e2="subscribed" type="password">
                            </div>

                        </div>


                        <div class="form-group">
                            <label for="inputName" class="col-sm-4 control-label">Пароли навро такрор кунед</label>
                            <div class="col-sm-8">
                                <input name="new_password_double" class="form-control" placeholder="Пароли навро такрор кунед" vk_1b4e2="subscribed" type="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-10">
                                <button type="submit" name="btn_password" class="btn btn-danger">Тағйирдиҳӣ</button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.tab-pane -->

                <!-- /.tab-pane -->
            </div><!-- /.tab-content -->
        </div><!-- /.nav-tabs-custom -->
    </div><!-- /.col -->
</div><!-- /.row -->
</section>
