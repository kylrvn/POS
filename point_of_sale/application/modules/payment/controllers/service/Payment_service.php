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
		$this->psModel->Incharge_ID = $this->session->ID;

		$response = $this->psModel->save_payment();
		echo json_encode($response);
	}

	public function update_details(){
		$this->psModel->Order_id = $this->input->post("Order_id");
		$this->psModel->Order_status = $this->input->post("Order_status");
		$this->psModel->Sewer = $this->input->post("Sewer");
		$this->psModel->Lay_artist = $this->input->post("Lay_artist");
		$this->psModel->Set_artist = $this->input->post("Set_artist");

		$response = $this->psModel->update_details();
		echo json_encode($response);
	}
}
