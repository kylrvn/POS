<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Expense extends MY_Controller
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
			'expense/Expense_model' => 'eModel',
		];
		$this->load->model($model_list);
	}

	/** load main page */
	public function index()
	{
		// if (
		// 	!check_permission($this->session->Role, ['Admin'])
		// ) {
		// 	redirect(base_url() . 'customer', 'refresh');
		// }
		

	// 	$this->data['session'] =  $this->session;
	// 	$this->data['sales'] =  $this->rModel->get_sales();
	// 	$this->data['cash'] =  $this->rModel->get_cash();
	// 	$this->data['online'] =  $this->rModel->get_online();
		
	// 	$this->data['content'] = 'sales_report';
	// 	$this->load->view('layout', $this->data);
	// $this->coModel->ID = $this->input->get('custid');
	$this->data['branch'] = $this->eModel->get_branch();
	// $this->data['expenses'] = $this->eModel->get_expenses();
	$this->data['content'] = 'index';
	$this->load->view('layout', $this->data);
	}

	public function get_expenses() {
		$this->eModel->d_from = $this->input->post("d_from");
		$this->eModel->d_to = $this->input->post("d_to");
		$this->eModel->branch = $this->input->post("branch"); //  BAGO NI SA

		$this->data['expenses'] = $this->eModel->get_expenses();
		$this->data['content'] = 'grid/load_expenses';
		$this->load->view('layout', $this->data);
	}

	public function get_expense_details(){
		$this->eModel->exp_id = $this->input->post("exp_id");
		$this->data['exp_details'] = $this->eModel->get_expense_details();
		$response = $this->eModel->get_expense_details();
		echo json_encode($response);
	}
}
