<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Blog Genel Ayarları</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
  <div class="col-lg-10 col-lg-offset-1">
    <?php echo form_open('admin/options/update', array('class'=>'form-horizontal'));?>
  		<?php foreach ($options as $option) { ?>
  	        <div class="form-group">
  						<?php echo form_label($option['nicename'],'password'); ?>: </span>
  	          <?php
  							echo form_input( array(
  																										'name' => $option['name'],
  																										'id' => $option['name'],
  																										'placeholder' => $option['value'],
  																										'value' => $option['value'],
  																										'class' => 'form-control'
  																									)
  														);
  	          ?>
  	        </div>
  		<?php } ?>
		<?php echo form_submit('submit', 'Ayarları Kaydet', 'class="btn btn-primary btn-lg btn-block"');?>
    <?php echo form_close();?>
  </div>
</div>
<!-- /.row -->
