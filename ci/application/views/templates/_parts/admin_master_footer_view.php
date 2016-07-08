<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if($this->ion_auth->logged_in()) { ?>
    <div class="row" style="margin-top: 40px;">
    </div>
  </div>
  <!-- /#wrapper -->
<?php } ?>

<!-- jQuery -->
<script src="<?php echo site_url('assets/admin/bower_components/jquery/dist/jquery.min.js'); ?>"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo site_url('assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo site_url('assets/admin/bower_components/metisMenu/dist/metisMenu.min.js'); ?>"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo site_url('assets/admin/dist/js/sb-admin-2.js'); ?>"></script>
<script src="<?php echo site_url('assets/admin/ckeditor/ckeditor.js'); ?>"></script>
<script src="<?php echo site_url('assets/admin/ckeditor/adapters/jquery.js'); ?>"></script>
<script src="http://localhost:35729/livereload.js"></script>

<?php echo $before_body; ?>
<script>
  $(function() {
    $( 'textarea#post_content' ).ckeditor({width:'98%', height: '400px'});
  });
</script>
</body>

</html>
