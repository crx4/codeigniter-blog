<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-sm-8 blog-posts">
  <?php foreach ($posts as $post) {  ?>
    <!--Post-->
    <article class="row post post-format-image has-media-wrap-sm dosis">
        <div class="media post-wrapper">
            <div class="media-left featured-content">
                <a href="<?php echo site_url('post/details/'.$post['id']); ?>">
                  <img src="<?php echo site_url('assets/uploads/'.$post['image_url']); ?>"
                       style="width: 260px; height: 260px;" alt="" class="img-responsive">
                </a>
            </div>
            <div class="media-body post-excerpt">
                <h5 class="post-meta">
                    <a class="date">
                      <?php
        								$datestring = "%M %d, %Y";
        								$time = strtotime($post['time']);
        								echo mdate($datestring, $time);
        							?>
                    </a>
                    <span class="post-author">
                      <a><?php echo $post['post_user_username']; ?></a>
                      <i>tarafından</i>
                    </span>
                </h5>
                <h3 class="post-title">
                  <a href="<?php echo site_url('post/details/'.$post['id']); ?>">
                    <?php echo $post['header']; ?>
                  </a>
                </h3>
                <p><?php echo word_limiter($post['content'], 30); ?><p>
                <footer class="row">
                    <h5 class="taxonomy">
                      <a href="<?php echo site_url('category/'.$post['post_category_id']); ?>">
                        <?php echo $post['post_category_name']; ?>
                      </a> <i>kategorisinde.</i>
                    </h5>
                    <!-- div class="response-count">
                      <img src="<?php echo site_url('assets/images/comment-icon-gray.png'); ?>" alt="">
                      5
                    </div -->
                </footer>
            </div>
        </div>
    </article>
  <?php } ?>
  <div class="media-body post-excerpt">
    <p style="text-align: center; font-size: 28px; letter-spacing: 5px;" class="taxonomy">
      <?php if(isset($links)) echo $links; ?>
    </p>
  </div>
</div>
