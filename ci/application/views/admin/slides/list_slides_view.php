<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Slaytlar</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
  <div class="col-lg-12">
		<?php echo anchor('admin/slides/create', '<span class="glyphicon glyphicon-plus"></span> <strong>Yeni</strong>', array('class' => 'btn btn-success btn') ); ?>
  </div>
</div>
<div class="row">
  <div class="col-lg-10 col-lg-offset-1">
    <br>
		<?php
		if(!empty($slides))
		{
			echo '<table class="table table-hover table-bordered table-condensed">';
			echo '<tr class="active"><td>#</td><td>Görüntü</td><td>Başlık</td></td><td>Açıklama</td><td>Yazı Bağı</td><td>İşlem</td></tr>';
			foreach($slides as $slide) {
				echo '<tr>';
				echo '<td>'.$slide['id'].'</td><td>'.
							'<img src="'.site_url("assets/uploads/".$slide['link']).'" width=64 height=64></td><td>'.
							$slide['header'].'</td><td>'.
							word_limiter($slide['content'], 10).'</td><td>';
					echo $slide['post_id'].'</td><td>';
				echo anchor('admin/slides/edit/'.$slide['id'],
										'<span class="glyphicon glyphicon-pencil"></span>',
										array('class' => 'btn btn-primary') );
        echo '&nbsp;';
				echo anchor('admin/slides/delete/'.$slide['id'],
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
