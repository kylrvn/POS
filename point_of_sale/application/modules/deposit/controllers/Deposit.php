<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Deposit extends MY_Controller
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
			'deposit/Deposit_model' => 'dModel',
			'expense/Expense_model' => 'eModel',
			'report/Report_model' => 'rModel',
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
		$this->data['total_deposit'] = $this->dModel->get_total_deposit();
		$this->data['total_withdrawal'] = $this->dModel->get_total_withdrawal();
		$this->data['branch'] = $this->eModel->get_branch();

		$this->data['profit'] =  $this->rModel->get_sales() - $this->rModel->get_expense();

		$this->data['content'] = 'index';
		$this->load->view('layout', $this->data);
	}

	public function get_deposit(){
		$this->dModel->branch = $this->input->post("branch"); 
		$this->dModel->d_from = $this->input->post("d_from");
		$this->dModel->d_to = $this->input->post("d_to");
		$this->data['result'] = $this->dModel->get_deposit();
		
		$this->data['content'] = 'grid/load_deposit';
		$this->load->view('layout', $this->data);
	}

	
}
