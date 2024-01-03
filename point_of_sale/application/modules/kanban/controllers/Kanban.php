<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kanban extends MY_Controller
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
			'kanban/Kanban_model' => 'kModel',
			'payment/Payment_model' => 'pModel',
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
		$this->data['status_list'] = $this->kModel->get_status_list();
		$this->data['card_list'] = $this->kModel->get_card_list();
		// var_dump($this->kModel->get_card_list());
		$this->data['content'] = 'index';
		$this->load->view('layout', $this->data);
	}

	public function uid()
	{
		// if (
		// 	!check_permission($this->session->Role, ['Admin'])
		// ) {
		// 	redirect(base_url() . 'login', 'refresh');
		// }

		// var_dump($this->kModel->get_card_list());
		$this->data['content'] = 'uid';
		$this->load->view('layout', $this->data);
	}

	public function load_order()
	{
		$this->pModel->OrderID = $this->input->post('post');
		$this->data['session'] =  $this->session;
		$this->data['order_items'] = $this->pModel->get_items();
		$this->data['order_dets'] = $this->pModel->get_order_details();
		$this->data['p_mode'] = $this->pModel->get_payment_modes();
		$this->data['last_paid'] = $this->pModel->get_last_paid();
		$this->data['last_paid_cancel_order_ref'] = $this->pModel->last_paid_cancel_order_ref();
		$this->data['status'] = $this->pModel->get_status();
		$this->data['p_history'] = $this->pModel->get_p_history();
		$this->data['users'] = $this->pModel->get_users();
		$this->data['mockup_img'] = $this->pModel->get_mockup_design();
		$this->data['previousDesigns'] = $this->pModel->get_previous_designs();
		$this->data['p_proof'] = $this->pModel->get_payment_id();
		$this->data['sewer'] = $this->pModel->get_sewer();
		$this->data['lay_artist'] = $this->pModel->get_lay_artist();
		$this->data['set_artist'] = $this->pModel->get_set_artist();
		$this->data['o_status'] = $this->pModel->get_o_status();
		$this->data['cod_terms'] = $this->pModel->get_cod_terms();

		$this->data['content'] = 'grid/load_order';
		$this->load->view('layout', $this->data);
	}

	public function get_orders()
	{
		$this->cModel->Cust_id = $this->input->get('id');
		$this->data['orders'] = $this->cModel->get_orders();
		$this->data['content'] = 'grid/load_orders';
		$this->load->view('layout', $this->data);
	}

}
