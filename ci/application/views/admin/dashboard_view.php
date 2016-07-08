<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Başlangıç</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $message_count; ?></div>
                        <div>Mesaj</div>
                    </div>
                </div>
            </div>
            <?php echo anchor('admin/messages', '
                <div class="panel-footer">
                    <span class="pull-left">Mesajlara git!</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>'); ?>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $post_count; ?></div>
                        <div>Yazı</div>
                    </div>
                </div>
            </div>
            <?php echo anchor('admin/posts', '
                <div class="panel-footer">
                    <span class="pull-left">Yazılara git!</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>'); ?>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $user_count; ?></div>
                        <div>Kullanıcı</div>
                    </div>
                </div>
            </div>
            <?php echo anchor('admin/users', '
                <div class="panel-footer">
                    <span class="pull-left">Kullanıcılara git!</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>'); ?>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-picture-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $image_count; ?></div>
                        <div>Medya</div>
                    </div>
                </div>
            </div>
            <?php echo anchor('admin/images', '
                <div class="panel-footer">
                    <span class="pull-left">Galeriye git!</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>'); ?>
        </div>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-user fa-fw"></i> Son Kullanıcılar
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kullanıcı Adı</th>
                                        <th>Kayıt Zamanı</th>
                                        <th>Grubu</th>
                                        <th>Durumu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    foreach ($last_users as $user)
                                      echo "<tr><td>".$user['id'].
                                           "</td><td>".$user['username'].
                                           "</td><td>".mdate('%d-%m-%Y %h:%i %a', $user['created_on']).
                                           "</td><td>".$user['user_group'].
                                           "</td><td>".($user['active'] ? 'Aktif' : 'Pasif').
                                           "</td></tr>";
                                  ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.col-lg-4 (nested) -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-group fa-fw"></i> Kullanıcı Grupları
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Grup ismi</th>
                                      <th>Grup Tipi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    foreach ($user_groups as $group)
                                      echo "<tr><td>".$group['id'].
                                           "</td><td>".$group['name'].
                                           "</td><td>".$group['description'].
                                           "</td></tr>";
                                  ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.col-lg-4 (nested) -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-image fa-fw"></i> Son İmajlar
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>İmaj</th>
                                      <th>İmaj Açıklaması</th>
                                      <th>İmaj Dosya Adı</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    foreach ($last_images as $image)
                                      echo "<tr><td>".$image['id'].
                                           "</td><td><img width='64px' height='64px' src='".
                                           site_url('assets/uploads/'.$image['link'])."' /></td><td>".
                                           $image['alt'].
                                           "</td><td>".$image['link'].
                                           "</td></tr>";
                                  ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.col-lg-4 (nested) -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-8 -->
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-tasks fa-fw"></i> Sistem Bilgisi
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="list-group">
                    <a href="#" class="list-group-item">
                        <i class="fa fa-comment fa-fw"></i> Blog Adresi
                        <span class="pull-right text-muted small">
                          <em><?php echo $this->config->item('base_url'); ?></em>
                        </span>
                    </a>
                    <a href="#" class="list-group-item">
                        <i class="fa fa-language fa-fw"></i> Dil
                        <span class="pull-right text-muted small"><em><?php echo $this->config->item('language'); ?></em>
                        </span>
                    </a>
                    <a href="#" class="list-group-item">
                        <i class="fa fa-font fa-fw"></i> Karakter Seti
                        <span class="pull-right text-muted small"><em><?php echo $this->config->item('charset'); ?></em>
                        </span>
                    </a>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-4 -->
</div>
<!-- /.row -->
