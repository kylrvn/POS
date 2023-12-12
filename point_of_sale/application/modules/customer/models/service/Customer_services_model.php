<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Customer_services_model extends CI_Model
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

    public function save(){
        try{     
            if(
                empty($this->FName) &&
                empty($this->Company)){
                throw new Exception(EMPTY_FIELDS, true);
            }   
            
            $data = array(
                'FName' => $this->FName,
                'LName' => $this->LName,
                'Company' => $this->Company,
                'CNumber' => $this->CNumber,
                'Branch' => $this->Branch
            );

            $this->db->trans_start();
                           
            $this->db->insert($this->Table->customer,$data);
            $insert_id = $this->db->insert_id();

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
            {                
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);	
            }else{
                $this->db->trans_commit();
                return array('message'=>SAVED_SUCCESSFUL, 'has_error'=>false, 'cust_id'=>$insert_id);
            }
        }
        catch(Exception$msg){
            return (array('message'=>$msg->getMessage(), 'has_error'=>true));
        }
    }

    public function update(){
        try{     
            if(
                empty($this->FName) &&
                empty($this->Company)){
                throw new Exception(EMPTY_FIELDS, true);
            }   
            
            $data = array(
                'FName' => $this->FName,
                'LName' => $this->LName,
                'Company' => $this->Company,
                'CNumber' => $this->CNumber,
                'Branch' => $this->Branch
            );

            $this->db->trans_start();
                           
            $this->db->where('ID', $this->ID);
            $this->db->update($this->Table->customer,$data);

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

    public function delete(){
        try{     
            if($this->check_cust_order_exist() == null){
           
                $data = array(
                    'Active' => '1',
                );

                $this->db->trans_start();
                
                $this->db->where('ID', $this->ID);
                $this->db->update($this->Table->customer,$data);

                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE)
                {                
                    $this->db->trans_rollback();
                    throw new Exception(ERROR_PROCESSING, true);	
                }else{
                    $this->db->trans_commit();
                    return array('message'=>DELETED_SUCCESSFUL, 'has_error'=>false);
                }
            } else {
                return array('message'=>"Order can't be deleted, their is/are active order/s for this customer.", 'has_error'=>true);
            }
        }
        catch(Exception$msg){
            return (array('message'=>$msg->getMessage(), 'has_error'=>true));
        }
    }

    public function check_cust_order_exist(){
        $this->db->select('*');
        $this->db->from($this->Table->order);
        $this->db->where('Cust_ID', $this->ID);
        $this->db->where('Cancelled', 0);

        $query = $this->db->get()->row();
        return $query;
    }
}