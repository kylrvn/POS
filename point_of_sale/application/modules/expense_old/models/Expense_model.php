<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Expense_model extends CI_Model
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

    public function get_expenses(){
        $this->db->select(
            'e.*,'.
            'u.FName,'.
            'u.LName'
        );
        $this->db->from($this->Table->expenses. ' e');
        $this->db->join($this->Table->user. ' u', 'u.ID=e.Incharge', 'left');
        
        if(!empty($this->session->Branch)){
            $this->db->where('e.Incharge', $this->session->ID);
        }
        $query = $this->db->get()->result();
        return $query;
        //  echo json_encode($query);
    }

}