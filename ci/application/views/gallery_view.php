<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h2 class="page-title text-center">Galeri</h2>
<div class="blog-posts">
  <article class="row post post6 post-format-gallery">
      <div class="media post-wrapper">
          <div class="media-body post-excerpt">
              <h2 class="taxonomy"><a href="">GALERİ</a></h2>
              <h3 class="post-title"><a href="<?php echo site_url('gallery'); ?>">İmajlar</a></h3>
              <p>Gönderiler ile ilişkili imaj dosyaları.</p>
          </div>
          <div class="media-right featured-content">
              <div class="gallery-of-post2">
                <?php foreach ($images as $image) {  ?>
                  <div class="item">
                    <a href="<?php echo site_url('post/details/'.$image['post_id']); ?>">
                      <img src="<?php echo site_url('assets/uploads/'.$image['link']); ?>"
                           width="380px" height="380px" alt="<?php echo $image['alt']; ?>">
                    </a>
                  </div>
                <?php } ?>
              </div>
          </div>
      </div>
  </article>
  <article class="row post post6 post-format-text">
      <div class="row m0 post-wrapper">
          <div class="row m0 post-excerpt">
          </div>
      </div>
  </article>
</div>
