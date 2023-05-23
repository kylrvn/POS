<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Create_order_service extends MY_Controller
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
			'create_order/service/Create_order_services_model' => 'cosModel'
		];
		$this->load->model($model_list);
	}

	public function save_order(){
		$this->cosModel->ID = $this->input->post("ID");
		$this->cosModel->Qty = $this->input->post("Qty");
		$this->cosModel->Total = $this->input->post("Total");
		$this->cosModel->B_date = $this->input->post("B_date");
		$this->cosModel->Item_id = $this->input->post("Item_id");
		$this->cosModel->Item_qty = $this->input->post("Item_qty");
		$this->cosModel->Item_amount = $this->input->post("Item_amount");
		$this->cosModel->D_date = $this->input->post("D_date");
		$this->cosModel->D_notes = $this->input->post("D_notes");
		$this->cosModel->B_notes = $this->input->post("B_notes");
		$this->cosModel->Freebies = $this->input->post("Freebies");
		$this->cosModel->Subtotal = $this->input->post("Subtotal");
		$this->cosModel->Discount = $this->input->post("Discount");


		$response = $this->cosModel->save_order();
		echo json_encode($response);
	}

}
