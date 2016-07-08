<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
  <div class="col-lg-12">
      <h1 class="page-header">Mesaj Detayı</h1>
  </div>
  <div class="col-lg-10 col-lg-offset-1">
    <?php if(!empty($message)) { ?>
      <div class="chat-panel panel panel-default" style="margin-bottom: 100px;">
          <div class="panel-heading">
              <i class="fa fa-comments fa-fw"></i>
              <strong>Mesaj Başlığı: </strong>
              <?php echo $message[0]['header']; ?>
          </div>
          <!-- /.panel-heading -->
          <div class="panel-body">
              <ul class="chat">
                  <li class="left clearfix">
                      <span class="chat-img pull-left">
                          <img src="<?php echo site_url('assets/images/default_user.png'); ?>"
                                width="50px" height="50px" alt="User Avatar" class="img-circle" />
                      </span>
                      <div class="chat-body clearfix">
                          <div class="header">
                              <strong class="primary-font"><?php echo $message[0]['fullname']; ?> - <?php echo $message[0]['email']; ?></strong>
                              <small class="pull-right text-muted">
                                  <i class="fa fa-clock-o fa-fw"></i> <?php echo timespan(strtotime($message[0]['time']),time()); ?>
                              </small>
                          </div>
                          <p>
                            <?php echo $message[0]['content']; ?>
                          </p>
                      </div>
                  </li>
                  <?php if(isset($message[0]['user_image_name'])) { ?>
                    <?php foreach($message as $msg) { ?>
                      <li class="right clearfix">
                          <span class="chat-img pull-right">
                              <img src="<?php echo site_url('assets/uploads/'.$msg['user_image_name']); ?>"
                                    width="50px" height="50px" alt="User Avatar" class="img-circle" />
                          </span>
                          <div class="chat-body clearfix">
                              <div class="header">
                                  <small class=" text-muted">
                                      <i class="fa fa-clock-o fa-fw"></i> <?php echo timespan(strtotime($msg['answer_time']),time()); ?></small>
                                  <strong class="pull-right primary-font"><?php echo $msg['user_username']; ?></strong>
                              </div>
                              <p>
                                <?php echo $msg['answer_content']; ?></strong>
                              </p>
                          </div>
                      </li>
                    <?php } ?>
                  <?php } ?>
              </ul>
          </div>
          <!-- /.panel-body -->
          <div class="panel-footer">
            <?php echo form_open('admin/messages/create',array('class'=>'form-horizontal'));?>
              <div class="input-group">
                  <input id="answer_content" name="answer_content" type="text" class="form-control input-sm"
                        placeholder="Cevabınızı buraya yazın..." />
                  <?php echo form_error('answer_content');?>
                  <?php echo form_hidden( array('user_id' => $this->ion_auth->get_user_id() ) ); ?>
                  <?php echo form_hidden( array('message_id' => $message[0]['id'] ) ); ?>
                  <span class="input-group-btn">
                    <?php echo form_submit('submit', 'Gönder', 'class="btn btn-warning btn-sm"');?>
                  </span>
              </div>
            <?php echo form_close();?>
          </div>
          <!-- /.panel-footer -->
      </div>
      <!-- /.panel .chat-panel -->
    <?php } ?>
  </div>
</div>
