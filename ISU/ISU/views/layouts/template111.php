<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\models\Menu;
use app\models\User;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<link rel="shortcut icon" href="<?= \yii\helpers\Url::to('@web/image/logo.png')?>" type="image/png">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>Системаи иттилооти идоракуни КТК</title>
    <?php $this->head() ?>
</head>
<?php $this->beginBody() ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">


    <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo Yii::getAlias('@web').'/index.php?r=site/index'; ?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>К</b>Т</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>СИИ</b>КТ</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->

                    <!-- User Account: style can be found in dropdown.less -->
                    <?php
                    if(Yii::$app->user->isGuest){
                        ?>
                    <li class='dropdown user user-menu'>
                    <a href='<?php echo \yii\helpers\Url::to('@web/index.php?r=site/login'); ?>'>


                        <span class='fa fa-user'>&nbsp&nbspДохилшавии ба система</span>
                        </a>

            </li>

                    <?php }
                    else
                    {
                   ?>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?= yii\helpers\Url::to('@web/'.Yii::$app->user->identity['picture'])?>" class="user-image" alt="User Image">
                            <span class="hidden-xs">

                                 <?= Yii::$app->user->identity['surname'];?>
                                 <?= Yii::$app->user->identity['name'];?>
                                 <?= Yii::$app->user->identity['middle_name'];?>

                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?= yii\helpers\Url::to('@web/'.Yii::$app->user->identity['picture'])?>" class="img-circle" alt="User Image">
                                <p>
                                    <?= Yii::$app->user->identity['surname'];?>
                                    <?= Yii::$app->user->identity['name'];?>
                                    <?= Yii::$app->user->identity['middle_name'];?>
                                    <small></small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                           <!-- <li class="user-body">
                                <div class="col-xs-4 text-center">
                                    <a href="#">Followers</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Sales</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Friends</a>
                                </div>
                            </li>-->
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat, fa fa-key">Ивази парол</a>
                                </div>
                                <div class="pull-right">
                                    <?php
                                    echo Nav::widget([
                                        'options' => ['class' => ''],
                                        'items' => [
                                            Yii::$app->user->isGuest ? (
                                            ['label' => 'Login', 'url' => ['@web//login']]

                                            ) : (
                                                '<li>'
                                                . Html::beginForm(['/logout'], 'post')
                                                . Html::submitButton(
                                                    ' Баромад',
                                                    ['class' => 'btn btn-default btn-flat, fa fa-power-off']
                                                )
                                                . Html::endForm()
                                                . '</li>'
                                            )
                                        ],
                                    ])

                                    ?>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
               <?php }?>

                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <?php
            if(!Yii::$app->user->isGuest){
            ?>
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?= yii\helpers\Url::to('@web/'.Yii::$app->user->identity['picture']);?>" class="img-circle" alt="User Image">
                </div>

                <div class="pull-left info">
                    <p>
                        <?php
                        $users = \app\models\Users::getUserid(Yii::$app->user->identity['user_id']);
                        echo $users['name_user'];
                        ?>
                    </p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <?php } ?>


            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">Менюи асосӣ</li>

                <?php
                $tmp=User::gettmp();

                //exit;

                if (isset($tmp['tmp'])){
                    $id=$tmp['tmp'];

                }
                elseif(Yii::$app->user->identity['user_id']){
                    $id=Yii::$app->user->identity['user_id'];
                }
                else
                {
                    $id=0;
                }

                $menu=Menu::getMenu($id);
                //echo Yii::$app->user->identity['id_persons'];
                foreach ($menu as $menuho){?>
                    <li>

              <a href="<?=$menuho['url'] ?>">
                <i class="fa <?= $menuho['ico'] ?>"></i> <span><?= $menuho['page']; ?></span>
                    <?php
                    if ($menuho['page']==='Гузоштани баҳо'){
                        ?>
                        <i class="fa fa-angle-left pull-right"></i>
                        <?php
                        $id_teacher=\app\modules\teacher\models\Teachers::getID(Yii::$app->user->id);
                        $lessons = \app\modules\teacher\models\LessonsTable::getlesson($id_teacher['0']['id_teacher']); ?>
                        <ul class="treeview-menu">
                            <?php
                        for ($i=0;$i<=count($lessons)-1;$i++){
                    ?>

                        <li style="display: block;"><a href="index.html"><i class="fa fa-circle-o"></i>
                                <?php echo $lessons[$i]['lessons']['name'];?>
                            </a>
                        </li>

                  <?php }?></ul>

                           <?php } ?>
                  <?php
                  if ($menuho['status']===1){?>
                      <small class="label pull-right bg-green">new</small>
                  <?php }?>
              </a>
            </li>
               <?php }?>

               <!--<li class="active treeview">
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span>Гузоштани баҳо</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                                     <ul class="treeview-menu">
                        <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                        <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-files-o"></i>
                        <span>Layout Options</span>
                        <span class="label label-primary pull-right">4</span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                        <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                        <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                        <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
                    </ul>
                </li>->
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <?= $content ?>
    </div>

</div>

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.0
        </div>
        <strong>© 2016 СИИКТ, Ҳамаи ҳуқуқҳо ҳифз карда шудааст.</strong>
    </footer>

    <!-- Control Sidebar -->

    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->





</body>
<?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>
