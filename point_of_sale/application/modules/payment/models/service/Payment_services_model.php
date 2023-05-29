<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Payment_services_model extends CI_Model
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

    public function save_payment(){
        try{     
            if(
                empty($this->Amount_paid)){
                throw new Exception("Please enter amount to pay", true);
            }   
            
            $data = array(
                'Order_ID' => $this->Order_id,
                'Amount_paid' => $this->Amount_paid,
                'Payment_mode' => $this->Payment_mode,
                'Date_paid' => date('Y:m:d H:i:s'),
            );

            $this->db->trans_start();
                           
            $this->db->insert($this->Table->payment,$data);

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