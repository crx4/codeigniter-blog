<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Hakkımda Sayfası</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
  <div class="col-lg-10 col-lg-offset-1">
    <?php echo form_open_multipart('',array('class'=>'form-horizontal'));?>
      <div class="form-group">
        <?php echo form_label('Başlık','post_header');?>
        <?php echo form_error('post_header');?>
        <?php echo form_input('post_header',set_value('post_header',$post->header),'class="form-control"');?>
      </div>
      <div class="form-group">
        <div class="media">
          <div class="media-left">
            <img class="media-object" src="<?php echo site_url('assets/uploads/'.$post->image_url); ?>"
                width="64px" height="64px">
          </div>
          <div class="media-body">
            <h6 class="media-heading"><?php echo form_label('Geçerli görsel','post_file');?></h6>
            <?php echo form_error('post_file');?>
            <?php echo form_input( array(
  																				'name' => 'post_file',
  																				'id' => 'post_file',
  																				'type' => 'file',
  																				'class' => 'form-control'
  																			)
  																); ?>
          </div>
        </div>
      </div>
      <div class="form-group">
        <?php echo form_label('Hakkımda','post_content');?>
        <?php echo form_error('post_content');?>
        <?php echo form_textarea( array(
																					'name' => 'post_content',
																					'id' => 'post_content',
                                          'class' => 'form-control',
																					'value' => $post->content
																				)
																	); ?>
      </div>
      <div class="form-group">
        <?php echo form_label('Meta Anahtar Kelimeler','post_meta_keywords');?>
        <?php echo form_error('post_meta_keywords');?>
        <?php echo form_input('post_meta_keywords',set_value('post_meta_keywords',$post->meta_keywords),'class="form-control"');?>
      </div>
      <div class="form-group">
        <?php echo form_label('Meta Açıklama','post_meta_description');?>
        <?php echo form_error('post_meta_description');?>
        <?php echo form_input('post_meta_description',set_value('post_meta_description',$post->meta_description),'class="form-control"');?>
      </div>
      <div class="form-group" style="visibility: hidden;">
        <?php echo form_label('Kategori','post_category_id'); ?>
        <?php echo form_error('post_category_id'); ?>
        <?php echo form_dropdown( 'post_category_id', $categories, $post->post_category_id); ?>
        <?php echo form_hidden( array('post_user_id' => $this->ion_auth->get_user_id() ) ); ?>
        <?php echo form_hidden( array('post_id' => $post->id ) ); ?>
        <?php echo form_hidden( array('post_file' => $post->image_url ) ); ?>
      </div>
      <?php echo form_submit('submit', 'Hakkımdayi Düzenle', 'class="btn btn-primary btn-lg btn-block"'); ?>
    <?php echo form_close();?>
  </div>
</div>
