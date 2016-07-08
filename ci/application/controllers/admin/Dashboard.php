<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Dashboard_Model');
    $this->load->model('Options_Model');
    $this->load->helper('date');
  }

  public function index()
  {
    $this->data['page_title'] = 'Başlangıç - Yönetim Paneli';
		$this->data['copyright'] = $this->Options_Model->get_copyright();
		$this->data['user_count'] = $this->Dashboard_Model->get_user_count();
		$this->data['post_count'] = $this->Dashboard_Model->get_post_count();
		$this->data['message_count'] = $this->Dashboard_Model->get_message_count();
		$this->data['image_count'] = $this->Dashboard_Model->get_image_count();
		$this->data['group_count'] = $this->Dashboard_Model->get_group_count();
		$this->data['last_users'] = $this->Dashboard_Model->get_last_users();
		$this->data['user_groups'] = $this->Dashboard_Model->get_last_groups();
		$this->data['last_images'] = $this->Dashboard_Model->get_last_images();

    $this->render('admin/dashboard_view');
  }
}
