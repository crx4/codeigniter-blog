<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends Admin_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Posts_Model');
    $this->load->model('Categories_Model');
    $this->load->helper('form');
    $this->load->helper('text');
  }

  public function index()
  {
    $this->data['page_title'] = 'Gönderiler - Yönetim Paneli';
    $this->data['posts'] = $this->Posts_Model->get_posts();
    $this->render('admin/posts/list_posts_view');
  }

  public function create()
  {
    $this->data['page_title'] = 'Gönderi Ekle - Yönetim Paneli';
    $this->load->library('form_validation');
		$this->data['categories'] = $this->Categories_Model->get_categories_dd();

    $this->form_validation->set_rules('post_header','Başlık','trim|required');
    $this->form_validation->set_rules('post_content','Gönderi','trim|required');
    $this->form_validation->set_rules('post_meta_keywords','Gönderi Meta Anahtar Kelimeleri','trim|required');
    $this->form_validation->set_rules('post_meta_description','Gönderi Meta Açıklaması','trim|required');
    $this->form_validation->set_rules('post_file','Gönderi Dosyası','trim');
    $this->form_validation->set_rules('post_category_id','Kategori','trim|integer|required');
    $this->form_validation->set_rules('post_user_id','Kullanıcı','trim|integer|required');

    if($this->form_validation->run()===FALSE)
    {
      $this->load->helper('form');
      $this->render('admin/posts/create_post_view');
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

        $this->load->helper('form');
        $this->session->set_flashdata('message','Dosya hatası: Lütfen gönderi medyasını gif, jpg veya png formatında seçin!');
        $this->render('admin/posts/create_post_view');
  		}
  		else
  		{
  			$data = array('upload_data' => $this->upload->data());

  			$data = array(
  											'header' => $this->input->post('post_header'),
                        'content' => $this->input->post('post_content'),
                        'meta_keywords' => $this->input->post('post_meta_keywords'),
                        'meta_description' => $this->input->post('post_meta_description'),
  											'image_url' => $this->upload->data('file_name')
  										);
        $category_id = $this->input->post('post_category_id');
        $user_id = $this->input->post('post_user_id');

  			$this->Posts_Model->insert_post($data, $category_id, $user_id);

        $this->session->set_flashdata('message','Gönderi başarı bir şekilde eklendi!');
        redirect('admin/posts','refresh');
      }
    }
  }

  public function edit()
  {
    $id = $this->uri->segment(4);

    $this->data['page_title'] = 'Gönderi Güncelle - Yönetim Paneli';
    $this->load->library('form_validation');
    $this->data['post'] = $this->Posts_Model->get_post($id);
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
      $this->render('admin/posts/edit_post_view');
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
                      'meta_description' => $this->input->post('post_meta_description')
                    );

      if(isset($filename))
        $data['image_url'] = $filename;
			else
        $data['image_url'] = $this->input->post('post_file');

      $category_id = $this->input->post('post_category_id');
      $user_id = $this->input->post('post_user_id');

      $this->Posts_Model->update_post($data, $category_id, $user_id);

      $this->session->set_flashdata('message','Gönderi dosyası başarı bir şekilde güncellendi!');
      redirect('admin/posts','refresh');
    }
  }

  public function delete($post_id = NULL)
  {
    if(!$this->ion_auth->in_group('admin'))
    {
      $this->session->set_flashdata('message','Gönderi silebilmek için yetkiniz yok!');
      redirect('admin/posts','refresh');
    }
    if(is_null($post_id))
    {
      $this->session->set_flashdata('message','Silinecek slayt bulunamadı!');
    }
    else
    {
      $this->Posts_Model->delete_post($post_id);
      $this->session->set_flashdata('message','Gönderi başarıyla silindi!');
    }
    redirect('admin/posts','refresh');
  }
}
