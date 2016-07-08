<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Images extends Admin_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Images_Model');
    $this->load->model('Posts_Model');
    $this->load->helper('form');
  }

  public function index()
  {
    $this->data['page_title'] = 'İmajlar - Yönetim Paneli';
    $this->data['images'] = $this->Images_Model->get_images();
    $this->render('admin/images/list_images_view');
  }

  public function create()
  {
    $this->data['page_title'] = 'İmaj Ekle - Yönetim Paneli';
    $this->load->library('form_validation');
		$this->data['posts'] = $this->Posts_Model->get_posts_dd();

    $this->form_validation->set_rules('image_alt','İmaj Özeti','trim|required');
    $this->form_validation->set_rules('image_file','İmaj Dosyası','trim');
    $this->form_validation->set_rules('image_post_id','Bağlantılı Yazı','trim|integer|required');

    if($this->form_validation->run()===FALSE)
    {
      $this->load->helper('form');
      $this->render('admin/images/create_image_view');
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

  		if ( ! $this->upload->do_upload('image_file'))
  		{
  			$error = array('error' => $this->upload->display_errors());

        $this->load->helper('form');
        $this->session->set_flashdata('message','Dosya hatası: Lütfen İmaj dosyasını gif, jpg veya png formatında seçin!');
        $this->render('admin/images/create_image_view');
  		}
  		else
  		{
  			$data = array('upload_data' => $this->upload->data());

  			$data = array(
  											'alt' => $this->input->post('image_alt'),
  											'post_id' => $this->input->post('image_post_id'),
  											'link' => $this->upload->data('file_name')
  										);

  			$this->Images_Model->insert_image($data);

        $this->session->set_flashdata('message','İmaj dosyası başarı bir şekilde eklendi!');
        redirect('admin/images','refresh');
      }
    }
  }

  public function edit()
  {
    $id = $this->uri->segment(4);

    $this->data['page_title'] = 'İmaj Güncelle - Yönetim Paneli';
    $this->load->library('form_validation');
    $this->data['posts'] = $this->Posts_Model->get_posts_dd();
    $this->data['image'] = $this->Images_Model->get_image($id);

    $this->form_validation->set_rules('image_alt','İmaj Özeti','trim|required');
    $this->form_validation->set_rules('image_link','İmaj dosya adı','trim|required');
    $this->form_validation->set_rules('image_file','İmaj Dosyası','trim');
    $this->form_validation->set_rules('image_post_id','Bağlantılı Yazı','trim|integer|required');
    $this->form_validation->set_rules('image_id','İmaj idsi','trim|integer|required');

    if($this->form_validation->run()===FALSE)
    {
      $this->load->helper('form');
      $this->render('admin/images/edit_image_view');
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

  		if ( ! $this->upload->do_upload('image_file'))
  		{
  			$error = array('error' => $this->upload->display_errors());
      }
  		else
  		{
  			$data = array('upload_data' => $this->upload->data());
	      $filename = $this->upload->data('file_name');
      }

      $data = array(
                      'id' => $this->input->post('image_id'),
                      'alt' => $this->input->post('image_alt'),
                      'post_id' => $this->input->post('image_post_id')
                    );

      if(isset($filename))
        $data['link'] = $filename;
			else
        $data['link'] = $this->input->post('image_link');

      $this->Images_Model->update_image($data);

      $this->session->set_flashdata('message','İmaj dosyası başarı bir şekilde güncellendi!');
      redirect('admin/images','refresh');
    }
  }

  public function delete($image_id = NULL)
  {
    if(!$this->ion_auth->in_group('admin'))
    {
      $this->session->set_flashdata('message','İmaj silebilmek için yetkiniz yok!');
      redirect('admin/images','refresh');
    }
    if(is_null($image_id))
    {
      $this->session->set_flashdata('message','Silinecek İmaj bulunamadı!');
    }
    else
    {
      $this->Images_Model->delete_image($image_id);
      $this->session->set_flashdata('message','İmaj başarıyla silindi!');
    }
    redirect('admin/images','refresh');
  }
}
