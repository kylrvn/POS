<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Artist extends MY_Controller
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
			'artist/Artist_model' => 'aModel',
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
		// if($this->session->Role == "Artist"){
		// 	$this->data['content'] = 'index_artist';

		// } else{
		// 	$this->data['content'] = 'index';
		// }
		$this->data['content'] = 'index';
		$this->load->view('layout', $this->data);
	}

	public function get_images(){
		$this->data['status'] = $this->pModel->get_status();
		$this->data['images'] = $this->aModel->get_images();
		$this->data['content'] = 'grid/load_images';
		$this->load->view('layout', $this->data);

	}

	public function update_status(){
		$this->aModel->status = $this->input->post("status");
		$this->aModel->order_id = $this->input->post("order_id");

		$response = $this->aModel->update_status();
		echo json_encode($response);
	}
}
