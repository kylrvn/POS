<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Management_model extends CI_Model
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

    public function get_list(){
        $cats = array("Items", "Status", "Branch");
       
        $this->db->select('*');
        $this->db->where_in('List_category', $cats );
        $this->db->from($this->Table->list);
        $this->db->order_by('List_category','asc');
        $this->db->order_by('List_name','asc');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_user(){
        $this->db->select('*');
        if(!empty($this->session->Branch)){
            $this->db->where('Branch', $this->session->Branch);
        }
        $this->db->where('Active', 1);
        $this->db->from($this->Table->user);
        $this->db->order_by('LName','asc');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_user_for_edit(){
        $this->db->select('*');
        $this->db->from($this->Table->user);
        $this->db->where('ID', $this->user_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function get_list_details(){
        $this->db->select('*');
        $this->db->from($this->Table->list);
        $this->db->where('ID', $this->list_id);

        $query = $this->db->get()->row();
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

    public function get_user_role(){
        $this->db->select('*');
        $this->db->from($this->Table->list);
        $this->db->where('List_category', "User Role");
        $this->db->order_by('List_category','asc');
        $query = $this->db->get()->result();
        return $query;
    }

}
