<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Deposit_model extends CI_Model
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

    public function get_deposit_old(){
        $this->db->select("*");
        $this->db->from($this->Table->bank);

        $query = $this->db->get()->result();
        return $query;
    }

    public function get_deposit(){
        $this->db->select(
           'b.ID,'.
           'b.Date,'.
           'b.Cash,'.
           'b.Notes,'.
           'b.Mode,'.
           'b.Proof,'.
           'u.FName,'.
           'u.LName,'.
           'u.Branch'

        );
        $this->db->from($this->Table->bank.' b');
        $this->db->join($this->Table->user.' u', 'u.ID=b.Incharge','left');

        if(@$this->d_from != NULL || @$this->d_to != NULL){
            $this->db->where('b.Date >=', @$this->d_from);
            $this->db->where('b.Date <=', @$this->d_to);

        } else{
            // $this->db->where('b.Date', date('Y-m-d'));
            $this->db->where('MONTH(b.Date)', date('m'));
        }

        if(!empty($this->session->Branch)){
            if($this->session->Role == "Admin"){
                $this->db->where('u.Branch', $this->session->Branch);
            } else{
                $this->db->where('u.Branch', $this->session->Branch);
                $this->db->where('b.Incharge', $this->session->ID);
            }
        } 

        else {
            if(!empty($this->branch && $this->branch != "All")){
                $this->db->where('u.Branch', $this->branch);
            }
        }

        $query = $this->db->get()->result();
        return $query;
    }

    public function get_total_deposit(){
        $this->db->select('*');
        $this->db->from($this->Table->bank);
        $this->db->where('Mode', "Deposit");

        $query = $this->db->get()->result();
        $Amount = 0;

        foreach ($query as $key => $value) {
            $Amount += $value->Cash;
        }
        return $Amount;
    }

    public function get_total_withdrawal(){
        $this->db->select('*');
        $this->db->from($this->Table->bank);
        $this->db->where('Mode', "Withdrawal");

        $query = $this->db->get()->result();
        $Amount = 0;

        foreach ($query as $key => $value) {
            $Amount += $value->Cash;
        }
        return $Amount;
    }
}