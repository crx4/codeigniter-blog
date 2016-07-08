<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends Public_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

   function __construct()
   {
     parent::__construct();
		 $this->load->helper('form');
		 $this->load->helper('date');
		 $this->load->model('Posts_Model');
   }

	 public function index()
   {
		 redirect('', 'refresh');
   }

	 public function details()
   {
		 $post_id = $this->uri->segment(3);
		 $this->data['post'] = $this->Posts_Model->get_post($post_id);
		 $this->data['comments'] = $this->Posts_Model->get_comments($post_id);
     $this->data['page_title'] = $this->data['post']->header;
		 $this->data['meta_keywords'] = $this->data['post']->meta_keywords;
		 $this->data['meta_description'] = $this->data['post']->meta_description;

     $this->load->library('form_validation');

     $this->form_validation->set_rules('fullname','Tam İsminiz*','trim|required');
     $this->form_validation->set_rules('email','E-posta*','trim|required|valid_email');
		 $this->form_validation->set_rules('header','Konu*','trim|required');
		 $this->form_validation->set_rules('content_comment','Mesajınız*','trim|required|max_length[200]');

     if($this->form_validation->run()===FALSE)
     {
	 		 $this->render('single_view');
     }
     else
     {
       $data = array(
         'fullname' => $this->input->post('fullname'),
         'email' => $this->input->post('email'),
         'header' => $this->input->post('header'),
				 'content' => $this->input->post('content_comment')
       );

			 $this->Posts_Model->insert_post_comment($data, $post_id);

			 $this->session->set_flashdata('message',
			 									array(
															 'type' => 'info',
															 'header' => 'Başarılı!',
															 'content' => 'Yorumunuz başarıyla kaydedildi.',
															) );
       redirect('post/details/'.$post_id,'refresh');
     }
   }
}
