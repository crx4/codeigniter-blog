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
                          <?php echo form_label('Kullanıcı Adı','identity');?>
                          <?php echo form_error('identity');?>
                          <?php echo form_input('identity','','class="form-control"');?>
                        </div>
                        <?php echo form_submit('submit', 'Hatırla', 'class="btn btn-lg btn-success btn-block"');?>
                        <hr />
                        Kayıtlı değil misiniz ? <a href="<?php echo site_url('register'); ?>" >Kayıt olun </a> yada <a href="<?php echo site_url(''); ?>">Anasayfa</a>'dan devam edin.
                      </fieldset>
                  <?php echo form_close();?>
              </div>
          </div>
      </div>
    </div>
  </div>
