<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends Admin_Controller
{

  function __construct()
  {
    parent::__construct();
    if(!$this->ion_auth->in_group('admin'))
    {
      $this->session->set_flashdata('message','Kategorileri görebilmek için yetkiniz yok!');
      redirect('admin','refresh');
    }
    $this->load->model('Categories_Model');
    $this->load->helper('form');
  }

  public function index()
  {
    $this->data['page_title'] = 'Kategoriler - Yönetim Paneli';
    $this->data['categories'] = $this->Categories_Model->get_categories();
    $this->render('admin/categories/list_categories_view');
  }

  public function create()
  {
    $this->data['page_title'] = 'Kategori Ekle - Yönetim Paneli';
    $this->load->library('form_validation');

    $this->form_validation->set_rules('category_name','Kategori Adı','trim|required');
    $this->form_validation->set_rules('category_description','Kategori Açıklaması','trim|required');

    if($this->form_validation->run()===FALSE)
    {
      $this->load->helper('form');
      $this->render('admin/categories/create_category_view');
    }
    else
    {
			$data = array(
											'name' => $this->input->post('category_name'),
											'description' => $this->input->post('category_description')
										);

			$this->Categories_Model->insert_category($data);

      $this->session->set_flashdata('message','Kategori başarılı bir şekilde eklendi!');
      redirect('admin/categories','refresh');
    }
  }

  public function edit()
  {
    $id = $this->uri->segment(4);

    $this->data['page_title'] = 'Kategori Güncelle - Yönetim Paneli';
    $this->load->library('form_validation');
    $this->data['category'] = $this->Categories_Model->get_category($id);

    $this->form_validation->set_rules('category_name','Kategori Adı','trim|required');
    $this->form_validation->set_rules('category_description','Kategori Açıklaması','trim|required');
    $this->form_validation->set_rules('category_id','Kategori idsi','trim|integer|required');

    if($this->form_validation->run()===FALSE)
    {
      $this->load->helper('form');
      $this->render('admin/categories/edit_category_view');
    }
    else
    {
      $data = array(
                      'id' => $this->input->post('category_id'),
											'name' => $this->input->post('category_name'),
											'description' => $this->input->post('category_description')
                    );

      $this->Categories_Model->update_category($data);

      $this->session->set_flashdata('message','Kategori başarılı bir şekilde güncellendi!');
      redirect('admin/categories','refresh');
    }
  }

  public function delete($category_id = NULL)
  {
    if(is_null($category_id))
    {
      $this->session->set_flashdata('message','Silinecek Kategori bulunamadı!');
    }
    else
    {
      $this->Categories_Model->delete_category($category_id);
      $this->session->set_flashdata('message','Kategori başarıyla silindi!');
    }
    redirect('admin/categories','refresh');
  }
}
