<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">
  <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="login-panel panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title"> Lütfen formu doldurun</h3>
              </div>
              <div class="panel-body">
                <?php echo form_open('',array('role' => 'form'));?>
                  <fieldset>
                    <div class="form-group">
                      <?php
                      echo form_label('İsim','first_name');
                      echo form_error('first_name');
                      echo form_input('first_name',set_value('first_name'),'class="form-control"');
                      ?>
                    </div>
                    <div class="form-group">
                      <?php
                      echo form_label('Soyisim','last_name');
                      echo form_error('last_name');
                      echo form_input('last_name',set_value('last_name'),'class="form-control"');
                      ?>
                    </div>
                    <div class="form-group">
                      <?php
                      echo form_label('Şirket / Kurum','company');
                      echo form_error('company');
                      echo form_input('company',set_value('company'),'class="form-control"');
                      ?>
                    </div>
                    <div class="form-group">
                      <?php
                      echo form_label('Telefon','phone');
                      echo form_error('phone');
                      echo form_input('phone',set_value('phone'),'class="form-control"');
                      ?>
                    </div>
                    <div class="form-group">
                      <?php
                      echo form_label('Kullanıcı Adı','identity');
                      echo form_error('identity');
                      echo form_input('identity',set_value('identity'),'class="form-control"');
                      ?>
                    </div>
                    <div class="form-group">
                      <?php
                      echo form_label('E-posta','email');
                      echo form_error('email');
                      echo form_input('email','','class="form-control"');
                      ?>
                    </div>
                    <div class="form-group">
                      <?php
                      echo form_label('Şifre','password');
                      echo form_error('password');
                      echo form_password('password','','class="form-control"');
                      ?>
                    </div>
                    <div class="form-group">
                      <?php
                      echo form_label('Şifre tekrarı','password_confirm');
                      echo form_error('password_confirm');
                      echo form_password('password_confirm','','class="form-control"');
                      ?>
                    </div>
                    <div class="form-group">
                      <?php
                      if(isset($groups))
                      {
                        echo form_label('Kullanıcı Grupları','groups[]');
                        foreach($groups as $group)
                        {
                          echo '<div class="checkbox">';
                          echo '<label>';
                          echo form_checkbox('groups[]', $group->id, set_checkbox('groups[]', $group->id));
                          echo ' '.$group->name;
                          echo '</label>';
                          echo '</div>';
                        }
                      }
                      ?>
                    </div>
                    <?php echo form_submit('submit', 'Kayıt Ol', 'class="btn btn-lg btn-success btn-block"');?>
                    <hr />
                    Kayıtlı mısınız ? <a href="<?php echo site_url('login'); ?>" >Giriş yapın </a> yada <a href="<?php echo site_url(''); ?>">Anasayfa</a>'dan devam edin.
                  </fieldset>
                <?php echo form_close();?>
              </div>
          </div>
      </div>
    </div>
  </div>
