<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h2 class="page-title text-center"><?php echo $about->header; ?></h2>
<div class="col-md-8 page-contents">
    <div class="row page-content">
      <img src="<?php echo site_url('assets/uploads/'.$about->image_url); ?>"
           width="750px" height="563px" alt="" class="img-responsive">
      <?php echo $about->content; ?>
    </div>
</div>
