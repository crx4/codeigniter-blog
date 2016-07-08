<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slides extends Admin_Controller
{

  function __construct()
  {
    parent::__construct();
    if(!$this->ion_auth->in_group('admin'))
    {
      $this->session->set_flashdata('message','Slayt ayarlarını görme yetkiniz yok!');
      redirect('admin','refresh');
    }
    $this->load->model('Slides_Model');
    $this->load->model('Posts_Model');
    $this->load->helper('form');
  }

  public function index()
  {
    $this->load->helper('text');
    $this->data['page_title'] = 'Slaytlar - Yönetim Paneli';
    $this->data['slides'] = $this->Slides_Model->get_slides();
    $this->render('admin/slides/list_slides_view');
  }

  public function create()
  {
    $this->data['page_title'] = 'Slayt Ekle - Yönetim Paneli';
    $this->load->library('form_validation');
		$this->data['posts'] = $this->Posts_Model->get_posts_dd();

    $this->form_validation->set_rules('slide_header','Başlık','trim|required');
    $this->form_validation->set_rules('slide_content','Slayt Özeti','trim|required');
    $this->form_validation->set_rules('slide_file','Slayt Dosyası','trim');
    $this->form_validation->set_rules('slide_post_id','Bağlantılı Yazı','trim|integer|required');

    if($this->form_validation->run()===FALSE)
    {
      $this->load->helper('form');
      $this->render('admin/slides/create_slide_view');
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

  		if ( ! $this->upload->do_upload('slide_file'))
  		{
  			$error = array('error' => $this->upload->display_errors());

        $this->load->helper('form');
        $this->session->set_flashdata('message','Dosya hatası: Lütfen slayt dosyasını gif, jpg veya png formatında seçin!');
        $this->render('admin/slides/create_slide_view');
  		}
  		else
  		{
  			$data = array('upload_data' => $this->upload->data());

  			$data = array(
  											'header' => $this->input->post('slide_header'),
  											'content' => $this->input->post('slide_content'),
  											'post_id' => $this->input->post('slide_post_id'),
  											'link' => $this->upload->data('file_name')
  										);

  			$this->Slides_Model->insert_slide($data);

        $this->session->set_flashdata('message','Slayt dosyası başarı bir şekilde eklendi!');
        redirect('admin/slides','refresh');
      }
    }
  }

  public function edit()
  {
    $id = $this->uri->segment(4);

    $this->data['page_title'] = 'Slayt Güncelle - Yönetim Paneli';
    $this->load->library('form_validation');
    $this->data['posts'] = $this->Posts_Model->get_posts_dd();
    $this->data['slide'] = $this->Slides_Model->get_slide($id);

    $this->form_validation->set_rules('slide_header','Başlık','trim|required');
    $this->form_validation->set_rules('slide_content','Slayt Özeti','trim|required');
    $this->form_validation->set_rules('slide_link','Slayt dosya adı','trim|required');
    $this->form_validation->set_rules('slide_file','Slayt Dosyası','trim');
    $this->form_validation->set_rules('slide_post_id','Bağlantılı Yazı','trim|integer|required');
    $this->form_validation->set_rules('slide_id','Slayt idsi','trim|integer|required');

    if($this->form_validation->run()===FALSE)
    {
      $this->load->helper('form');
      $this->render('admin/slides/edit_slide_view');
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

  		if ( ! $this->upload->do_upload('slide_file'))
  		{
  			$error = array('error' => $this->upload->display_errors());
      }
  		else
  		{
  			$data = array('upload_data' => $this->upload->data());
	      $filename = $this->upload->data('file_name');
      }

      $data = array(
                      'id' => $this->input->post('slide_id'),
                      'header' => $this->input->post('slide_header'),
                      'content' => $this->input->post('slide_content'),
                      'post_id' => $this->input->post('slide_post_id')
                    );

      if(isset($filename))
        $data['link'] = $filename;
			else
        $data['link'] = $this->input->post('slide_link');

      $this->Slides_Model->update_slide($data);

      $this->session->set_flashdata('message','Slayt dosyası başarı bir şekilde güncellendi!');
      redirect('admin/slides','refresh');
    }
  }

  public function delete($slide_id = NULL)
  {
    if(is_null($slide_id))
    {
      $this->session->set_flashdata('message','Silinecek slayt bulunamadı!');
    }
    else
    {
      $this->Slides_Model->delete_slide($slide_id);
      $this->session->set_flashdata('message','Slayt başarıyla silindi!');
    }
    redirect('admin/slides','refresh');
  }
}
