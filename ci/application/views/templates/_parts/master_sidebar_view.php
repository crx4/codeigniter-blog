<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-sm-4 sidebar">
  <?php if($this->ion_auth->logged_in()) { ?>
    <!--Author Widget-->
    <aside class="row m0 widget-author widget">
        <div class="widget-author-inner row">
            <div class="author-avatar row">
              <a href="<?php echo site_url('profile'); ?>">
                <img src="<?php echo site_url('assets/uploads/'.$current_user->image_name); ?>"
                  width="108px" height="108px" alt="" class="img-circle">
              </a>
            </div>
            <a href="<?php echo site_url('profile'); ?>">
              <h2 class="author-name"><?php echo $current_user->first_name.' '.$current_user->last_name; ?></h2>
            </a>
            <h5 class="author-title"><?php echo $current_user->username; ?></h5>
            <p class="text-center"><?php echo $current_user->company; ?></p>
            <p class="text-center"><?php echo $current_user->phone; ?></p>
            <a href="<?php echo site_url('profile'); ?>" class="know-more">PROFİLE GİT</a>
            <br>
            <a href="<?php echo site_url('admin'); ?>" class="know-more">YÖNETİM PANELİ</a>
            <br>
            <br>
            <a href="<?php echo site_url('logout'); ?>" class="know-more">ÇIKIŞ YAP</a>
        </div>
    </aside>
  <?php } else { ?>
    <!--Author Widget-->
    <aside class="row m0 widget-author widget">
        <div class="widget-author-inner row">
          <a href="#"><h2 class="author-name"></h2></a>
          <?php echo form_open('login',array('role' => 'form'));?>
              <fieldset>
                <div class="form-group">
                  <?php echo form_label('Kullanıcı Adı','identity');?>
                  <?php echo form_error('identity');?>
                  <?php echo form_input('identity','','class="form-control"');?>
                </div>
                <div class="form-group">
                  <?php echo form_label('Şifre','password');?>
                  <?php echo form_error('password');?>
                  <?php echo form_password('password','','class="form-control"');?>
                </div>
                <div class="checkbox">
                  <label>
                    <?php //echo form_checkbox('remember','1',FALSE);?> <!-- Beni Hatırla -->
                  </label>
                  <span class="pull-right taxonomy">
                         <a href="<?php echo site_url('forgot'); ?>" > Şifremi unuttum ? </a>
                  </span>
                </div>
                <button type="submit" class="btn btn-primary btn-sm"><span>Giriş Yap</span></button>
                <a href="<?php echo site_url('register'); ?>" class="btn btn-primary btn-sm pull-right">
                  <span>Kayıt Ol</span>
                </a>
              </fieldset>
          <?php echo form_close();?>
        </div>
    </aside>
    <aside class="row m0 widget-author widget">
        <div class="widget-author-inner row">
          <h2 class="author-name">Kategoriler</h2>
          <ul class="nav column-menu white-bg">
            <?php
              foreach ($categories as $category) {
                if(uri_string() === 'category/'.$category['id']) echo '<li class="active">';
                else echo '<li>';
                echo anchor(site_url('category/'.$category['id']), $category['description']).'</li>';
              }
            ?>
          </ul>
        </div>
    </aside>
  <?php } ?>
    <!--Twitter Widget
    <aside class="row m0 widget widget-twitter">
        <div class="widget-twitter-inner">
            <h5 class="widget-meta"><i class="fa fa-twitter"></i>Twitter feed <a href="http://twitter.com/chivalricblog">@chivalricblog</a></h5>
            <div class="row tweet-texts">
                <p>Check out new post on my blog <a href="http://twitter.com/#natureshot">#natureshot</a> <a href="http://bit.ly/blog">http://bit.ly/blog</a></p>
            </div>
            <div class="row timepast">1 day ago</div>
        </div>
    </aside>-->
    <!--Instagram Widget
    <aside class="row m0 widget widget-instagram">
        <div class="widget-instagram-inner">
            <h5 class="widget-meta"><i class="fa fa-twitter"></i>instagram feed <a href="http://twitter.com/chivalricblog">@chivalricblog</a></h5>
            <div id="instafeed"></div>
        </div>
    </aside>-->
</div>
