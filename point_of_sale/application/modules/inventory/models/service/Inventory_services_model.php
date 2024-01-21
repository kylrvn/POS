<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Inventory_services_model extends CI_Model
{
    public $ID;
    public $Table;

    public function __construct()
    {
        parent::__construct();
        $this->session = (object)get_userdata(USER);

        $model_list = [
        ];
        $this->load->model($model_list);
        $this->Table = json_decode(TABLE);
    }

    public function add_new_item(){
        try{
            $new_item = $this->input->post('new_item_name');

            $data = array(
                'List_name' => $new_item,
                'List_category' => "Inventory",
            );
            // Insert data into tbl_list
            $this->db->insert($this->Table->list, $data);
            
            $last_insert_ID = $this->db->insert_id();

            // Get data from tbl_list
            $this->db->select('List_name');
            $this->db->from($this->Table->list);
            $this->db->where('ID', $last_insert_ID);

            $item_name = $this->db->get()->result();

            return (array('insert_ID'=>$last_insert_ID, 'item_name'=>$item_name, 'has_error'=>false));
        }
        catch(Exception$msg){
            return (array('message'=>$e->getMessage(), 'has_error'=>true));
        }
    }

    public function add_e_inventory(){
        try{
            $item_ID = $this->input->post('item_ID');
            $item_name = $this->input->post('item_name');
            $type = $this->input->post('type');
            $quantity = $this->input->post('quantity');
            $created_by = $this->input->post('created_by');
            $branch = $this->input->post('branch');

            if(empty($quantity) || $quantity == "" || $quantity == null || $quantity <= 0){
                return array('message' => 'Invalid Quantity', 'has_error' => true);
            }

            if($type == "OUT"){

                $unique_items = [];

                $this->db->select(
                    'ID,'.
                    'item_ID,'.
                    'type,'.
                    'quantity,'
                );
                $this->db->from($this->Table->inventory);
                $this->db->where('item_name', $item_name);

                $query = $this->db->get()->result();

                if($query == null){
                    return array('message' => 'Invalid Stock Entry', 'has_error' => true);
                }
                else{

                    // out of stock checker
                    foreach ($query as $value1) {
                        $isUnique = true;
                    
                        foreach ($unique_items as $value2) {
                            if ($value1->item_ID == $value2->item_ID) {
                                $isUnique = false;
                                break;
                            }
                        }
                    
                        if ($isUnique) {
                            $unique_items[] = $value1;
                        }
                    }
                    foreach ($query as $value1) {
                        foreach ($unique_items as $value2){
                            if($value2->ID != $value1->ID && $value1->type == "IN" && $value2->item_ID == $value1->item_ID){
                                $value2->quantity = $value2->quantity + $value1->quantity;
                                break;
                            }
                            if($value2->ID != $value1->ID && $value1->type == "OUT" && $value2->item_ID == $value1->item_ID){
                                $value2->quantity = $value2->quantity - $value1->quantity;
                                break;
                            }
                        }
                    }
                    foreach ($unique_items as $value){
                        if($value->quantity < $quantity) {
                            return array('message' => 'Entered quanity is Greater than Stocks On Hand', 'has_error' => true);
                        }
                    }
                }
            }

            $data = array(
                'item_ID' => $item_ID,
                'item_name' => $item_name,
                'quantity' => $quantity,
                'type' => $type,
                'date_created' => date('Y-m-d H:i:s'),
                'created_by' => $created_by,
                'branch' => $branch,
            );

            // Insert the data into the database
            $this->db->insert($this->Table->inventory, $data);
            return (array('message'=>'Inventory Entry Successful', 'has_error'=>false));

        }
        catch(Exception $e){
            return (array('message'=>$e->getMessage(), 'has_error'=>true));
        }
    }
}
