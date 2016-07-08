<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Kullanıcı Grupları</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
  <div class="col-lg-12">
		<?php echo anchor('admin/groups/create', '<span class="glyphicon glyphicon-plus"></span> <strong>Yeni</strong>', array('class' => 'btn btn-success btn') ); ?>
  </div>
</div>
<div class="row">
  <div class="col-lg-10 col-lg-offset-1">
      <?php
      if(!empty($groups))
      {
        echo '<table class="table table-hover table-bordered table-condensed">';
        echo '<tr class="active"><td>#</td><td>Grup Adı</td></td><td>Grup Açıklaması</td><td>İşlemler</td></tr>';
        foreach($groups as $group)
        {
          echo '<tr>';
          echo '<td>'.$group->id.'</td><td>'.
          anchor('admin/users/index/'.$group->id,$group->name).'</td><td>'.$group->description.'</td><td>'.
          anchor('admin/groups/edit/'.$group->id,'<span class="glyphicon glyphicon-pencil"></span>',
          array('class' => 'btn btn-primary'));
          if(!in_array($group->name, array('admin','members')))
          echo ' '.anchor('admin/groups/delete/'.$group->id,'<span class="glyphicon glyphicon-remove"></span>',
          array('class' => 'btn btn-danger'));
          echo '</td>';
          echo '</tr>';
        }
        echo '</table>';
      }
      ?>
    </div>
  </div>
</div>
