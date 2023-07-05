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

   public function get_sales(){
        $this->db->select(
            'p.*,'.
            'o.*'
        );
        $this->db->from($this->Table->payment.' p');
        $this->db->join($this->Table->order.' o', 'o.ID=p.Order_ID', 'left');

        $query = $this->db->get()->result();
        $Amount = 0;

        foreach ($query as $key => $value) {
            $Amount += $value->Amount_paid;
        }
         return $Amount;
        //  echo json_encode($query);
   }

   public function get_cash(){
        $this->db->select(
            'p.*,'.
            'o.*'
        );
        $this->db->from($this->Table->payment.' p');
        $this->db->join($this->Table->order.' o', 'o.ID=p.Order_ID', 'left');
        $this->db->where('Payment_mode', 49);

        $query = $this->db->get()->result();
        $Amount = 0;

        foreach ($query as $key => $value) {
            $Amount += $value->Amount_paid;
        }
        return $Amount;

        // echo json_encode($Amount);

    }

    public function get_online(){
        $this->db->select(
            'p.*,'.
            'o.*'
        );
        $this->db->from($this->Table->payment.' p');
        $this->db->join($this->Table->order.' o', 'o.ID=p.Order_ID', 'left');
        $this->db->where('Payment_mode', 49);

        $query = $this->db->get()->result();
        $Amount = 0;

        foreach ($query as $key => $value) {
            $Amount += $value->Amount_paid;
        }
        return $Amount;

        // echo json_encode($Amount);

    }

    public function get_monthly(){
        $this->db->select(
            'p.Date_paid,'.
            'SUM(p.Amount_paid) AS total,'.
            'o.*'
        );
        $this->db->from($this->Table->payment.' p');
        $this->db->join($this->Table->order.' o', 'o.ID=p.Order_ID', 'left');
        $this->db->group_by('Month(p.Date_paid)');
        $this->db->group_by('Year(p.Date_paid)');

        $query = $this->db->get()->result();
         return $query;
   }
}
