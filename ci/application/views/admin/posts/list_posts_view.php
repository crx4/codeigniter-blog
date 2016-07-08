<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Gönderiler</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
  <div class="col-lg-12">
		<?php echo anchor('admin/posts/create', '<span class="glyphicon glyphicon-plus"></span> <strong>Yeni</strong>', array('class' => 'btn btn-success btn') ); ?>
  </div>
</div>
<div class="row">
  <div class="col-lg-10 col-lg-offset-1">
      <br>
			<?php
			if(!empty($posts))
			{
				echo '<table class="table table-hover table-bordered table-condensed">';
				echo '<tr class="active">
                <td>#</td>
                <td>Görüntü</td>
                <td>Başlık</td>
                <td>Açıklama</td>
                <td>Gönderim Zamanı</td>
                <td>Okunma Sayısı</td>
                <td>Kategori</td>
                <td>Yazar</td>
                <td>İşlem</td>
              </tr>';
				foreach($posts as $post) {
					echo '<tr>';
					echo '<td>'.$post['id'].'</td><td>'.
								'<img src="'.site_url("assets/uploads/".$post['image_url']).'" width=64 height=64></td><td>'.
								$post['header'].'</td><td>'.
								word_limiter($post['content'], 50).'</td><td>'.
								$post['time'].'</td><td>';
          echo $post['hit'].'</td><td>';
          echo $post['post_category_name'].'</td><td>';
          echo $post['post_user_username'].'</td><td>';
					echo anchor('admin/posts/edit/'.$post['id'],
											'<span class="glyphicon glyphicon-pencil"></span>',
											array('class' => 'btn btn-primary') );
          echo '&nbsp;';
					echo anchor('admin/posts/delete/'.$post['id'],
											'<span class="glyphicon glyphicon-remove"></span>',
											array(
														'class' => 'btn btn-danger',
														'onclick' => "return confirm('Onaylıyor musunuz?');"
													)
										 );
					echo '</td>';
					echo '</tr>';
				}
				echo '</table>';
			}
			?>
    </div>
  </div>
</div>
