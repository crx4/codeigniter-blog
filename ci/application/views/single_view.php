<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-md-8 single-post-contents">
  <article class="single-post-content row m0 post">
      <header class="row">
          <h5 class="post-meta">
              <a class="date">
                <?php
                  $datestring = "%M %d, %Y";
                  $time = strtotime($post->time);
                  echo mdate($datestring, $time);
                ?>
              </a>
              <span class="post-author">
                <a href="#"><?php echo $post->post_user_username; ?></a> <i>tarafından</i>
              </span>
          </h5>
          <h2 class="post-title">
            <?php echo $post->header; ?>
          </h2>
          <div class="row">
              <h5 class="taxonomy pull-left">
                <a href="#"><?php echo $post->post_category_name; ?></a> <i>kategorisinde</i>
              </h5>
          </div>
      </header>
      <div class="featured-content row m0">
          <a>
            <img src="<?php echo site_url('assets/uploads/'.$post->image_url); ?>" alt="" style="width: 750px; height: 422px;">
          </a>
      </div>
      <div class="post-content row">
        <?php echo $post->content; ?>
      </div>

      <!-- ul class="pager">
          <li>
              <h4>Previous Articles</h4>
              <h2 class="post-title"><a href="single2.html">Nature, in the broadest sense, is the natural...</a></h2>
              <h5 class="taxonomy pull-left"><i>in</i> <a href="#">image</a>, <a href="#">entertainment</a></h5>
          </li>
          <li>
              <h4>Next Articles</h4>
              <h2 class="post-title"><a href="single2.html">Nature, in the broadest sense, is the natural...</a></h2>
              <h5 class="taxonomy pull-left"><i>in</i> <a href="#">image</a>, <a href="#">entertainment</a></h5>
          </li>
      </ul -->
	  <?php if(!empty($comments)) { ?>
		  <div class="row m0 comments">
			  <h5 class="response-count">Yorumlar<a href="#comment-form" class="btn btn-primary pull-right"><span>yorum yap</span></a></h5>
			<?php foreach($comments as $comment) { ?>
			  <div class="media comment reply">
				  <div class="media-left">
					  <a href="#">
						<img src="<?php echo site_url('assets/uploads/default_user.png'); ?>"
						  alt="" class="img-circle" style="width: 68; height:68;">
					  </a>
				  </div>
				  <div class="media-body">
					  <h4><a><?php if(!empty($comment['comment_fullname'])) echo $comment['comment_fullname']; ?></a></h4>
					  <h5>
						<a class="date">
						  <?php
								if(!empty($comment['comment_time'])) {
								  $datestring = "%M %d, %Y";
								  $time = strtotime($comment['comment_time']);
								  echo mdate($datestring, $time);
								}
						  ?>
						</a>
					  </h5>
					  <p><?php if(!empty($comment['comment_content'])) echo $comment['comment_content']; ?><p>
				  </div>
			  </div>
			<?php } ?>
		  </div>
	  <?php } ?>

      <?php echo form_open('',array('role' => 'form', 'class' => 'comment-form row', 'id' => 'comment-form'));?>
          <div class="form-group col-sm-6">
            <?php
            echo form_label('Tam İsminiz*','fullname');
            echo form_error('fullname');
            echo form_input('fullname',set_value('fullname'),'class="form-control" placeholder="İsim soyisim"');
            ?>
          </div>
          <div class="form-group col-sm-6">
            <?php
            echo form_label('E-posta*','email');
            echo form_error('email');
            echo form_input('email','','class="form-control" placeholder="E-posta adresinizi buraya"');
            ?>
          </div>
          <div class="form-group col-sm-12">
            <?php
            echo form_label('Konu*','header');
            echo form_error('header');
            echo form_input('header','','class="form-control" placeholder="Konu başlığını buraya"');
            ?>
          </div>
          <div class="form-group col-sm-12">
            <?php
            echo form_label('Mesajınız*','content_comment');
            echo form_error('content_comment');
            echo form_textarea('content_comment','','class="form-control" id="content_comment" placeholder="Mesajınızı buraya yazın"');
            ?>
          </div>
          <div class="col-sm-12">
              <button type="submit" class="btn-primary"><span>Gönder</span></button>
              <h5 class="pull-right">* zorunlu alanlar.</h5>
          </div>
      </form>
      <br>
      <br>
  </article>
</div>
