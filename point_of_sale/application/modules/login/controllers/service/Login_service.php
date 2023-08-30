
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_service extends MY_Controller
{
	protected $session;
	public function __construct()
	{
		parent::__construct();
		$this->session = (object)get_userdata(USER);

		$modelList = [
			'login/Login_model' => 'login',
		];

		$this->load->model($modelList);
	}


	public function index()
	{
		echo 'error';
	}

	public function login()
	{
		$this->login->username = $this->input->post('username', true);
		$this->login->password = $this->input->post('password', true);

		$response = $this->login->authentication();
		echo json_encode($response);
	}

	public function log_out()
	{
		$this->session->session_destroy();
		
	}

	public function refresh_session(){
		// $this->login->Branch = $this->input->post('Branch', true);
		// $response = $this->login->update_branch();
	
		// unset($this->session->Branch);
		set_userdata('Branch', "Cebu");
		// echo json_encode($this->session->Branch);
    } 

}
