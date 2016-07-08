<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="tr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $page_title;?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo site_url('assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo site_url('assets/admin/bower_components/metisMenu/dist/metisMenu.min.css'); ?>" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo site_url('assets/admin/dist/css/timeline.css'); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo site_url('assets/admin/dist/css/sb-admin-2.css'); ?>" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo site_url('assets/admin/bower_components/morrisjs/morris.css'); ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo site_url('assets/admin/bower_components/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php echo $before_head;?>
</head>

<body>

  <?php if($this->ion_auth->logged_in()) { ?>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo site_url('/admin/dashboard'); ?>">Yönetim Paneli</a>
                <a class="navbar-brand" href="<?php echo site_url(''); ?>">Blog Anasayfa</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
              <?php if($this->ion_auth->is_admin()) { ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown"
                        href="#"<?php if(isset($new_messages_count)) echo $new_messages_count > 0 ? ' style="color: #d9534f;"' : ''; ?>>
                        <?php if(isset($new_messages_count)) echo $new_messages_count; ?><i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <?php foreach($last_messages as $message) { ?>
                          <li<?php echo $message['is_read'] !== '1' ? ' class="list-group-item list-group-item-success"' : ''; ?>>
                              <a href="<?php echo site_url('admin/messages/details/'.$message['id']); ?>">
                                  <div>
                                      <strong><?php echo $message['fullname'] ?></strong>
                                      <span class="pull-right text-muted">
                                          <em><?php echo word_limiter(timespan(strtotime($message['time']),time()), 4); ?></em>
                                      </span>
                                  </div>
                                  <div>
                                    <?php echo word_limiter($message['content'], 10); ?>
                                  </div>
                              </a>
                          </li>
                        <?php } ?>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="<?php echo site_url('admin/messages'); ?>">
                                <strong>Tüm Mesajlar</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <?php } ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo site_url('admin/user/profile');?>">
                          <i class="fa fa-user fa-fw"></i> Profilim </a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url('admin/user/logout'); ?>">
                          <i class="fa fa-sign-out fa-fw"></i> Çıkış yap </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
  <?php } ?>
