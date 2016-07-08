<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends Admin_Controller
{

  function __construct()
  {
    parent::__construct();
    if(!$this->ion_auth->in_group('admin'))
    {
      $this->session->set_flashdata('message','Mesaj kutusunu görebilmek için yetkiniz yok!');
      redirect('admin','refresh');
    }
    $this->load->model('Messages_Model');
  }

  public function index()
  {
    $this->load->helper('text');
    $this->data['page_title'] = 'Mesaj Kutusu - Yönetim Paneli';
    $this->data['messages'] = $this->Messages_Model->get_messages();
    $this->render('admin/messages/list_messages_view');
  }

  public function details()
  {
    $this->load->helper('form');

    $id = $this->uri->segment(4);
    $this->data['page_title'] = 'Mesaj Detayları - Yönetim Paneli';
    $this->data['message'] = $this->Messages_Model->mark_as_read($id);
    $this->data['message'] = $this->Messages_Model->get_message($id);
    $this->render('admin/messages/message_details_view');
  }

  public function create()
  {
    $this->load->helper('form');

    $this->load->library('form_validation');
    $this->form_validation->set_rules('answer_content','Cevap metni','trim|required');
    $this->form_validation->set_rules('user_id','Kullanıcı id','trim|integer|required');
    $this->form_validation->set_rules('message_id','Grup id','trim|integer|required');

    if($this->form_validation->run()===FALSE)
    {
      $this->session->set_flashdata('message', 'Lütfen formu eksiksiz doldurun.');
      redirect('admin/messages/details/'.$this->input->post('message_id'), 'refresh');
    }
    else
    {
      $data['answer_content'] = $this->input->post('answer_content');
      $data['user_id'] = $this->input->post('user_id');
      $data['message_id'] = $this->input->post('message_id');

      $this->Messages_Model->insert_message($data);
      $this->data['message'] = $this->Messages_Model->mark_as_answered($this->input->post('message_id'));
      $this->session->set_flashdata('message','Mesaj iletildi.');
      redirect('admin/messages/details/'.$this->input->post('message_id'), 'refresh');
    }
  }

  public function delete()
  {
    $id = $this->uri->segment(4);
    if(is_null($id))
    {
      $this->session->set_flashdata('message','Silinecek öğeye ulaşılamıyor!');
    }
    else
    {
      $this->Messages_Model->delete_answers($id);
      $this->session->set_flashdata('message','Başarıyla silindi!');
    }
    redirect('admin/messages','refresh');
  }
}
