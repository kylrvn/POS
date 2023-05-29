<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment_service extends MY_Controller
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
			'payment/service/Payment_services_model' => 'psModel'
		];
		$this->load->model($model_list);
	}


	public function save_payment(){
		$this->psModel->Order_id = $this->input->post("Order_id");
		$this->psModel->Amount_paid = $this->input->post("Amount_paid");
		$this->psModel->Payment_mode = $this->input->post("Payment_mode");

		$response = $this->psModel->save_payment();
		echo json_encode($response);
	}
}
