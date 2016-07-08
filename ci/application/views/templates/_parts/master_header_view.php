<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--========== The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags ==========-->

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $page_title.' - '.$options['blog_name'];?></title>
  <meta name="description" content="<?php echo $meta_description;?>">
  <meta name="keywords" content="<?php echo $meta_keywords;?>">
  <meta name="author" content="Mevlüt Canvar">

  <!--==========Dependency============-->
  <link rel="stylesheet" href="<?php echo site_url('assets/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo site_url('assets/css/font-awesome.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo site_url('assets/vendors/owl-carousel/assets/owl.carousel.css'); ?>">
  <link rel="stylesheet" href="<?php echo site_url('assets/vendors/magnific-popup/magnific-popup.css'); ?>">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit:500">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans:600,700italic">
  <link href='https://fonts.googleapis.com/css?family=Dosis:400,200,300,500,600,800,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:400,300,300italic,400italic">
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500italic,500,700italic,700,900,900italic' rel='stylesheet' type='text/css'>

  <!--==========Theme Styles==========-->
  <link href="<?php echo site_url('assets/css/style.css'); ?>" rel="stylesheet">
  <link href="<?php echo site_url('assets/css/theme/green.css'); ?>" rel="stylesheet">

  <!--========== HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries ==========-->
  <!--========== WARNING: Respond.js doesn't work if you view the page via file:// ==========-->
  <!--==========[if lt IE 9]>
      <script src="<?php echo site_url('assets/js/html5shiv.min.js'); ?>"></script>
      <script src="<?php echo site_url('assets/js/respond.min.js'); ?>"></script>
  <![endif]==========-->
</head>
<body class="home">
  <header class="row transparent white mb0" data-spy="affix" data-offset-top="100" id="header">
      <div class="container">
          <div class="row top-header">
              <div class="col-sm-4 search-form-col">
                  <!-- form action="#" method="get" class="search-form">
                      <div class="input-group">
                          <span class="input-group-addon">
                            <img src="<?php echo site_url('assets/images/search-icon-dark.png'); ?>" alt="">
                          </span>
                          <input type="search" class="form-control" placeholder="ARA">
                      </div>
                  </form -->
              </div>
              <div class="col-sm-4 logo-col text-center">
                  <h1 class="post-title">
                    <a href="<?php echo site_url(''); ?>" style="font-size: 36px">Mevlüt Canvar</a>
                  </h1>
              </div>
              <div class="col-sm-4 menu-trigger-col">
                  <button class="menu-trigger black pull-right">
                      <span class="active-page">Anasayfa</span>
                      <img src="<?php echo site_url('assets/images/menu-align-dark.png'); ?>" alt="" class="icon-burger">
                      <img src="<?php echo site_url('assets/images/menu-close-dark.png'); ?>" alt="" class="icon-cross">
                  </button>
              </div>
          </div>
      </div>
      <div class="row menu-section">
          <div class="container">
              <div class="row">
                  <div class="col-sm-8 menu-col">
                      <div class="row">
                          <ul class="nav column-menu white-bg">
                            <li <?php if(uri_string() === '') echo 'class="active"'; ?>>
                              <a href="<?php echo site_url(''); ?>">Anasayfa</a>
                            </li>
                            <li <?php if($this->uri->segment(1) === 'category') echo 'class="active dropdown"'; ?>>
                                <a href="#kategoriler" class="dropdown-toggle"
                                   data-toggle="dropdown" role="button"
                                   aria-haspopup="true" aria-expanded="false">
                                   Kategoriler <span class="caret"></span>
                                 </a>
                                <ul class="dropdown-menu">
        													<?php
        														foreach ($categories as $category) {
        															echo '<li>'.anchor(site_url('category/'.$category['id']), $category['description']).'</li>';
        														}
        													?>
                                </ul>
                            </li>
                            <li <?php if(uri_string() === '') echo 'class="active"'; ?>>
                              <a href="<?php echo site_url('gallery'); ?>">Galeri</a>
                            </li>
                          </ul>
                          <ul class="nav column-menu white-bg">
                            <li <?php if(uri_string() === '') echo 'class="active"'; ?>>
                              <a href="<?php echo site_url('about'); ?>">Hakkımda</a>
                            </li>
                            <li <?php if(uri_string() === '') echo 'class="active"'; ?>>
                              <a href="<?php echo site_url('contact'); ?>">İletişim</a>
                            </li>
                          </ul>
                      </div>
                  </div>
                  <div class="col-sm-4 subscribe-col">
                      <h5 class="widget-title">Yazılarımdan haberdar olun:</h5>
                        <?php echo form_open('welcome/newsletter',array('class'=>'form-inline subscribe-form'));?>
                          <div class="form-group">
                            <input type="email" name="email" id="email" style="margin-bottom: 10px;" class="form-control" placeholder="E-posta adresiniz.">
                            <?php echo form_error('email'); ?>
                          </div>
                          <button type="submit" class="btn btn-primary btn-sm"><span>Gönder</span></button>
                        <?php echo form_close();?>
                      <ul class="nav social-nav white">
                          <li><a href="<?php echo $options['twitter_url']; ?>"><i class="fa fa-twitter"></i></a></li>
                          <li><a href="<?php echo $options['facebook_url']; ?>"><i class="fa fa-facebook-official"></i></a></li>
                          <li><a href="<?php echo $options['gplus_url']; ?>"><i class="fa fa-google-plus"></i></a></li>
                          <li><a href="<?php echo $options['instagram_url']; ?>"><i class="fa fa-instagram"></i></a></li>
                          <li><?php echo mailto($options['mail_email'], '&#9993;'); ?></li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </header>
