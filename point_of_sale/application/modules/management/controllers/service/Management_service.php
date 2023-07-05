<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Management_service extends MY_Controller
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
			'management/service/Management_services_model' => 'msModel'
		];
		$this->load->model($model_list);
	}

	public function save_list(){
		$this->msModel->List_name = $this->input->post("List_name");
		$this->msModel->List_category = $this->input->post("List_category");

		$response = $this->msModel->save_list();
		echo json_encode($response);
	}

	public function save_user(){
		$this->msModel->FName = $this->input->post("FName");
		$this->msModel->LName = $this->input->post("LName");
		$this->msModel->Username = $this->input->post("Username");
		$this->msModel->Role = $this->input->post("Role");
		$this->msModel->Role_name = $this->input->post("Role_name");
		$this->msModel->Branch = $this->input->post("Branch");
		$response = $this->msModel->save_user();
		echo json_encode($response);
	}

	public function update_user(){
		$this->msModel->U_ID = $this->input->post("U_ID");
		$this->msModel->FName = $this->input->post("FName");
		$this->msModel->LName = $this->input->post("LName");
		$this->msModel->Username = $this->input->post("Username");
		$this->msModel->Role = $this->input->post("Role");
		$this->msModel->Role_name = $this->input->post("Role_name");
		$this->msModel->Branch = $this->input->post("Branch");
		$response = $this->msModel->update_user();
		echo json_encode($response);
	}

	public function reset(){
		$this->msModel->U_ID = $this->input->post("U_ID");
		$response = $this->msModel->reset();
		echo json_encode($response);
	}

}
