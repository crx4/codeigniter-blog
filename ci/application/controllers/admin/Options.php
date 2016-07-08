<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Options extends Admin_Controller
{

  function __construct()
  {
    parent::__construct();
    if(!$this->ion_auth->in_group('admin'))
    {
      $this->session->set_flashdata('message','Genel Ayar Sayfasını  görebilmek için yetkiniz yok!');
      redirect('admin','refresh');
    }
    $this->load->model('Options_Model');
    $this->load->helper('form');
  }

  public function index()
  {
    $this->data['page_title'] = 'Blog Ayarları - Yönetim Paneli';
    $this->data['options'] = $this->Options_Model->get_options();
    $this->render('admin/options_view');
  }

	public function update()
	{
		$data = array(
										'blog_name' => $this->input->post('blog_name'),
										'blog_description' => $this->input->post('blog_description'),
										'mail_url' => $this->input->post('mail_url'),
										'mail_email' => $this->input->post('mail_email'),
										'mail_password' => $this->input->post('mail_password'),
										'mail_port' => $this->input->post('mail_port'),
										'facebook_url' => $this->input->post('facebook_url'),
										'twitter_url' => $this->input->post('twitter_url'),
										'github_url' => $this->input->post('github_url'),
										'gplus_url' => $this->input->post('gplus_url'),
										'copyright' => $this->input->post('copyright'),
										'meta_description' => $this->input->post('meta_description'),
										'meta_keywords' => $this->input->post('meta_keywords')
									);

		$this->Options_Model->update_options($data);

    $this->session->set_flashdata('message','Ayarlar başarıyla güncellendi!');
		redirect('admin/options', 'refresh');
	}
}
