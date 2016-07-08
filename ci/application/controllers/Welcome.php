<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Public_Controller {

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
	 	 $this->load->helper('text');
		 $this->load->library('pagination');
     $this->data['page_title'] = 'Anasayfa';
		 $this->slider_show = true;
		 $this->data['slides'] = $this->Welcome_Model->get_slides();

		 $config = array();
     $config["base_url"] = base_url() . "page";
     $config["total_rows"] = $this->Posts_Model->get_posts_count();
     $config["per_page"] = 4;
     $config["uri_segment"] = 2;

     $this->pagination->initialize($config);

     $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

		 $this->data['posts'] = $this->Posts_Model->get_limited_posts($config["per_page"], $page);
		 $this->data["links"] = $this->pagination->create_links();

		 $this->render('homepage_view');

     // $this->render(NULL, 'json');
		 // $this->render()
   }

	 public function category()
   {
	 	 $this->load->helper('text');
		 $category_id = $this->uri->segment(2);
     $this->data['page_title'] = 'Kategori';

		 $this->data['posts'] = $this->Posts_Model->get_category_posts($category_id);

		 $this->render('category_view');
   }

	 public function gallery()
   {
     $this->load->model('Images_Model');
     $this->data['page_title'] = 'Galeri';
		 $this->sidebar_show = false;
		 $this->data['images'] = $this->Images_Model->get_images();

		 $this->render('gallery_view');
   }

	 public function about()
   {
     $this->load->model('About_Model');
     $this->data['page_title'] = 'Hakkımda';
		 $this->data['about'] = $this->About_Model->get_about();

		 $this->render('about_view');
   }

	 public function contact()
   {
     $this->load->model('Messages_Model');
     $this->data['page_title'] = 'İletişim';
     $this->load->library('form_validation');

     $this->form_validation->set_rules('fullname','Tam İsminiz*','trim|required');
     $this->form_validation->set_rules('email','E-posta*','trim|required|valid_email');
		 $this->form_validation->set_rules('header','Konu*','trim|required');
		 $this->form_validation->set_rules('content','Mesajınız*','trim|required');

     if($this->form_validation->run()===FALSE)
     {
	 		 $this->render('contact_view');
     }
     else
     {
       $data = array(
         'fullname' => $this->input->post('fullname'),
         'email' => $this->input->post('email'),
         'header' => $this->input->post('header'),
         'content' => $this->input->post('content')
       );
			 $this->Messages_Model->insert_user_message($data);

				$config = Array(
												'protocol' => 'smtp',
												'smtp_host' => $options['mail_url'],
												'wordwrap' => TRUE,
												'mailtype' => "html",
												'charset' => "utf-8",
												'smtp_port' => $options['mail_port'],
												'smtp_user' => $options['mail_email'],
												'smtp_pass' => $options['mail_password']
											);
				$this->load->library('email', $config);
				$this->email->initialize($config);

				$this->email->from($options['mail_email']);
				$this->email->to($data['email']);
				$this->email->subject('Mesajınız Alındı: '.$data['header']);
				$message = 'Mesajınız başarı ile alındı: '.$data['content'].'';
				$this->email->message($message);

				if($this->email->send()) {
					 $this->session->set_flashdata('message',
					 									array(
																	 'type' => 'info',
																	 'header' => 'Başarılı!',
																	 'content' => 'Mesajınız başarıyla kaydedildi.
																	 							Lütfen e-posta adresinizi kontrol edin.',
																	) );
		       redirect('contact','refresh');
				} else {
				  print_r($this->email->print_debugger());
				}
     }
   }

	 public function profile()
   {
     $this->data['page_title'] = 'Profil Sayfası';
		 $this->sidebar_show = false;
		 $this->data['posts'] = $this->Posts_Model->get_user_posts($this->data['current_user']->id);

		 $this->render('profile_view');
   }

	 public function newsletter()
   {
     $this->load->library('form_validation');
		 $this->form_validation->set_rules('email', 'E-posta', 'required|valid_email|is_unique[newsletter_emails.email]');

		 if ($this->form_validation->run() == false)
		 {
			 $this->session->set_flashdata('message', array(
																										'type' => 'danger',
																										'header' => 'Dikkat!',
																										'content' => 'Bu e-posta listemizde ekli.',
																									 ) );
			 redirect('','refresh');
		 }
		 else
		 {
				$new_data = array( 'email' => strtolower($this->input->post('email')) );
				$this->Welcome_Model->add_newsletter_email($new_data);
				$this->session->set_flashdata('message', array(
																										 'type' => 'info',
																										 'header' => 'Başarılı!',
																										 'content' => 'E-posta listemize eklendiniz.',
																										) );
				redirect('','refresh');
		 }
   }
}
