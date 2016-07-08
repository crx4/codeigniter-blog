<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  $this->load->view('templates/_parts/admin_master_header_view');
  $this->load->view('templates/_parts/admin_master_sidebar_view');
?>
  <?php if($this->ion_auth->logged_in()) { ?>
    <div id="page-wrapper">
      <div class="row">
  <?php } ?>
  <?php if($this->session->flashdata('message')) { ?>
    <div class="col-md-10 col-md-offset-1">
        <div style="padding-top:20px;">
          <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('message');?>
          </div>
        </div>
    </div>
  <?php } ?>

  <?php echo $the_view_content; ?>
  <?php if($this->ion_auth->logged_in()) { ?>
    </div><!-- /#page-wrapper -->
  <?php } ?>

<?php $this->load->view('templates/_parts/admin_master_footer_view'); ?>
