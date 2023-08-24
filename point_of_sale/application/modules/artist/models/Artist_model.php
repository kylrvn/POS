<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Artist_model extends CI_Model
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
   
    public function get_images(){
        $this->db->select(
            'r.*,'.
                'c.FName,'.
                'c.LName,'.
                'c.Company,'.
                'l.List_name AS Status,'.
                'l.ID AS Status_ID'
        );
        $this->db->from($this->Table->reference.' r');
        $this->db->join($this->Table->order.' o', 'o.ID=r.Order_ID','left');
        $this->db->join($this->Table->customer.' c', 'c.ID=o.Cust_ID','left');
        $this->db->join($this->Table->list.' l', 'l.ID=o.Status','left');
        $this->db->where('o.Layout_artist', $this->session->ID);
        $this->db->order_by('r.ID', 'desc');
        $query = $this->db->get()->result();

        // echo json_encode( $query);
        return $query;
    }
    

    public function update_status(){
        try{     

            $data = array(
                'Status' => $this->status,
                
            );

            $this->db->trans_start();
            
            $this->db->where('ID', $this->order_id);
            $this->db->update($this->Table->order,$data);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
            {                
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);	
            }else{
                $this->db->trans_commit();
                return array('message'=>"STATUS UPDATED", 'has_error'=>false);
            }
        }
        catch(Exception$msg){
            return (array('message'=>$msg->getMessage(), 'has_error'=>true));
        }
    }
}
