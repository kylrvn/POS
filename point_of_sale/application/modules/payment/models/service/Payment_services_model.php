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
                'Order_ID' => $this->Order_ID,
                'Amount_paid' => $this->Amount_paid,
                'Payment_mode' => $this->Payment_mode,
                'Incharge_ID' => $this->Incharge_ID,
                'Date_paid' => date('Y:m:d H:i:s'),
            );
          

            $this->db->trans_start();
                     
            $this->db->insert($this->Table->payment,$data);
            $payment_ID = $this->db->insert_id();

            $this->save_proof($payment_ID);

           
            
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


    public function save_proof($x){
        try{     
            $refData = array(
                'Payment_ID' => $x,
                'Proof_of_payment' => $this->Proof_of_reference
            );
            $this->db->trans_start();
            $this->db->insert($this->Table->proof,$refData);

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


    public function update_details(){
        try{       
            $data = array(
                'Status' => $this->Order_status,
                'Sewer_assign' => $this->Sewer,
                'Layout_artist' => $this->Lay_artist,
                'Setup_artist' => $this->Set_artist,
                'Order_note' => $this->b_note,
                'Deadline_notes' => $this->d_note,
                'Freebies' => $this->freebies,
                'Deadline' => date('Y-m-d', strtotime($this->d_date))

            );

            $this->db->trans_start();
            
            $this->db->where('ID', $this->Order_id);
            $this->db->update($this->Table->order,$data);

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

    public function submit_modal_req($fileNames, $O_ID) {
        try {
    
            $this->db->trans_start();
    
            foreach ($fileNames as $fileName) {
            
                    $data = array(
                        'Mockup_design' => $fileName,
                        'Order_ID' => $O_ID,
                    );
    
                    $this->db->insert($this->Table->reference, $data);
            }
    
            $this->db->trans_complete();
    
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);
            } else {
                $this->db->trans_commit();
                return array('message' => SAVED_SUCCESSFUL, 'has_error' => false);
            }
        } catch (Exception $msg) {
            return (array('message' => $msg->getMessage(), 'has_error' => true));
        }
    }
}