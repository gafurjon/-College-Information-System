<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AdminClassAsset;
use app\models\Menu;
use app\models\User;

AdminClassAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<link rel="shortcut icon" href="<?= \yii\helpers\Url::to('@web/image/logo.png')?>" type="image/png">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta http-equiv="Content-Type" content="text/html; <?= Yii::$app->charset ?>">

    <title>Системаи иттилооти идоракуни КТК</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <!-- bootstrap & fontawesome -->
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>

</head>

<body class="no-skin">
<?php $this->beginBody() ?>
<div id="navbar" class="navbar navbar-default">
    <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
    </script>
    <div class="navbar-container container" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">

            <a href="<?php echo Yii::getAlias('@web').'/index.php?r=admin/admin/index'; ?>" class="navbar-brand">
                <small>
                    <i class="fa fa-leaf"></i>
                    Системаи Иттилоотии Идоракунии </b> Коллеҷи Технологӣ
                </small>
            </a>
        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                <?php
                if(Yii::$app->user->isGuest){
                ?>
                <li class="light-blue">
                    <a href='<?php echo \yii\helpers\Url::to('@web/index.php?r=site/logout'); ?>'>
                    <span class='fa fa-user'>&nbsp&nbspДохилшавии ба система</span>
                    </a>

                </li>

                <?php }
                else
                {
                ?>
                <li class="light-blue">
                    <a data-toggle="dropdown" href="<?php echo \yii\helpers\Url::to('@web/index.php?r=site/login'); ?>" class="dropdown-toggle">
                        <img class="nav-user-photo" src="<?= yii\helpers\Url::to('@web/'.Yii::$app->user->identity['picture'])?>" alt="User Photo" />
								<span class="user-info">
									<small>Хуш омадед,</small>
                                    <?= Yii::$app->user->identity['surname'];?>
                                    <?= Yii::$app->user->identity['name'];?>
                                    <?= Yii::$app->user->identity['middle_name'];?>
                                </span>

                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>

                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="#">
                                <i class="ace-icon fa fa-cog"></i>
                                Саҳифаи аввал
                            </a>
                        </li>

                        <!-- <li>
                             <a href="profile.html">
                                 <i class="ace-icon fa fa-user"></i>
                                 Profile
                             </a>
                         </li>-->

                        <li class="divider"></li>

                        <li>
                            <a href="<?=\yii\helpers\Url::to('@web/index.php?r=site/logout')?>">
                                <i class="ace-icon fa fa-power-off"></i>
                                Баромад
                            </a>
                        </li>
                    </ul>
                    <?php }?>
                </li>
            </ul>
        </div>
    </div><!-- /.navbar-container -->
</div>

<div class="main-container" id="main-container">
    <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    </script>


    <div id="sidebar" class="sidebar responsive">
        <script type="text/javascript">
            try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
        </script>




        <ul class="nav nav-list">

            <?=\app\components\MenuWidget::widget() ?>

            
        </ul><!-- /.nav-list -->

        <div class="sidebar-collapse" id="sidebar-collapse">
            <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
        </div>

        <script type="text/javascript">
            try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
        </script>
    </div>

    <div class="main-content">


        <div class="page-content">


            <div class="row">
                <div class="col-xs-12">
                    <div class="row">

                        <?=$content?>

                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div><!-- /.main-content -->






    <div class="footer">
    <div class="footer-inner">
        <div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">© 2017 СИИКТ,</span>
							Ҳамаи ҳуқуқҳо ҳифз карда шудааст.</span>
           </div>
    </div>
</div>

<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
    <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
</a>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
