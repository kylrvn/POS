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

   public function void(){
    try{     
        $data = array(
            'Void' => 1
        );

        $this->db->trans_start();
                       
        $this->db->where('ID', $this->Payment_ID);
        $this->db->update($this->Table->payment,$data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {                
            $this->db->trans_rollback();
            throw new Exception(ERROR_PROCESSING, true);	
        }else{
            $this->db->trans_commit();
            return array('message'=>VOID, 'has_error'=>false);
        }
    }
    catch(Exception$msg){
        return (array('message'=>$msg->getMessage(), 'has_error'=>true));
    }
   }

   public function verify(){
    try{     
        $data = array(
            'Verified' => 1
        );

        $this->db->trans_start();
                       
        $this->db->where('ID', $this->Payment_ID);
        $this->db->update($this->Table->payment,$data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {                
            $this->db->trans_rollback();
            throw new Exception(ERROR_PROCESSING, true);	
        }else{
            $this->db->trans_commit();
            return array('message'=>VERIFIED, 'has_error'=>false);
        }
    }
    catch(Exception$msg){
        return (array('message'=>$msg->getMessage(), 'has_error'=>true));
    }
   }
}