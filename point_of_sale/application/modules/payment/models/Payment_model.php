<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Payment_model extends CI_Model
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
   

    public function get_items(){
        $this->db->select(
            'i.*,'.
            'l.List_name'
        );

        $this->db->where('Order_ID', $this->OrderID);
        $this->db->from($this->Table->item. ' i');
        $this->db->join($this->Table->list. ' l', 'l.ID = i.Item_id', 'left');

        $query = $this->db->get()->result();
        return $query;
    }

    public function get_order_details(){
        $this->db->select(
            'o.*,'.
            'l.List_name AS Status'
    
    );

        $this->db->where('o.ID', $this->OrderID);
        $this->db->from($this->Table->order. ' o');
        $this->db->join($this->Table->list. ' l', 'l.id=o.Status','left');

        $query = $this->db->get()->row();
        return $query;
    }

    public function get_status(){
        $this->db->select('*');

        $this->db->where('List_category', "Status");
        $this->db->from($this->Table->list);

        $query = $this->db->get()->result();
        return $query;
    }
}
