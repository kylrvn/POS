<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Kanban_model extends CI_Model
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

    public function get_status_list()
    {
        $this->db->select('*');
        $this->db->where('List_category', 'Status');
        $this->db->from($this->Table->list);
        $this->db->order_by('ID', 'asc');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_card_list()
    {
        $this->db->select('*');
        // $this->db->from($this->Table->cards);
        $this->db->from($this->Table->order);
        $this->db->order_by('order_card', 'asc');
        $query = $this->db->get()->result();
        $img = "";
        //image checker query
        foreach ($query as $k => $val) {
            if (@$query->refID_selected == null || empty($query->refID_selected)) {
                $this->db->select('ID');
                $this->db->from($this->Table->reference);
                $this->db->where('Order_ID', $val->ID);
                $this->db->order_by('ID', 'desc');
                $img = $this->db->get()->row();
                if ($img) {
                    $data = array("refID_selected" => $img->ID);
                    $this->db->where('ID', $val->ID);
                    $this->db->update($this->Table->order, $data);
                }
            }
        }

        if ($this->session->Role == "Admin" && $this->session->Branch == null || $this->session->Branch == "" || empty($this->session->Branch)) {
            //checks if user is superadmin
            $this->db->select('o.*,' .
                'r.Mockup_Design,' .
                'sa.FName as sf,' . 'sa.LName as sl,' .
                'la.FName as lf,' . 'la.LName as ll,' .
                'sua.FName as suf,' . 'sua.LName as sul');
            $this->db->join($this->Table->reference . ' r', 'o.refID_selected = r.ID', 'left');
            $this->db->join($this->Table->user . ' sa', 'o.Sewer_assign = sa.ID', 'left');
            $this->db->join($this->Table->user . ' la', 'o.Layout_Artist = la.ID', 'left');
            $this->db->join($this->Table->user . ' sua', 'o.Setup_Artist = sua.ID', 'left');
            $this->db->from($this->Table->order . ' o');

            $this->db->order_by('order_card', 'asc');
            $query = $this->db->get()->result();
            return $query;
        } else {
            if ($this->session->Role == "Admin") {
                //checks if user is admin. then filter by branch by joining tbl_customer
                $this->db->select('o.*,' .
                    'r.Mockup_Design,' .
                    'sa.FName as sf,' . 'sa.LName as sl,' .
                    'la.FName as lf,' . 'la.LName as ll,' .
                    'sua.FName as suf,' . 'sua.LName as sul');
                $this->db->join($this->Table->reference . ' r', 'o.refID_selected = r.ID', 'left');
                $this->db->join($this->Table->user . ' sa', 'o.Sewer_assign = sa.ID', 'left');
                $this->db->join($this->Table->user . ' la', 'o.Layout_Artist = la.ID', 'left');
                $this->db->join($this->Table->user . ' sua', 'o.Setup_Artist = sua.ID', 'left');
                $this->db->join($this->Table->customer . ' c', 'o.Cust_ID = c.ID', 'inner');
                $this->db->from($this->Table->order . ' o');
                $this->db->where('c.Branch', $this->session->Branch);

                $this->db->order_by('order_card', 'asc');
                $query = $this->db->get()->result();
                // } elseif ($this->session->Role == "Artist") {
            } elseif (strpos(strtoupper($this->session->Role), 'ARTIST') !== false) { // assuming different types of artist is implemented 
                //filter by specific artist
                $this->db->select('o.*,' .
                    'r.Mockup_Design,' .
                    'sa.FName as sf,' . 'sa.LName as sl,' .
                    'la.FName as lf,' . 'la.LName as ll,' .
                    'sua.FName as suf,' . 'sua.LName as sul');
                $this->db->join($this->Table->reference . ' r', 'o.refID_selected = r.ID', 'left');
                $this->db->join($this->Table->user . ' sa', 'o.Sewer_assign = sa.ID', 'left');
                $this->db->join($this->Table->user . ' la', 'o.Layout_Artist = la.ID', 'left');
                $this->db->join($this->Table->user . ' sua', 'o.Setup_Artist = sua.ID', 'left');
                // $this->db->join($this->Table->user . ' la', 'o.Layout_Artist = la.ID', 'inner'); //used inner to join as filter to join the two tables
                $this->db->join($this->Table->customer . ' c', 'o.Cust_ID = c.ID', 'inner');
                $this->db->from($this->Table->order . ' o');

                $this->db->order_by('order_card', 'asc');
                $this->db->where('o.Sewer_assign', $this->session->ID);
                $this->db->or_where('o.Layout_Artist', $this->session->ID);
                $this->db->or_where('o.Setup_Artist', $this->session->ID);

                $query = $this->db->get()->result();
            } else {
                $query = null;
            }
        }
        // final query
        // $this->db->select('o.*,' .
        //     'r.Mockup_Design,' .
        //     'sa.FName as sf,' . 'sa.LName as sl,' .
        //     'la.FName as lf,' . 'la.LName as ll,' .
        //     'sua.FName as suf,' . 'sua.LName as sul');
        // $this->db->join($this->Table->reference . ' r', 'o.refID_selected = r.ID', 'left');
        // $this->db->join($this->Table->user . ' sa', 'o.Sewer_assign = sa.ID', 'left');
        // $this->db->join($this->Table->user . ' la', 'o.Layout_Artist = la.ID', 'left');
        // $this->db->join($this->Table->user . ' sua', 'o.Setup_Artist = sua.ID', 'left');
        // $this->db->from($this->Table->order . ' o');

        // $this->db->order_by('order_card', 'asc');
        // $query = $this->db->get()->result();
        return $query;
    }

    public function get_branch()
    {
        $this->db->select('*');
        $this->db->where('List_category', 'Branch');
        $this->db->from($this->Table->list);

        $this->db->order_by('List_name', 'asc');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_cust_details()
    {
        $this->db->select('*');
        $this->db->from($this->Table->customer);
        $this->db->where('ID', $this->Cust_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function get_orders()
    {
        $this->db->select('*');
        $this->db->from($this->Table->order);
        $this->db->where('Cust_ID', $this->Cust_id);
        $this->db->where('Cancelled', 0);
        $this->db->order_by('Book_date', 'desc');

        $query = $this->db->get()->result();

        foreach ($query as $key => $value) {
            $query[$key]->paid = $this->get_amount_paid($value->ID);
        }

        return $query;
    }

    public function get_amount_paid($O_ID)
    {
        $this->db->select('*');
        $this->db->from($this->Table->payment);
        $this->db->where('Order_ID', $O_ID);
        $this->db->where('Void', 0);
        $query = $this->db->get()->result();

        $Amount = 0;

        foreach ($query as $key => $value) {
            $Amount += $value->Amount_paid;
        }
        return $Amount;
    }
}
