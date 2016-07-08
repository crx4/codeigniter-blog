<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Kategori Ekle</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
  <div class="col-lg-10 col-lg-offset-1">
      <?php echo form_open('',array('class'=>'form-horizontal'));?>
        <div class="form-group">
          <?php echo form_label('Kategori Adı','category_name');?>
          <?php echo form_error('category_name');?>
          <?php echo form_input('category_name','','class="form-control"');?>
        </div>
        <div class="form-group">
          <?php echo form_label('Kategori Açıklaması','category_description');?>
          <?php echo form_error('category_description');?>
          <?php echo form_input('category_description','','class="form-control"');?>
        </div>
        <?php echo form_submit('submit', 'Kategori Ekle', 'class="btn btn-primary btn-lg btn-block"');?>
      <?php echo form_close();?>
    </div>
  </div>
</div>
