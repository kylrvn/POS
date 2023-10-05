<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Expense_service extends MY_Controller
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
			'expense/service/Expense_services_model' => 'esModel'
		];
		$this->load->model($model_list);
	}

	public function save(){
		// $this->esModel->date_added = $this->input->post("Date_added");
		// $this->esModel->description = $this->input->post("Desc");
		// $this->esModel->actual_money = $this->input->post("Actual_money");
		// $this->esModel->incharge = $this->input->post("Incharge");
		// $this->esModel->actual_expenses = $this->input->post("Actual_Expenses");
		// $this->esModel->bal = $this->input->post("Balance");
		// $this->esModel->branch = $this->input->post("Branch");
		
		$response = $this->esModel->add_expense();
		echo json_encode($response);
	}

	public function edit(){	
		$response = $this->esModel->edit_expense();
		echo json_encode($response);
	}

	public function add_image(){	
		$response = $this->esModel->add_image();
		echo json_encode($response);
	}

	public function void(){
		$this->esModel->Expense_ID = $this->input->post("Expense_id");
		$response = $this->esModel->void();
		echo json_encode($response);
	}
}
