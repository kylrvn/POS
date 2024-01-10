<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory_service extends MY_Controller
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
			'inventory/service/Inventory_services_model' => 'isModel'
		];
		$this->load->model($model_list);
	}
	
	public function add_existing_item(){
		$response = $this->isModel->add_e_inventory();
		echo json_encode($response);
	}

	public function add_new_item(){
		$response = $this->isModel->add_new_item();
		echo json_encode($response);
	}
}
