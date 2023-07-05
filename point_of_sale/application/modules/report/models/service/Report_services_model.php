<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Report_services_model extends CI_Model
{
    public $ID;
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
    
    public function get_monthly(){
        $this->db->select(
            'p.Date_paid,'.
            'SUM(p.Amount_paid) AS total,'.
            'o.*'
        );
        $this->db->from($this->Table->payment.' p');
        $this->db->join($this->Table->order.' o', 'o.ID=p.Order_ID', 'left');
        $this->db->join($this->Table->customer . ' c', 'c.ID=o.Cust_ID', 'left');
       

        if(!empty($this->session->Branch)){
            $this->db->where('c.Branch', $this->session->Branch);
        }
        
        if(@$this->report_year!=null){
            // where $this->report_year == date_paid but year
            $this->db->where('YEAR(p.date_paid)', $this->report_year);
        }
        
        $this->db->group_by('Month(p.Date_paid)');
        $this->db->group_by('Year(p.Date_paid)');

        $query = $this->db->get()->result();
         return $query;
   }
}