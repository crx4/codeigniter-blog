<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">İmaj Ekle</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
  <div class="col-lg-10 col-lg-offset-1">
    <?php echo form_open_multipart('',array('class'=>'form-horizontal'));?>
      <div class="form-group">
        <?php echo form_label('İmaj Açıklaması','image_alt');?>
        <?php echo form_error('image_alt');?>
        <?php echo form_input('image_alt','','class="form-control"');?>
      </div>
      <div class="form-group">
        <?php echo form_label('İmaj Dosyası','image_file');?>
        <?php echo form_error('image_file');?>
        <?php echo form_input( array(
																			'name' => 'image_file',
																			'id' => 'image_file',
																			'type' => 'file',
																			'class' => 'form-control'
																		)
															); ?>
      </div>
      <div class="form-group">
        <?php echo form_label('Bağlantılı Yazı','image_post_id');?>
        <?php echo form_error('image_post_id');?>
        <?php echo form_dropdown( 'image_post_id', $posts); ?>
      </div>
      <?php echo form_submit('submit', 'İmajı Ekle', 'class="btn btn-primary btn-lg btn-block"');?>
    <?php echo form_close();?>
  </div>
</div>
