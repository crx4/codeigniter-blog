<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends My_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->library('ion_auth');
  }

  public function index()
  {
    redirect('admin/user/login', 'refresh');
  }

  public function login()
  {
    if($this->ion_auth->logged_in()) {
      $this->session->set_flashdata('message','Kullanıcı girişi yapıldı!');
      redirect('admin','refresh');
    }

    $this->data['page_title'] = 'Kullanıcı Girişi';
    if($this->input->post())
    {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('identity', 'Kullanıcı Adı', 'required');
      $this->form_validation->set_rules('password', 'Şifre', 'required');
      $this->form_validation->set_rules('remember','Beni Hatırla','integer');
      if($this->form_validation->run()===TRUE)
      {
        $remember = (bool) $this->input->post('remember');
        if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
        {
          redirect('admin', 'refresh');
        }
        else
        {
          $this->session->set_flashdata('message',$this->ion_auth->errors());
          redirect('admin/user/login', 'refresh');
        }
      }
    }
    $this->load->helper('form');
    $this->render('admin/login_view','admin_master');
  }

  public function logout()
  {
    $this->ion_auth->logout();
    redirect('admin/user/login', 'refresh');
  }

  public function profile()
  {
    if(!$this->ion_auth->logged_in())
    {
      $this->session->set_flashdata('message','Kullanıcı girişi yapılmadı!');
      redirect('admin','refresh');
    }

    $this->data['page_title'] = 'Kullanıcı Profili';
    $user = $this->ion_auth->user()->row();
    $this->data['user'] = $user;
    $this->data['current_user_menu'] = '';

    $this->load->library('form_validation');
    $this->form_validation->set_rules('first_name','First name','trim');
    $this->form_validation->set_rules('last_name','Last name','trim');
    $this->form_validation->set_rules('company','Company','trim');
    $this->form_validation->set_rules('phone','Phone','trim');

    if($this->form_validation->run()===FALSE)
    {
      $this->render('admin/user/profile_view','admin_master');
    }
    else
    {
      $new_data = array(
        'first_name' => $this->input->post('first_name'),
        'last_name' => $this->input->post('last_name'),
        'company' => $this->input->post('company'),
        'phone' => $this->input->post('phone')
      );
      if(strlen($this->input->post('password'))>=6) $new_data['password'] = $this->input->post('password');
      $this->ion_auth->update($user->id, $new_data);

      $this->session->set_flashdata('message', $this->ion_auth->messages());
      redirect('admin/user/profile','refresh');
    }
  }

	function register()
  {
    if($this->ion_auth->logged_in()) {
      $this->session->set_flashdata('message','Kullanıcı girişi yapıldı!');
      redirect('admin','refresh');
    }

    $this->data['page_title'] = 'Yeni Kullanıcı Kaydı';

    $tables = $this->config->item('tables','ion_auth');
    $identity_column = $this->config->item('identity','ion_auth');
    $this->data['identity_column'] = $identity_column;

    $this->load->library('form_validation');
    $this->form_validation->set_rules('first_name', 'İsim', 'required');
    $this->form_validation->set_rules('last_name', 'Soyisim', 'required');
    if($identity_column!=='email')
    {
        $this->form_validation->set_rules('identity','Kullanıcı Adı','required|is_unique['.$tables['users'].'.'.$identity_column.']');
        $this->form_validation->set_rules('email', 'E-posta', 'required|valid_email');
    }
    else
    {
        $this->form_validation->set_rules('email', 'E-posta', 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
    }
    $this->form_validation->set_rules('phone', 'Telefon', 'trim');
    $this->form_validation->set_rules('company', 'Şirket/ Kurum', 'trim');
    $this->form_validation->set_rules('password', 'Şifre', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
    $this->form_validation->set_rules('password_confirm', 'Şifre Doğrulama', 'required');

    if ($this->form_validation->run() == true)
    {
        $email    = strtolower($this->input->post('email'));
        $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
        $password = $this->input->post('password');

        $additional_data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name'  => $this->input->post('last_name'),
            'company'    => $this->input->post('company'),
            'phone'      => $this->input->post('phone'),
        );
    }
    if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data))
    {
        // check to see if we are creating the user
        // redirect them back to the admin page
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect("auth", 'refresh');
    }
    else
    {
        // display the create user form
        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        $this->render('admin/register_view','admin_master');
    }
  }

  public function forgot()
  {
    if($this->ion_auth->logged_in()) {
      $this->session->set_flashdata('message','Kullanıcı girişi yapıldı!');
      redirect('admin','refresh');
    }

    $this->data['page_title'] = 'Şifremi Unuttum';

    $this->load->library('form_validation');
		// setting validation rules by checking whether identity is username or email
		if($this->config->item('identity', 'ion_auth') != 'email' )
		{
		   $this->form_validation->set_rules('identity', 'Kullanıcı Adı', 'required');
		}
		else
		{
		   $this->form_validation->set_rules('identity', 'E-posta', 'required|valid_email');
		}


		if ($this->form_validation->run() == false)
		{
			$this->data['type'] = $this->config->item('identity','ion_auth');
			// setup the input
			$this->data['identity'] = array('name' => 'identity',
				'id' => 'identity',
			);

			// set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->render('admin/forgot_view', 'admin_master');
		}
		else
		{
			$identity_column = $this->config->item('identity','ion_auth');
			$identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();

			if(empty($identity)) {
    		if($this->config->item('identity', 'ion_auth') != 'email')
      	{
      		$this->ion_auth->set_error('forgot_password_identity_not_found');
      	}
      	else
      	{
      	   $this->ion_auth->set_error('forgot_password_email_not_found');
      	}

        $this->session->set_flashdata('message', $this->ion_auth->errors());
    		redirect("forgot", 'refresh');
  		}

			// run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten)
			{
				// if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("forgot", 'refresh');
			}
		}
  }

	public function reset($code = NULL)
	{
    if($this->ion_auth->logged_in()) {
      $this->session->set_flashdata('message','Kullanıcı girişi yapıldı!');
      redirect('admin','refresh');
    }

		if (!$code)
		{
			show_404();
		}

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
      $this->load->library('form_validation');
			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() == false)
			{
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;
        $this->data['user_id'] = $user->id;

				$this->render('admin/reset_view', 'admin_master');
			}
			else
			{
				if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))
				{
					$this->ion_auth->clear_forgotten_password_code($code);
					show_error($this->lang->line('error_csrf'));
				}
				else
				{
					$identity = $user->{$this->config->item('identity', 'ion_auth')};
					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));
					if ($change)
					{
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect('login', 'refresh');
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('reset' . $code, 'refresh');
					}
				}
			}
		}
		else
		{
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect('forgot', 'refresh');
		}
	}

	function activate($id, $code=false)
	{
    if($this->ion_auth->logged_in()) {
      $this->session->set_flashdata('message','Kullanıcı girişi yapıldı!');
      redirect('admin','refresh');
    }

		if ($code !== false)
		{
			$this->session->set_flashdata('message','Kullanıcı aktive edildi!');
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$this->session->set_flashdata('message','Kullanıcı aktive edilemedi!');
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect('admin', 'refresh');
		}
		else
		{
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect('admin/forgot', 'refresh');
		}
	}

	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}
