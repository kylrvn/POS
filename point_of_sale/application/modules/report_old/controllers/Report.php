<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends MY_Controller
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

		$this->data['session'] =  $this->session;
		$this->data['sales'] =  $this->rModel->get_sales();
		$this->data['cash'] =  $this->rModel->get_cash();
		$this->data['online'] =  $this->rModel->get_online();
		$this->data['monthly'] =  $this->rModel->get_monthly();
		$this->data['content'] = 'sales_report';
		$this->load->view('layout', $this->data);
	}
}
