<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
	private $data = [];
	protected $session;
	public function __construct()
	{
		parent::__construct();
		$this->session = (object)get_userdata(USER);

		if(is_empty_object($this->session)){
			redirect(base_url().'login/authentication', 'refresh');
		}

		$model_list = [
			'dashboard/Dashboard_model' => 'dModel',
		];
		$this->load->model($model_list);
	}

	/** load main page */
	public function index()
	{
		// if (
		// 	!check_permission($this->session->Role, ['Admin'])
		// ) {
		// 	redirect(base_url() . 'login', 'refresh');
		// }

		$this->data['status'] = $this->dModel->get_status();
		$this->data['session'] =  $this->session;
		$this->data['branch'] = $this->dModel->get_branch();
		// if($this->session->Role == "Artist"){
		// 	$this->data['content'] = 'index_artist';

		// } else{
		// 	$this->data['content'] = 'index';
		// }
		$this->data['content'] = 'index';
		$this->load->view('layout', $this->data);
	}


	public function get_details(){
		$this->dModel->Filter_value = $this->input->post("Filter_value");
		$this->dModel->Filter_type = $this->input->post("Filter_type");
		$this->dModel->Filter_date = $this->input->post("Filter_date");
		// $this->dModel->Branch = $this->input->post("Branch");
		$this->data['details'] = $this->dModel->get_details();
		$this->data['content'] = 'grid/load_details';
		$this->load->view('layout', $this->data);
	}
}
