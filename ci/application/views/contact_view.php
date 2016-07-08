<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h2 class="page-title text-center">İletişim</h2>
<div class="col-md-8 page-contents">
    <div class="row page-content">
        <div class="contents row">
            <h4>Mark Samder, lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</h4>

            <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            <br>
            <?php echo form_open('',array('role' => 'form', 'class' => 'contact-form row'));?>
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
                  echo form_label('Mesajınız*','content');
                  echo form_error('content');
                  echo form_textarea('content','','class="form-control" id="content" placeholder="Mesajınızı buraya yazın"');
                  ?>
                </div>
                <div class="col-sm-12">
                    <button type="submit" class="btn-primary"><span>Gönder</span></button>
                    <h5 class="pull-right">* zorunlu alanlar.</h5>
                </div>
            </form>
        </div>
    </div>
</div>
