<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Inventory_model extends CI_Model
{
    public $Table;
    public function __construct()
    {
        parent::__construct();
        $this->session = (object)get_userdata(USER);

        $model_list = [];
        $this->load->model($model_list);
        $this->Table = json_decode(TABLE);
    }

    public function get_inventory_items(){
        $this->db->select('*');
        $this->db->where('List_category', 'Inventory');
        $this->db->from($this->Table->list);
        $this->db->order_by('List_name', 'asc');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_inventory(){
        $this->db->select(
            'ID,'.
            'item_ID,'.
            'item_name,'.
            'quantity,'.
            'type,'
        );
        $this->db->from($this->Table->inventory);

        $query = $this->db->get()->result();
        return $query;
    }

    public function get_history(){
        $this->db->select(
            'item_name,'.
            'quantity,'.
            'type,'.
            'date_created,'.
            'u.FName,'.
            'u.LName,'
        );
        $this->db->from($this->Table->inventory.' i');
        $this->db->join($this->Table->user.' u', 'u.ID=i.created_by','left');


        $query = $this->db->get()->result();
        return $query;
    }
    
    
}