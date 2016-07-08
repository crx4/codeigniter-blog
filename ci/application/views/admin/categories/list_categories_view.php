<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Kategoriler</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
  <div class="col-lg-12">
		<?php echo anchor('admin/categories/create', '<span class="glyphicon glyphicon-plus"></span> <strong>Yeni</strong>', array('class' => 'btn btn-success btn') ); ?>
  </div>
</div>
<div class="row">
  <div class="col-lg-10 col-lg-offset-1">
      <br>
			<?php
			if(!empty($categories))
			{
				echo '<table class="table table-hover table-bordered table-condensed">';
				echo '<tr class="active"><td>#</td><td>Kategori Adı</td></td><td>Kategori Açıklaması</td><td>İşlem</td></tr>';
				foreach($categories as $category) {
					echo '<tr>';
					echo '<td>'.$category['id'].'</td><td>'.
								$category['name'].'</td><td>'.
								$category['description'].'</td><td>';
					echo anchor('admin/categories/edit/'.$category['id'],
											'<span class="glyphicon glyphicon-pencil"></span>',
											array('class' => 'btn btn-primary') );
          echo '&nbsp;';
					echo anchor('admin/categories/delete/'.$category['id'],
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
