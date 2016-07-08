<?php defined('BASEPATH') OR exit('No direct script access allowed');

class About extends Admin_Controller
{

  function __construct()
  {
    parent::__construct();
    if(!$this->ion_auth->in_group('admin'))
    {
      $this->session->set_flashdata('message','Hakkında sayfasını görebilmek için yetkiniz yok!');
      redirect('admin','refresh');
    }
    $this->load->model('About_Model');
    $this->load->model('Categories_Model');
  }

  public function index()
  {
    $this->data['page_title'] = 'Hakkımda - Yönetim Paneli';
    $this->load->library('form_validation');
    $this->data['post'] = $this->About_Model->get_about();
		$this->data['categories'] = $this->Categories_Model->get_categories_dd();

    $this->form_validation->set_rules('post_header','Başlık','trim|required');
    $this->form_validation->set_rules('post_content','Gönderi','trim|required');
    $this->form_validation->set_rules('post_meta_keywords','Gönderi Meta Anahtar Kelimeleri','trim|required');
    $this->form_validation->set_rules('post_meta_description','Gönderi Meta Açıklaması','trim|required');
    $this->form_validation->set_rules('post_file','Gönderi Dosyası','trim');
    $this->form_validation->set_rules('post_id','Gönderi idsi','trim|integer|required');
    $this->form_validation->set_rules('post_category_id','Kategori','trim|integer|required');
    $this->form_validation->set_rules('post_user_id','Kullanıcı','trim|integer|required');

    if($this->form_validation->run()===FALSE)
    {
      $this->load->helper('form');
      $this->render('admin/about_view');
    }
    else
    {
  		$config['upload_path'] = './assets/uploads/';
  		$config['allowed_types']        = 'gif|jpg|png';
  		$config['overwrite']             = true;
  		$config['max_size']             = 2048000;
  		$config['max_width']            = 2048;
  		$config['max_height']           = 2048;
  		$config['encrypt_name'] = true;

  		$this->load->library('upload', $config);

  		if ( ! $this->upload->do_upload('post_file'))
  		{
  			$error = array('error' => $this->upload->display_errors());
      }
  		else
  		{
  			$data = array('upload_data' => $this->upload->data());
	      $filename = $this->upload->data('file_name');
      }

      $data = array(
                      'id' => $this->input->post('post_id'),
  										'header' => $this->input->post('post_header'),
                      'content' => $this->input->post('post_content'),
                      'meta_keywords' => $this->input->post('post_meta_keywords'),
                      'meta_description' => $this->input->post('post_meta_description'),
                      'type' => '2'
                    );

      if(isset($filename))
        $data['image_url'] = $filename;
			else
        $data['image_url'] = $this->input->post('post_file');

      $category_id = $this->input->post('post_category_id');
      $user_id = $this->input->post('post_user_id');

      $this->About_Model->update_about($data, $category_id, $user_id);

      $this->session->set_flashdata('message','Hakkımda Sayfası başarı bir şekilde güncellendi!');
      redirect('admin/about','refresh');
    }
  }
}
