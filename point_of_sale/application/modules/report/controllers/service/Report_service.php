<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report_service extends MY_Controller
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
			'report/service/Report_services_model' => 'rsModel'
		];
		$this->load->model($model_list);
	}

	public function report_summ(){
		$this->rsModel->report_year = $this->input->post("report_year");

		// $this->data['monthly'] =  $this->rsModel->get_monthly();
		// // echo json_encode($this->rsModel->get_monthly());
		// $this->data['content'] = array(
		// 	'summary' => 'grid/summary',
		// 	'chart' => 'grid/chart');
		// $this->load->view('grid/summary', $this->data);
    	// $this->load->view('grid/chart', $this->data);
		// $this->load->view('layout', $this->data);

		$monthlyData = $this->rsModel->get_monthly();
	
		$summaryData['monthly'] = $monthlyData;
		$chartData['monthly'] = $monthlyData;
	
		$this->load->view('grid/summary', $summaryData);
		$this->load->view('grid/chart', $chartData);
	}

	public function void(){
		$this->rsModel->Payment_ID = $this->input->post("Payment_ID");
		$response = $this->rsModel->void();
		echo json_encode($response);
	}
}
