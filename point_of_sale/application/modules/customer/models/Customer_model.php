<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Customer_model extends CI_Model
{
    public $Table;
    public function __construct()
    {
        parent::__construct();
        $this->session = (object)get_userdata(USER);

        // if(is_empty_object($this->session)){
        // 	redirect(base_url().'login/authentication', 'refresh');
        // }

        $model_list = [];
        $this->load->model($model_list);
        $this->Table = json_decode(TABLE);
    }
   
    public function get_customers(){
        $this->db->select('*');
        $this->db->from($this->Table->customer);
        if(!empty($this->session->Branch)){
            $this->db->where('Branch', $this->session->Branch);
        }

        $this->db->order_by('ID', 'desc');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_branch(){
        $this->db->select('*');
        $this->db->where('List_category', 'Branch');
        $this->db->from($this->Table->list);
      
        $this->db->order_by('List_name', 'asc');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_cust_details(){
        $this->db->select('*');
        $this->db->from($this->Table->customer);
        $this->db->where('ID', $this->Cust_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function get_orders(){
        $this->db->select('*');
        $this->db->from($this->Table->order);
        $this->db->where('Cust_ID', $this->Cust_id);
        $this->db->where('Cancelled', 0);
        $this->db->order_by('Book_date', 'desc');

        $query = $this->db->get()->result();
        return $query;
    }

}
