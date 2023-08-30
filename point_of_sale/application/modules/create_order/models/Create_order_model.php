<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Create_order_model extends CI_Model
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

        $query = $this->db->get()->result();
        return $query;
    }

    public function get_customer_details(){
        $this->db->select('*');
        $this->db->where('ID', $this->ID);
        $this->db->from($this->Table->customer);

        $query = $this->db->get()->row();
        return $query;
    }
    

    public function get_items(){
        $this->db->select('*');
        $this->db->where('List_category', "Items");
        $this->db->from($this->Table->list);
        $this->db->order_by('List_name', 'asc');
        $query = $this->db->get()->result();
        return $query;
    }

    public function retrieve_order(){
        $this->db->select(
            'i.*,'.
            'l.List_name'
        );
        $this->db->where('Order_ID', $this->ID);
        $this->db->from($this->Table->item. ' i');
        $this->db->join($this->Table->list. ' l', 'l.ID=i.Item_id', 'left');
        $query = $this->db->get()->result();
        return $query;
    }

}
