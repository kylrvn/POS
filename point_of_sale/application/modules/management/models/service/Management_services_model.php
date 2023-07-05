<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Management_services_model extends CI_Model
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

    public function save_list(){
        try{     
            if(
                empty($this->List_name) ){
                throw new Exception(MISSING_DETAILS, true);
            }   
            
            $data = array(
                'List_name' => $this->List_name,
                'List_category' => $this->List_category,
            );

            $this->db->trans_start();
                           
            $this->db->insert($this->Table->list,$data);

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

    public function save_user(){
        try{     
            if(
                empty($this->FName) &&
                empty($this->LName) &&
                empty($this->Username)){
                throw new Exception(MISSING_DETAILS, true);
            }   
            
            $check = $this->check_user_exist();
            if(!empty($check)){
                throw new Exception(DUPLICATE_USERNAME_FOUND, true);
            }

            $UID = auth_token();
            $default = "Password1234";
            $Locker = locker();
            $Password = sha1(password_generator($default, $Locker));     

            $data = array(
                'Username' => $this->Username,
                'FName' => $this->FName,
                'LName' => $this->LName,
                'Role_ID' => $this->Role,
                'Role' => $this->Role_name,
                'Branch' => $this->Branch,
                'Locker' => $Locker,
                'Password' => $Password,
                'U_ID' => $UID,
            );

            $this->db->trans_start();
                           
            $this->db->insert($this->Table->user,$data);

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

     /** check username if it exist in the table */
     public function check_user_exist(){
        try{
            $this->db->select('ID');
            $this->db->where('Username', $this->Username);
            $query = $this->db->get($this->Table->user)->row();

            return $query;
        }
        catch(Exception $msg){
            echo json_encode(array('error_message'=>$msg->getMessage(), 'has_error'=>true));
        }
    }

    public function update_user(){
        try{     
            if(
                empty($this->FName) &&
                empty($this->LName) &&
                empty($this->Username)){
                throw new Exception(MISSING_DETAILS, true);
            }   

            $data = array(
                'Username' => $this->Username,
                'FName' => $this->FName,
                'LName' => $this->LName,
                'Role_ID' => $this->Role,
                'Branch' => $this->Branch,
                'Role' => $this->Role_name,
            );

            $this->db->trans_start();
            
            $this->db->where('U_ID', $this->U_ID);
            $this->db->update($this->Table->user,$data);

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

    public function reset(){
        try{     

            $default = "Password1234";
            $Locker = locker();
            $Password = sha1(password_generator($default, $Locker));     
            
            $data = array(
                'Locker' => $Locker,
                'Password' => $Password
            );

            $this->db->trans_start();
            
            $this->db->where('U_ID', $this->U_ID);
            $this->db->update($this->Table->user,$data);

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