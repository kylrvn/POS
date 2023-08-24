<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Report_model extends CI_Model
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

    public function get_sales()
    {
        $this->db->select(
            'p.*,' .
                'o.*'
        );
        $this->db->from($this->Table->payment . ' p');
        $this->db->join($this->Table->order . ' o', 'o.ID=p.Order_ID', 'left');
        $this->db->join($this->Table->customer . ' c', 'c.ID=o.Cust_ID', 'left');
       

        if(!empty($this->session->Branch)){
            $this->db->where('c.Branch', $this->session->Branch);
        }

        $query = $this->db->get()->result();
        $Amount = 0;

        foreach ($query as $key => $value) {
            $Amount += $value->Amount_paid;
        }
        return $Amount;
        //  echo json_encode($query);
    }

    public function get_cash()
    {
        $this->db->select(
            'p.*,' .
                'o.*'
        );
        $this->db->from($this->Table->payment . ' p');
        $this->db->join($this->Table->order . ' o', 'o.ID=p.Order_ID', 'left');
        $this->db->join($this->Table->customer . ' c', 'c.ID=o.Cust_ID', 'left');
       

        if(!empty($this->session->Branch)){
            $this->db->where('c.Branch', $this->session->Branch);
        }
        
        $this->db->where('Payment_mode', 49);


        $query = $this->db->get()->result();
        $Amount = 0;

        foreach ($query as $key => $value) {
            $Amount += $value->Amount_paid;
        }
        return $Amount;

        // echo json_encode($Amount);

    }

    public function get_online()
    {
        $this->db->select(
            'p.*,' .
                'o.*'
        );
        $this->db->from($this->Table->payment . ' p');
        $this->db->join($this->Table->order . ' o', 'o.ID=p.Order_ID', 'left');
        $this->db->join($this->Table->customer . ' c', 'c.ID=o.Cust_ID', 'left');
       

        if(!empty($this->session->Branch)){
            $this->db->where('c.Branch', $this->session->Branch);
        }
        $this->db->where('Payment_mode', 50);

        $query = $this->db->get()->result();
        $Amount = 0;

        foreach ($query as $key => $value) {
            $Amount += $value->Amount_paid;
        }
        return $Amount;

        // echo json_encode($Amount);

    }

    public function get_expense()
    {
        $this->db->select(
            'e.*' 
        );
        $this->db->from($this->Table->expenses . ' e');
       

        if(!empty($this->session->Branch)){
            $this->db->where('e.Incharge', $this->session->ID);
        }
      

        $query = $this->db->get()->result();
        $Amount = 0;

        foreach ($query as $key => $value) {
            $Amount += $value->expense;
        }
        return $Amount;

        // echo json_encode($Amount);

    }

    public function get_monthly()
    {
        $this->db->select(
            'p.Date_paid,' .
                'SUM(p.Amount_paid) AS total,' .
                'o.*'
        );
        $this->db->from($this->Table->payment . ' p');
        $this->db->join($this->Table->order . ' o', 'o.ID=p.Order_ID', 'left');
        $this->db->join($this->Table->customer . ' c', 'c.ID=o.Cust_ID', 'left');
       

        if(!empty($this->session->Branch)){
            $this->db->where('c.Branch', $this->session->Branch);
        }
        // if(@$this->report_year!=null){
        //     // where $this->report_year == date_paid but year
        $this->db->where('YEAR(p.date_paid)', date("Y"));
        // }
        $this->db->group_by('Month(p.Date_paid)');
        $this->db->group_by('Year(p.Date_paid)');

        $query = $this->db->get()->result();
        return $query;
    }

    public function get_expense_monthly()
    {
        $this->db->select(
            'e.Date,' .
                'SUM(e.expense) AS totalexpense'
        );
        $this->db->from($this->Table->expenses . ' e');
       

        if(!empty($this->session->Branch)){
            $this->db->where('e.Incharge', $this->session->ID);
        }
        // if(@$this->report_year!=null){
        //     // where $this->report_year == date_paid but year
        $this->db->where('YEAR(e.Date)', date("Y"));
        // }
        $this->db->group_by('Month(e.Date)');
        $this->db->group_by('Year(e.Date)');

        $query = $this->db->get()->result();
        return $query;
    }

    public function get_itemlist()
    {
        $this->db->select(
            'i.Item_id,' .
            'SUM(i.Item_qty) as Quantity,' .
            ' l.List_name as item_name');
        $this->db->from($this->Table->item . ' i');
        $this->db->join($this->Table->list . ' l', 'l.ID=i.Item_id', 'left');
        $this->db->join($this->Table->customer. ' c', 'c.ID=i.Customer_ID', 'left');
        
        if(!empty($this->session->Branch)){
            $this->db->where('c.Branch', $this->session->Branch);
        }

        $this->db->group_by('i.Item_id');
        $this->db->order_by('Quantity','DESC');
        $this->db->limit(10);
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_daily_sales(){
        $this->db->select(
            'p.ID as P_ID,'.
            'p.Order_ID,'.
            'p.Amount_paid as P_Amount_paid,'.
            'p.Status as P_Status,'.
            'p.Date_paid as P_Date_paid,'.
            'o.*,'.
            'c.*,'.
            'l.*,'.
            'u.FName as UFName,'.
            'u.LName as ULName,'.
            'pr.ID as Proof_ID'
        );
        $this->db->from($this->Table->payment. ' p');
        $this->db->join($this->Table->order. ' o', 'o.ID=p.Order_ID', 'left');
        $this->db->join($this->Table->customer. ' c', 'c.ID=o.Cust_ID', 'left');
        $this->db->join($this->Table->item. ' i', 'i.Order_ID=o.ID', 'left');
        $this->db->join($this->Table->list. ' l', 'l.ID=p.Payment_mode', 'left');
        $this->db->join($this->Table->reference. ' r', 'r.Order_ID=o.ID', 'left');
        $this->db->join($this->Table->proof. ' pr', 'pr.Payment_ID=p.ID', 'left');
        $this->db->join($this->Table->user. ' u', 'u.ID=p.Incharge_ID', 'left');

        if(!empty($this->d_from || $this->d_to)){
            $this->db->where('p.Date_paid >=', $this->d_from);
            $this->db->where('p.Date_paid <=', $this->d_to);

        } else{
            $this->db->like('p.Date_paid', date('Y-m-d'));

        }
        if(!empty($this->session->Branch)){
            $this->db->where('c.Branch', $this->session->Branch);
        }
        $query = $this->db->get()->result();

        
        foreach ($query as $key => $value) {
            $query[$key]->items =  $this->get_items($value->Order_ID);
            $query[$key]->paid = $this->get_amount_paid($value->Order_ID);
            $query[$key]->proof = $this->get_proof($value->Proof_ID);
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
    public function get_proof($P_ID){
        $this->db->select('*');
        $this->db->from($this->Table->proof);
        $this->db->where('Payment_ID', $P_ID);
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