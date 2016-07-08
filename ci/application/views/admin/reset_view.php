<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">
  <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="login-panel panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title"> Lütfen formu doldurun</h3>
              </div>
              <div class="panel-body">
                <?php echo form_open('admin/user/reset/' . $code,array('role' => 'form'));?>
                      <fieldset>
                        <div class="form-group">
                          <?php
                          echo form_label('Yeni Şifre','new');
                          echo form_error('new');
                          echo form_password('new','','class="form-control"');
                          ?>
                        </div>
                        <div class="form-group">
                          <?php
                          echo form_label('Yeni şifre tekrarı','new_confirm');
                          echo form_error('new_confirm');
                          echo form_password('new_confirm','','class="form-control"');
                          ?>
                          <?php echo form_input(array(
                                            					'name'  => 'user_id',
                                            					'id'    => 'user_id',
                                            					'type'  => 'hidden',
                                            					'value' => $user_id
                  				                            )); ?>
                          <?php echo form_hidden($csrf); ?>
                        </div>
                        <?php echo form_submit('submit', 'Şifreyi Yenile', 'class="btn btn-lg btn-success btn-block"');?>
                        <hr />
                        Kayıtlı değil misiniz ? <a href="<?php echo site_url('register'); ?>" >Kayıt olun </a> yada <a href="<?php echo site_url(''); ?>">Anasayfa</a>'dan devam edin.
                      </fieldset>
                  <?php echo form_close();?>
              </div>
          </div>
      </div>
    </div>
  </div>
