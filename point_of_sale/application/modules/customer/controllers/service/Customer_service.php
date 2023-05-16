<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer_service extends MY_Controller
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
			'customer/service/Customer_services_model' => 'csModel'
		];
		$this->load->model($model_list);
	}

	public function save(){
		$this->csModel->FName = $this->input->post("FName");
		$this->csModel->LName = $this->input->post("LName");
		$this->csModel->Company = $this->input->post("Company");
		$this->csModel->CNumber = $this->input->post("CNumber");
		$this->csModel->Branch = $this->input->post("Branch");

		$response = $this->csModel->save();
		echo json_encode($response);
	}

	public function update(){
		$this->csModel->ID = $this->input->post("ID");
		$this->csModel->FName = $this->input->post("FName");
		$this->csModel->LName = $this->input->post("LName");
		$this->csModel->Company = $this->input->post("Company");
		$this->csModel->CNumber = $this->input->post("CNumber");
		$this->csModel->Branch = $this->input->post("Branch");

		$response = $this->csModel->update();
		echo json_encode($response);
	}

}
