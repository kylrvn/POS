<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard_model extends CI_Model
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
   
    public function get_details(){
        $this->db->select(
            'o.*,'.
            'c.*,'.
            'i.*,'.
            'r.Mockup_design,'.
            'l.List_name as Status'
        );
        $this->db->from($this->Table->order. ' o');
        $this->db->join($this->Table->customer. ' c', 'c.ID=o.Cust_ID', 'left');
        $this->db->join($this->Table->item. ' i', 'i.Order_ID=o.ID', 'left');
        $this->db->join($this->Table->list. ' l', 'l.ID=o.Status', 'left');
        $this->db->join($this->Table->reference. ' r', 'r.Order_ID=o.ID', 'left');
        $this->db->where('o.Cancelled', 0);
        if(!empty($this->session->Branch)){
            $this->db->where('c.Branch', $this->session->Branch);
        }
        if(!empty($this->Filter_value) && $this->Filter_value != "All"){
            if($this->Filter_type == "Order Status"){
                $this->db->where('Status', $this->Filter_value);
            } 
            else if($this->Filter_type == "Customer" && !empty($this->Filter_value)){
                $this->db->like('CONCAT(c.FName, " ", c.LName)', $this->Filter_value);
                $this->db->or_like('c.Company', $this->Filter_value);
            }
             else if($this->Filter_type == "Payment Status"){
                $this->db->where('o.Payment_status', $this->Filter_value);
            }
           
        } 
        // $this->db->join($this->Table->payment. ' p', '.ID=o.Status', 'left');

       
        $this->db->group_by('i.Order_id');
        $this->db->order_by('o.ID', 'desc');
        $query = $this->db->get()->result();

        
        foreach ($query as $key => $value) {
            $query[$key]->items =  $this->get_items($value->Order_ID);
            $query[$key]->sewer = $this->get_sewer($value->Sewer_assign);
            $query[$key]->layout = $this->get_layout($value->Layout_artist);
            $query[$key]->setup = $this->get_setup($value->Setup_artist);
            $query[$key]->paid = $this->get_amount_paid($value->Order_ID);
            $query[$key]->mock_up = $this->get_mock_up($value->Order_ID);
        }

       return $query;
    }

    public function get_items($ID){
        $this->db->select(
            'i.*,'.
            'l.List_name as Item_name'
        );
        $this->db->from($this->Table->item. ' i');
        $this->db->join($this->Table->list. ' l', 'l.ID=i.Item_id', 'left');
        $this->db->where('Order_ID', $ID);
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_sewer($sewer){
        $this->db->select(
            'u.*'
        );
        $this->db->from($this->Table->user. ' u');
        $this->db->where('ID', $sewer);
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_layout($layout){
        $this->db->select(
            'u.*'
        );
        $this->db->from($this->Table->user. ' u');
        $this->db->where('ID', $layout);
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_setup($setup){
        $this->db->select(
            'u.*'
        );
        $this->db->from($this->Table->user. ' u');
        $this->db->where('ID', $setup);
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_amount_paid($O_ID){
        $this->db->select('*');
        $this->db->from($this->Table->payment);
        $this->db->where('Order_ID', $O_ID);
        $query = $this->db->get()->result();

        $Amount = 0;

        foreach ($query as $key => $value) {
            $Amount += $value->Amount_paid;
        }
         return $Amount;
    }
    public function get_mock_up($O_ID){
        $this->db->select('*');
        $this->db->from($this->Table->reference);
        $this->db->where('Order_ID', $O_ID);
        $query = $this->db->get()->row();


         return $query;
    }

    public function get_status(){
        $this->db->select('*');
        $this->db->from($this->Table->list);
        $this->db->where('List_category', "Status");     
        $query = $this->db->get()->result();

        return $query;
    }
}
