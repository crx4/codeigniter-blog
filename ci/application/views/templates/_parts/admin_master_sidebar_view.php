<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if($this->ion_auth->logged_in()) { ?>
  <div class="navbar-default sidebar" role="navigation">
      <div class="sidebar-nav navbar-collapse">
          <ul class="nav" id="side-menu">
            <?php if(uri_string() !== 'admin/user/profile') { ?>
              <li class="sidebar-search">
                <div class="list-group">
                  <span class="list-group-item">
                    <h4 class="list-group-item-heading">
                      <div class="media">
                        <div class="media-left">
                            <img class="media-object" src="<?php echo site_url('assets/uploads/'.$current_user->image_name); ?>"
                              width="64px" height="64px">
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading" style="margin-top: 20px;"><?php echo $current_user->username; ?></h4>
                        </div>
                      </div>
                    </h4>
                    <br>
                    <p class="list-group-item-text">
                      <strong>E-posta: </strong><?php echo $current_user->email; ?>
                    </p>
                  </span>
                  <a href="<?php echo site_url('admin/user/profile'); ?>" class="list-group-item">
                    <h4 class="list-group-item-heading text-center">Profil Sayfası</h4>
                  </a>
                </div>
                <?php } ?>
              </li>
  						<li <?php if(uri_string() === 'admin/dashboard') echo 'class="active"'; ?>>
  								<?php echo anchor('admin/dashboard', '<i class="fa fa-dashboard fa-fw"></i> Başlangıç' ); ?>
  						</li>
              <?php if($this->ion_auth->is_admin()) { ?>
                <li>
                    <a href="#ayar"><i class="fa fa-cog fa-fw"></i> Site Ayarları<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
      								<li <?php if(uri_string() === 'admin/options') echo 'class="active"'; ?>>
      										<?php echo anchor('admin/options', 'Genel Ayarlar', array('class' => 'active' ) ); ?>
      								</li>
      								<li <?php if(uri_string() === 'admin/slides') echo 'class="active"'; ?>>
      										<?php echo anchor('admin/slides', 'Slayt Gösterisi'); ?>
      								</li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
              <?php } ?>
              <li>
                  <a href="#icerik"><i class="fa fa-database fa-fw"></i> İçerik<span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level">
    								<li <?php if(uri_string() === 'admin/images') echo 'class="active"'; ?>>
    										<?php echo anchor('admin/images', 'İmajlar'); ?>
    								</li>
    								<li <?php if(uri_string() === 'admin/posts') echo 'class="active"'; ?>>
    										<?php echo anchor('admin/posts', 'Yazılar'); ?>
    								</li>
                    <?php if($this->ion_auth->is_admin()) { ?>
      								<li <?php if(uri_string() === 'admin/about') echo 'class="active"'; ?>>
      										<?php echo anchor('admin/about  ', 'Hakkımda'); ?>
      								</li>
      								<li <?php if(uri_string() === 'admin/categories') echo 'class="active"'; ?>>
      										<?php echo anchor('admin/categories', 'Kategoriler'); ?>
      								</li>
                    <?php } ?>
                  </ul>
                  <!-- /.nav-second-level -->
              </li>
              <?php if($this->ion_auth->is_admin()) { ?>
                <li>
                    <a href="#ddd"><i class="fa fa-user-md fa-fw"></i> Kullanıcı İşlemleri<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
      								<li <?php if(uri_string() === 'admin/users') echo 'class="active"'; ?>>
      										<?php echo anchor('admin/users', 'Kullanıcılar'); ?>
      								</li>
      								<li <?php if(uri_string() === 'admin/groups') echo 'class="active"'; ?>>
      										<?php echo anchor('admin/groups', 'Kullanıcı Grupları'); ?>
      								</li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
    						<li <?php if(uri_string() === 'admin/messages') echo 'class="active"'; ?>>
    								<?php echo anchor('admin/messages', '<i class="fa fa-comments-o fa-fw"></i> Mesajlar' ); ?>
    						</li>
              <?php } ?>
          </ul>
      </div>
      <!-- /.sidebar-collapse -->
  </div>
  <!-- /.navbar-static-side -->
  </nav>
<?php } ?>
