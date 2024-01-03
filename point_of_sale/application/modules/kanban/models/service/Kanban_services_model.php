<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Kanban_services_model extends CI_Model
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

    public function save_card()
    {
        try {
            if (
                empty($this->stat) &&
                empty($this->descr)
            ) {
                throw new Exception(EMPTY_FIELDS, true);
            }

            // check the latest order 
            $this->db->select('order_card');
            $this->db->where('Status_ID', $this->stat);
            $this->db->from($this->Table->cards);
            $this->db->order_by('order_card', 'asc');
            $query = $this->db->get()->row();

            $ordinal = $query->order_card == null || empty($query->order_card) ? 1 : (int)$query->order_card + 1;

            $data = array(
                'Status_ID' => $this->stat,
                'Card_Desc' => $this->descr,
                'order_card' => $ordinal
            );

            $this->db->trans_start();

            $this->db->insert($this->Table->cards, $data);

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

    public function update_col()
    {
        try {

            $data = array(
                'Status' => $this->stat,
                'order_card' => $this->ordercard
            );

            $this->db->trans_start();
            $this->db->where('ID', $this->card);
            $this->db->update($this->Table->order, $data);

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

    public function update()
    {
        try {
            if (
                empty($this->FName) &&
                empty($this->Company)
            ) {
                throw new Exception(EMPTY_FIELDS, true);
            }

            $data = array(
                'FName' => $this->FName,
                'LName' => $this->LName,
                'Company' => $this->Company,
                'CNumber' => $this->CNumber,
                'Branch' => $this->Branch
            );

            $this->db->trans_start();

            $this->db->where('ID', $this->ID);
            $this->db->update($this->Table->customer, $data);

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
