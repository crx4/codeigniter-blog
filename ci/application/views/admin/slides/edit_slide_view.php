<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Slayt Güncelle</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
  <div class="col-lg-10 col-lg-offset-1">
    <?php echo form_open_multipart('',array('class'=>'form-horizontal'));?>
      <div class="form-group">
        <?php echo form_label('Başlık','slide_header');?>
        <?php echo form_error('slide_header');?>
        <?php echo form_input('slide_header',set_value('slide_header',$slide->header),'class="form-control"');?>
      </div>
      <div class="form-group">
        <?php echo form_label('Slayt Açıklaması','slide_content');?>
        <?php echo form_error('slide_content');?>
        <?php echo form_input('slide_content',set_value('slide_header',$slide->content),'class="form-control"');?>
      </div>
      <div class="form-group">
        <?php echo form_label('Slayt Dosyası','slide_file');?>
        <?php echo form_error('slide_file');?>
        <?php echo form_input( array(
																			'name' => 'slide_file',
																			'id' => 'slide_file',
																			'type' => 'file',
																			'class' => 'form-control'
																		)
															); ?>
      </div>
      <div class="form-group">
        <?php echo form_label('Bağlantılı Yazı','slide_post_id');?>
        <?php echo form_error('slide_post_id');?>
        <?php
          echo form_dropdown( 'slide_post_id', $posts, $slide->post_id);
					echo form_hidden( array('slide_link' => $slide->link ) );
					echo form_hidden( array('slide_id' => $slide->id ) );
        ?>
      </div>
      <?php echo form_submit('submit', 'Slaytı Güncelle', 'class="btn btn-primary btn-lg btn-block"');?>
    <?php echo form_close();?>
  </div>
</div>
