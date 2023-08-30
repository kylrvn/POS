<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login_model extends CI_Model
{
    public $Username;
    public $Password;
    public $Table;

    public function __construct()
    {
        parent::__construct();
        $model_list = [];
        $this->load->model($model_list);
        $this->Table = json_decode(TABLE);
    }
    public function authentication()
    {

        try {

            if (empty($this->username) || empty($this->password)) {
                throw new Exception(REQUIRED_FIELD);
            }
            $from = 'admin';
            $this->db->select('*');
            $this->db->from($this->Table->user);
            $this->db->where('Username', $this->username);
            $query = $this->db->get()->row();
            
            if($query->Active == 0){
                throw new Exception(DISABLED_ACCOUNT, true);
            }
            
            if(empty($query)){
                throw new Exception(NO_ACCOUNT, true);
            }
            if($query->Password !== sha1(password_generator($this->password,$query->Locker)) ){
                throw new Exception(NOT_MATCH, true);
            }
            // $query->from = $from;
            set_userdata(USER,(array)$query);
            // set_userdata(SAMPLE,(array)$sample);

            return array('has_error' => false, 'message' => 'Login Success');
        } catch (Exception $ex) {
            return array('error_message' => $ex->getMessage(), 'has_error' => true);
        }
    }

    public function update_branch(){
        try{     
            $data = array(
                'Branch' => $this->Branch,
            );

            $this->db->trans_start();
                         
            $this->db->where('ID', 17);
            $this->db->update($this->Table->user,$data);

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
}