<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="row featured-post-carousel text-center dosis">
  <?php foreach($slides as $slide) { ?>
    <div class="item post">
      <a href="<?php echo site_url('post/details/'.$slide->post_id); ?>">
        <img src="<?php echo site_url('assets/uploads/'.$slide->link); ?>"
             alt="" class="img-responsive main-bg">
      </a>
        <div class="post-content">
            <div class="container">
                <h5 class="post-meta">
                  <a>
                    <?php
      								$datestring = "%M %d, %Y";
      								$time = strtotime($slide->post_time);
      								echo mdate($datestring, $time);
      							?>
                  </a><i>tarihinde</i>
                </h5>
                <h2 class="post-title">
                  <a href="<?php echo site_url('post/details/'.$slide->post_id); ?>">
                    <?php echo word_limiter($slide->content, 20); ?>
                  </a>
                </h2>
                <a href="<?php echo site_url('post/details/'.$slide->post_id); ?>" class="btn btn-primary"><span>Devamını oku</span></a>
            </div>
        </div>
    </div>
  <?php } ?>>
</section>
