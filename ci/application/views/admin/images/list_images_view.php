<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">İmajlar</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
  <div class="col-lg-12">
		<?php echo anchor('admin/images/create', '<span class="glyphicon glyphicon-plus"></span> <strong>Yeni</strong>', array('class' => 'btn btn-success btn') ); ?>
  </div>
</div>
<div class="row">
  <div class="col-lg-10 col-lg-offset-1">
      <br>
			<?php
			if(!empty($images))
			{
				echo '<table class="table table-hover table-bordered table-condensed">';
				echo '<tr class="active"><td>#</td><td>Görüntü</td></td><td>Açıklama</td><td>Dosya Adı</td><td>Yazı Bağı</td><td>İşlem</td></tr>';
				foreach($images as $image) {
					echo '<tr>';
					echo '<td>'.$image['id'].'</td><td>'.
								'<img src="'.site_url("assets/uploads/".$image['link']).'" width=64 height=64></td><td>'.
								$image['alt'].'</td><td>'.
								$image['link'].'</td><td>';
 					echo $image['post_id'].'</td><td>';
					echo anchor('admin/images/edit/'.$image['id'],
											'<span class="glyphicon glyphicon-pencil"></span>',
											array('class' => 'btn btn-primary') );
          echo '&nbsp;';
					echo anchor('admin/images/delete/'.$image['id'],
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
