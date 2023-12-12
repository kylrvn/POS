<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Deposit_service extends MY_Controller
{
	private $data = [];
	protected $session;
	public function __construct()
	{
		parent::__construct();
		$this->session = (object)get_userdata(USER);

		// if(is_empty_object($this->session)){
		// 	redirect(base_url().'login/authentication', 'refresh');
		// }

		$model_list = [
			'deposit/service/Deposit_services_model' => 'dsModel'
		];
		$this->load->model($model_list);
	}

	public function save(){
		$response = $this->dsModel->add_deposit();
		echo json_encode($response);
	}
}
