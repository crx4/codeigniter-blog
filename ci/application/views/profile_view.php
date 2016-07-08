<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-sm-12 single-post-contents">
  <article class="single-post-content v2 v2p1 row m0 post">
      <header class="row">
          <h2 class="post-title text-center">Profil Sayfası</h2>
      </header>
      <div class="post-content row">
          <div class="row m0">
              <div class="col-sm-4 post-author-about">
                  <div class="media">
                      <div class="media-left">
                        <a href="<?php echo site_url('profile'); ?>">
                          <img src="<?php echo site_url('assets/uploads/'.$current_user->image_name); ?>"
                            width="108px" height="108px" alt="" class="img-circle">
                        </a>
                      </div>
                      <div class="media-body">
                          <h3>
                            <a href="<?php echo site_url('profile'); ?>">
                              <?php echo $current_user->first_name.' '.$current_user->last_name; ?>
                            </a>
                          </h3>
                          <h5><?php echo $current_user->username; ?></h5>
                          <ul class="nav social-nav white">
                              <li><a href="<?php echo $options['twitter_url']; ?>"><i class="fa fa-twitter"></i></a></li>
                              <li><a href="<?php echo $options['facebook_url']; ?>"><i class="fa fa-facebook-official"></i></a></li>
                              <li><a href="<?php echo $options['gplus_url']; ?>"><i class="fa fa-google-plus"></i></a></li>
                              <li><a href="<?php echo $options['instagram_url']; ?>"><i class="fa fa-instagram"></i></a></li>
                              <li><?php echo safe_mailto($options['mail_email'], 'E-POSTA'); ?></li>
                          </ul>
                      </div>
                  </div>
                  <p>The word nature is derived from the Latin word natura, or "essential qualities, innate disposition", and in ancient times, literally meant "birth".</p>
              </div>
              <div class="col-sm-8">
                <h4>
                  <ul class="list-group">
                    <li class="list-group-item">
                      E-posta adresi:
                      <span class="label label-default pull-right"><?php echo $current_user->email; ?></span>
                    </li>
                    <li class="list-group-item">
                      Kayıt Tarihi:
                      <span class="label label-default pull-right">
                        <?php echo mdate('%h:%i - %d  %m %Y', $current_user->created_on); ?>
                      </span>
                    </li>
                    <li class="list-group-item">
                      Son Aktif Olma:
                      <span class="label label-default pull-right">
                        <?php echo mdate('%h:%i - %d  %m %Y', $current_user->last_login); ?>
                      </span>
                    </li>
                    <li class="list-group-item">
                      Şirket / Kurum:
                      <span class="label label-default pull-right"><?php echo $current_user->company; ?></span>
                    </li>
                    <li class="list-group-item">
                      Telefon:
                      <span class="label label-default pull-right"><?php echo $current_user->phone; ?></span>
                    </li>
                  </ul>
                </h4>
              </div>
              <a href="<?php echo site_url('admin/user/profile'); ?>" class="btn btn-primary btn-sm pull-right">
                <span>Düzenle</span>
              </a>
          </div>
          <br>

          <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading text-center">
              <h4>Son Yazılarım</h4>
            </div>
      			<?php
      			if(!empty($posts))
      			{
      				echo '<table class="table">';
      				echo '<tr class="active">
                      <td></td>
                      <td>Başlık</td>
                      <td>Gönderim Zamanı</td>
                      <td>Okunma Sayısı</td>
                      <td>Kategori</td>
                    </tr>';
      				foreach($posts as $post) {
      					echo '<tr>';
      					echo '<td>'.
      								'<img src="'.site_url("assets/uploads/".$post['image_url']).'" width=64 height=64></td><td>'.
      								anchor('post/details/'.$post['id'],$post['header']).'</td><td>'.
      								$post['time'].'</td><td>';
                echo $post['hit'].'</td><td>';
                echo $post['post_category_name'].'</td>';
      					echo '</tr>';
      				}
      				echo '</table>';
      			}
      			?>
          </div>
          <br>
  </article>
</div>
