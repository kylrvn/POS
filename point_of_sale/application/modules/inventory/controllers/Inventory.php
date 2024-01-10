<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory extends MY_Controller
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
			'inventory/Inventory_model' => 'iModel',
		];
		$this->load->model($model_list);
	}

	/** load main page */
	public function index(){
		$this->data['inventory_items'] = $this->iModel->get_inventory_items();
		$this->data['content'] = 'index';
		$this->load->view('layout', $this->data);
	}

	public function load_inventory(){
		$this->data['inventory'] = $this->iModel->get_inventory();
		$this->data['content'] = 'grid/load_inventory';
		$this->load->view('layout', $this->data);
	}

	public function load_inventory_history(){
		$this->data['history'] = $this->iModel->get_history();
		$this->data['content'] = 'grid/load_inventory_history';
		$this->load->view('layout', $this->data);
	}

	// public function get_expenses() {
	// 	$this->eModel->d_from = $this->input->post("d_from");
	// 	$this->eModel->d_to = $this->input->post("d_to");
	// 	$this->eModel->branch_selected = $this->input->post("branch_selected"); //  BAGO NI SA

	// 	$this->data['expenses'] = $this->eModel->get_expenses();
	// 	$this->data['content'] = 'grid/load_expenses';
	// 	$this->load->view('layout', $this->data);
	// }

	// public function get_expense_details(){
	// 	$this->eModel->exp_id = $this->input->post("exp_id");
	// 	$this->data['exp_details'] = $this->eModel->get_expense_details();
	// 	$response = $this->eModel->get_expense_details();
	// 	echo json_encode($response);
	// }

}
