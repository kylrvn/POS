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

		$this->data['session'] =  $this->session;
		$this->data['content'] = 'index';
		$this->load->view('layout', $this->data);
	}


	public function get_details(){
		$this->data['details'] = $this->dModel->get_details();
		$this->data['content'] = 'grid/load_details';
		$this->load->view('layout', $this->data);
	}
}
