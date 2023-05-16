<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Create_order extends MY_Controller
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
			'create_order/Create_order_model' => 'coModel',
		];
		$this->load->model($model_list);
	}

	/** load main page */
	public function index()
	{
		// if (
		// 	!check_permission($this->session->User_type, ['admin'])
		// ) {
		// 	redirect(base_url() . 'landing_page', 'refresh');
		// }

		$this->data['session'] =  $this->session;
		$ID = $this->uri->segment(3);
		$this->coModel->ID = $ID;
		$this->data['cust_details'] = $this->coModel->get_customer_details();
		$this->data['items'] = $this->coModel->get_items();
		$this->data['content'] = 'index';
		$this->load->view('layout', $this->data);
	}


}
