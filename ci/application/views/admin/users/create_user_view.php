<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Kullanıcı Ekle</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
  <div class="col-lg-8 col-lg-offset-2">
    <?php echo form_open('',array('class'=>'form-horizontal'));?>
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
      echo form_label('Kullanıcı Adı','username');
      echo form_error('username');
      echo form_input('username',set_value('username'),'class="form-control"');
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
    <?php echo form_submit('submit', 'Kullanıcıyı Oluştur', 'class="btn btn-primary btn-lg btn-block"');?>
    <?php echo form_close();?>
  </div>
</div>
