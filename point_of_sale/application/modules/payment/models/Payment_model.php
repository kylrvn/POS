<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Payment_model extends CI_Model
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
   

    public function get_items(){
        $this->db->select(
            'i.*,'.
            'l.List_name'
        );

        $this->db->where('Order_ID', $this->OrderID);
        $this->db->from($this->Table->item. ' i');
        $this->db->join($this->Table->list. ' l', 'l.ID = i.Item_id', 'left');

        $query = $this->db->get()->result();
        return $query;
    }

    public function get_order_details(){
        $this->db->select(
            'o.*,'.
            'l.List_name AS Status,'
    
    );

        $this->db->where('o.ID', $this->OrderID);
        $this->db->from($this->Table->order. ' o');
        $this->db->join($this->Table->list. ' l', 'l.id=o.Status','left');
        $query = $this->db->get()->row();
        return $query;
    }

    public function get_status(){
        $this->db->select('*');

        $this->db->where('List_category', "Status");
        $this->db->from($this->Table->list);
        $this->db->order_by('List_name', 'asc');

        $query = $this->db->get()->result();
        return $query;
    }

    public function get_users(){
        $this->db->select('*');

        $this->db->from($this->Table->user);
        $this->db->order_by('LName', 'asc');

        $query = $this->db->get()->result();
        return $query;
    }

    public function get_payment_modes(){
        $this->db->select('*');

        $this->db->where('List_category', "Payment");
        $this->db->from($this->Table->list);
        $this->db->order_by('List_name','asc');

        $query = $this->db->get()->result();
        return $query;
    }

    public function get_last_paid(){
        $this->db->select('*');

        $this->db->where('Order_ID', $this->OrderID);
        $this->db->where('Void', 0);
        $this->db->from($this->Table->payment);

        $query = $this->db->get()->result();
        
        $Amount = 0;

        foreach ($query as $key => $value) {
            $Amount += $value->Amount_paid;
        }
        return $Amount;
    }

    public function last_paid_cancel_order_ref(){
        $this->db->select('*');

        $this->db->where('Order_ID', $this->OrderID);
        $this->db->where('Void', 0);
        $this->db->from($this->Table->payment);

        $query = $this->db->get()->result();
     
        $lp_ID = 0;
        foreach ($query as $key => $value) {
            $lp_ID = @$value->ID;
        }
        return $lp_ID;
    }

    public function get_p_history(){
        $this->db->select(
            'p.*,'.
            'l.List_name as Mode,'.
            'u.FName,'.
            'u.LName'
        );

        $this->db->where('p.Order_ID', $this->OrderID);
        $this->db->from($this->Table->payment. ' p');
        $this->db->join($this->Table->list. ' l', 'l.ID=p.Payment_mode', 'left');
        $this->db->join($this->Table->user. ' u', 'u.ID=p.Incharge_ID', 'left');

        $query = $this->db->get()->result();

         return $query;
    }

    public function get_sewer(){
        $this->db->select(
            'u.*,'
        );

        $this->db->where('o.ID', $this->OrderID);
        $this->db->from($this->Table->order. ' o');
        $this->db->join($this->Table->user. ' u', 'u.ID=o.Sewer_assign', 'left');

        $query = $this->db->get()->row();

         return $query;
    }

    public function get_lay_artist(){
        $this->db->select(
            'u.*,'
        );

        $this->db->where('o.ID', $this->OrderID);
        $this->db->from($this->Table->order. ' o');
        $this->db->join($this->Table->user. ' u', 'u.ID=o.Layout_artist', 'left');

        $query = $this->db->get()->row();

         return $query;
    }

    public function get_set_artist(){
        $this->db->select(
            'u.*,'
        );

        $this->db->where('o.ID', $this->OrderID);
        $this->db->from($this->Table->order. ' o');
        $this->db->join($this->Table->user. ' u', 'u.ID=o.Setup_artist', 'left');

        $query = $this->db->get()->row();

         return $query;
    }

    public function get_o_status(){
        $this->db->select(
            'l.*,'
        );

        $this->db->where('o.ID', $this->OrderID);
        $this->db->from($this->Table->order. ' o');
        $this->db->join($this->Table->list. ' l', 'l.ID=o.Status', 'left');

        $query = $this->db->get()->row();

         return $query;
    }
    public function get_mockup_design(){
        $this->db->select(
            '*'
        );

        $this->db->where('Order_ID', $this->OrderID);
        $this->db->from($this->Table->reference);
        $this->db->order_by('ID', 'desc');

        $query = $this->db->get()->row();

         return $query;
        // echo json_encode($query);
    }
    public function get_payment_id()
    {
        $this->db->select('p.*, p.ID as Payment_ID, o.ID as Order_ID');
        $this->db->from($this->Table->order . ' o');
        $this->db->join($this->Table->payment . ' p', 'p.Order_ID = o.ID');
        $this->db->where('p.Order_ID', $this->OrderID);
        $query = $this->db->get()->result();
    
        // Loop through the query result to get the proof of payment for each payment
        foreach ($query as $payment) {
            $payment->Proof_of_payment = $this->get_p_proof($payment->Payment_ID);
        }
        // echo json_encode($payment->Payment_ID);
        return  $query;
    }
    
    public function get_p_proof($PID)
    {
        $this->db->select('*');
        $this->db->where('Payment_ID', $PID);
        $this->db->from($this->Table->proof);
        $query = $this->db->get()->result();
    
        return $query;
        // echo json_encode($query);
    }
    

    public function retrieve_design(){
        $this->db->select(
            '*'
        );

        $this->db->where('Order_ID', $this->OrderID);
        $this->db->from($this->Table->reference);

        $query = $this->db->get()->row();

         return $query;
        // echo json_encode($query);
    }
    public function get_previous_designs(){
        $this->db->select(
            'Mockup_design'
        );

        $this->db->where('Order_ID', $this->OrderID);
        $this->db->from($this->Table->reference);

        $query = $this->db->get()->result();

         return $query;
        // echo json_encode($query);
    }

    public function get_cod_terms(){
        $this->db->select(
            'p.*,'.
            'l.List_name'
        );

        $this->db->order_by('ID','desc');
        $this->db->where('Order_ID', $this->OrderID);
        // $this->db->where('Payment_mode', 51);
        $this->db->from($this->Table->payment . ' p');
        $this->db->join($this->Table->list . ' l', 'l.ID = p.Payment_mode');
        $query = $this->db->get()->row();

         return $query;
        // echo json_encode($query);
    }
    
}
