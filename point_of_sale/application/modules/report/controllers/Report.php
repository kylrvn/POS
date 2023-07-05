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
		
		$this->data['content'] = 'sales_report';
		$this->load->view('layout', $this->data);
	}

	// public function load_summ(){
	// 	$this->data['monthly'] =  $this->rModel->get_monthly();
	// 	$this->data['content'] = ('grid/chart');
	// 	$this->load->view('layout', $this->data);
	// }

	public function load_summ() {
		$monthlyData = $this->rModel->get_monthly();
	
		$summaryData['monthly'] = $monthlyData;
		$chartData['monthly'] = $monthlyData;
	
		$this->load->view('grid/summary', $summaryData);
		$this->load->view('grid/chart', $chartData);
	}

	public function load_items() {
		$itemlist = $this->rModel->get_itemlist();
		// echo json_encode($itemlist);
		$data['ilist'] = $itemlist;
		$chartData['ilist'] = $itemlist;
	
		$this->load->view('grid/itemlist', $data);
		$this->load->view('grid/item_chart', $chartData);
	}

	// public function load_top_items() {
	// 	$toplist= $this->rModel->get_toplist();
		
	// 	$data['monthly'] = $toplist;
	// 	$chartData['monthly'] = $monthlyData;
	
	// 	$this->load->view('grid/top_items', $data);
	// 	// $this->load->view('grid/chart', $chartData);
	// }
	
	
}
