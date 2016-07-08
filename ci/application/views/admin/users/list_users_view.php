<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Kullanıcılar</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
  <div class="col-lg-12">
		<?php echo anchor('admin/users/create', '<span class="glyphicon glyphicon-plus"></span> <strong>Yeni</strong>', array('class' => 'btn btn-success btn') ); ?>
  </div>
</div>
<div class="row">
  <div class="col-lg-10 col-lg-offset-1">
    <?php
    if(!empty($users))
    {
      echo '<table class="table table-hover table-bordered table-condensed">';
      echo '<tr class="active">
              <td>#</td>
              <td>Profil Resmi</td>
              <td>Kullanıcı Adı</td>
              <td>İsim</td>
              <td>E-posta</td>
              <td>Son Çevrimiçi</td>
              <td>İşlemler</td>
            </tr>';
      foreach($users as $user)
      {
        echo '<tr>';
        echo '<td>'.$user->id.'</td>';
        echo '<td><img src="'.site_url("assets/uploads/".$user->image_name).'" width=64 height=64></td>';
        echo '<td>'.$user->username.'</td><td>'.$user->first_name.' '.$user->last_name.'</td></td><td>'.$user->email.'</td><td>'.date('Y-m-d H:i:s', $user->last_login).'</td><td>';

        if($current_user->id != $user->id)
          echo anchor('admin/users/edit/'.$user->id,'<span class="glyphicon glyphicon-pencil"></span>',
                        array('class' => 'btn btn-primary')).
          ' '.anchor('admin/users/delete/'.$user->id,'<span class="glyphicon glyphicon-remove"></span>',
                        array('class' => 'btn btn-danger'));
        else echo '&nbsp;';
        echo '</td>';
        echo '</tr>';
      }
      echo '</table>';
    }
    ?>
    </div>
  </div>
</div>
