<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
  <!--Footer-->
  <footer class="row" id="footer">
      <div class="container">
          <div class="row top-footer">
              <div class="widget col-sm-3 widget-about">
                  <div class="row m0">
                    <h1 class="post-title">
                      <a href="<?php echo site_url(''); ?>" style="font-size: 24px"><?php echo $options['blog_description']; ?></a>
                    </h1>
                  </div>
              </div>
              <div class="widget col-sm-5 widget-menu">
                  <div class="row">
                      <ul class="nav column-menu white-bg">
                        <li <?php if(uri_string() === '') echo 'class="active"'; ?>>
                          <a href="<?php echo site_url(''); ?>">Anasayfa</a>
                        </li>
                        <li <?php if($this->uri->segment(1) === 'category') echo 'class="active dropdown"'; ?>>
                            <a href="#kategoriler" class="dropdown-toggle"
                               data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">
                               Kategoriler <span class="caret"></span>
                             </a>
                            <ul class="dropdown-menu">
    													<?php
    														foreach ($categories as $category) {
    															echo '<li>'.anchor(site_url('category/'.$category['id']), $category['description']).'</li>';
    														}
    													?>
                            </ul>
                        </li>
                        <li <?php if(uri_string() === '') echo 'class="active"'; ?>>
                          <a href="<?php echo site_url('gallery'); ?>">Galeri</a>
                        </li>
                      </ul>
                      <ul class="nav column-menu white-bg">
                        <li <?php if(uri_string() === '') echo 'class="active"'; ?>>
                          <a href="<?php echo site_url('about'); ?>">Hakkımda</a>
                        </li>
                        <li <?php if(uri_string() === '') echo 'class="active"'; ?>>
                          <a href="<?php echo site_url('contact'); ?>">İletişim</a>
                        </li>
                      </ul>
                  </div>
              </div>
              <div class="widget col-sm-4 widget-subscribe">
                  <h5 class="widget-title">Yazılarımdan haberdar olun:</h5>
                  <?php echo form_open('welcome/newsletter',array('class'=>'form-inline subscribe-form'));?>
                    <div class="form-group">
                      <input type="email" name="email" id="email" style="margin-bottom: 10px;" class="form-control" placeholder="E-posta adresiniz.">
                      <?php echo form_error('email'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm"><span>Gönder</span></button>
                  <?php echo form_close();?>
              </div>
          </div>
          <h5 class="copyright"><a href="<?php echo site_url(''); ?>"><?php echo $options['copyright']; ?></a></h5>
      </div>
  </footer>

  <!--========== jQuery (necessary for Bootstrap's JavaScript plugins) ==========-->
  <script src="<?php echo site_url('assets/js/jquery-2.2.0.min.js'); ?>"></script>
  <script src="<?php echo site_url('assets/js/bootstrap.min.js'); ?>"></script>
  <script src="<?php echo site_url('assets/vendors/owl-carousel/owl.carousel.min.js'); ?>"></script>
  <script src="<?php echo site_url('assets/vendors/magnific-popup/jquery.magnific-popup.min.js'); ?>"></script>
  <script src="<?php echo site_url('assets/vendors/instafeed/instafeed.min.js'); ?>"></script>
  <script src="<?php echo site_url('assets/vendors/imagesLoaded/imagesloaded.pkgd.min.js'); ?>"></script>
  <script src="<?php echo site_url('assets/vendors/isotope/isotope.pkgd.min.js'); ?>"></script>
  <script src="<?php echo site_url('assets/js/theme.js'); ?>"></script>
  <script src="<?php echo site_url('assets/admin/ckeditor/ckeditor.js'); ?>"></script>
  <script src="<?php echo site_url('assets/admin/ckeditor/adapters/jquery.js'); ?>"></script>
  <script src="http://localhost:35729/livereload.js"></script>

  <?php echo $before_body; ?>
  <script>
    window.setTimeout(function() {
        $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
            $(this).remove();
        });
    }, 6000);
  </script>
  <script>
    $(function() {
      $( 'textarea#content' ).ckeditor({width:'98%', height: '200px'});
    });
  </script>
</body>
</html>
