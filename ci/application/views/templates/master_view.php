<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('templates/_parts/master_header_view'); ?>

<?php if($this->slider_show) $this->load->view('templates/_parts/master_slider_view'); ?>

<section class="row content-wrap">
    <div class="container">

      <?php
        if($this->session->flashdata('message')) {
          $message = $this->session->flashdata('message');
      ?>
        <div class="row">
          <div class="col-sm-8 blog-posts">
            <div class="alert alert-<?php echo $message['type']; ?>" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong><?php echo $message['header']; ?></strong>
              <?php echo $message['content']; ?>
            </div>
          </div>
        </div>
      <?php } ?>

      <div class="row">
        <?php echo $the_view_content;?>
        <?php if($this->sidebar_show) $this->load->view('templates/_parts/master_sidebar_view'); ?>
      </div>
    </div>
</section>

<?php $this->load->view('templates/_parts/master_footer_view'); ?>
