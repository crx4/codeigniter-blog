<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class MY_Controller extends CI_Controller
    {
      protected $data = array();
      function __construct()
      {
        parent::__construct();
        $this->data['page_title'] = 'Blog Title';
        $this->data['before_head'] = '';
        $this->data['before_body'] ='';
      }

      protected function render($the_view = NULL, $template = 'master')
      {
        if($template == 'json' || $this->input->is_ajax_request())
        {
          header('Content-Type: application/json');
          echo json_encode($this->data);
        }
        else
        {
          $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view,$this->data, TRUE);;
          $this->load->view('templates/'.$template.'_view', $this->data);
        }
      }
    }

    class Admin_Controller extends MY_Controller
    {
      function __construct()
      {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->model('Messages_Model');
        $this->load->helper('text');
        if (!$this->ion_auth->logged_in())
        {
          //redirect them to the login page
          redirect('admin/user/login', 'refresh');
        }
        $this->data['current_user'] = $this->ion_auth->user()->row();
        $this->data['page_title'] = 'Blog Yönetim Paneli';
        $this->data['last_messages'] = $this->Messages_Model->get_last_messages();
        $this->data['new_messages_count'] = $this->Messages_Model->get_new_messages_count();
      }
      protected function render($the_view = NULL, $template = 'admin_master')
      {
        parent::render($the_view, $template);
      }
    }

    class Public_Controller extends MY_Controller
    {

      function __construct()
      {
        parent::__construct();
        $this->load->model('Welcome_Model');
        $this->load->model('Categories_Model');
        $this->load->library('ion_auth');
        $this->data['current_user'] = $this->ion_auth->user()->row();
   		  $this->data['categories'] = $this->Categories_Model->get_categories();
        $options = $this->Welcome_Model->get_options();
        $this->slider_show = false;
        $this->sidebar_show = true;
        $this->data['options'] = $options;
        $this->data['meta_keywords'] = $options['meta_keywords'];
        $this->data['meta_description'] = $options['meta_description'];

      }
    }
