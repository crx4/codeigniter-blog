<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Gelen Mesajlar</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
  <div class="col-lg-10 col-lg-offset-1">
    <?php
      if(!empty($messages))
      {
        echo '<table class="table table-hover table-bordered table-condensed">';
        echo '<tr class="active"><td>#</td><td>Yazar e-posta</td></td><td>Tarih</td><td>Başlık</td><td>İçerik</td><td>Durum</td><td>İşlem</td></tr>';
        foreach($messages as $message) {
          if($message['is_read'] !== '1'){
            echo '<tr class="success">';
            $status = '<span class="label label-warning">Henüz okunmadı.</span>';
          }
          elseif($message['is_read'] === '1' && $message['is_answered'] !== '1'){
            echo '<tr class="info">';
            $status = '<span class="label label-warning">Henüz cevaplanmadı.</span>';
          }
          else{
            echo '<tr>';
            $status = '<span class="label label-success">Cevaplandı.</span>';
          }
          echo '<td>'.$message['id'].'</td><td>'.
                      $message['email'].'</td><td>'.
                      $message['time'].'</td><td>'.
                      $message['header'].'</td><td>'.
                      word_limiter($message['content'], 40).'</td><td>';
          echo $status;
          echo '</td><td>';
          echo anchor('admin/messages/details/'.$message['id'],
                      '<span class="glyphicon glyphicon-eye-open"></span>',
                      array('class' => 'btn btn-primary') );
          echo '&nbsp;';
          echo anchor('admin/messages/delete/'.$message['id'],
                      '<span class="glyphicon glyphicon-remove"></span>',
                      array(
                            'class' => 'btn btn-danger',
                            'onclick' => "return confirm('Onaylıyor musunuz?');"
                          )
                     );

          echo '</td></tr>';
        }
        echo '</table>';
      }
    ?>
  </div>
</div>
