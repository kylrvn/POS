<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Expense_services_model extends CI_Model
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
    

   public function add_expense(){
    try{     
            
        if(empty($this->date_added ||
                $this->description||
                $this->actual_money ||
                $this->incharge||
                $this->actual_expenses||
                $this->bal||
                $this->branch)){
            throw new Exception(MISSING_DETAILS, true);
        }

        $data = array(
            'Date' => $this->date_added,
            'Descr' => $this->description,
            'Actual_Money' => $this->actual_money,
            'Incharge' => $this->session->ID,
            'expense' => $this->actual_expenses,
            'Balance' => $this->bal,
            'Branch' => $this->session->Branch
        );

        $this->db->trans_start();
                       
        $this->db->insert($this->Table->expenses,$data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {                
            $this->db->trans_rollback();
            throw new Exception(ERROR_PROCESSING, true);	
        }else{
            $this->db->trans_commit();
            return array('message'=>SAVED_SUCCESSFUL, 'has_error'=>false);
        }
    }
    catch(Exception$msg){
        return (array('message'=>$msg->getMessage(), 'has_error'=>true));
    }
   }
}