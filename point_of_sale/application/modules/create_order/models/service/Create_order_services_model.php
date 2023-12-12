<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Create_order_services_model extends CI_Model
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

    public function save_order(){
        try{     
            
            if(empty($this->Item_id)){
                throw new Exception(NO_SELECTION, true);
            }

            if(empty($this->B_date)){
                throw new Exception(NO_DATE, true);
            }

            $data = array(
                'Cust_ID' => $this->ID,
                'Act_qty' => $this->Qty,
                'Total_amt' => $this->Total,
                'Book_date' => date('Y-m-d', strtotime($this->B_date)),
                'Deadline' => date('Y-m-d', strtotime($this->D_date)),
                'Deadline_notes' => $this->D_notes,
                'Order_note' => $this->B_notes,
                'Freebies' => $this->Freebies,
                'Subtotal' => $this->Subtotal,
                'Discount' => $this->Discount,

            );

            $this->db->trans_start();
                           
            $this->db->insert($this->Table->order,$data);
            $ID = $this->db->insert_id();

            $this->update_jo_number($ID);
            $this->save_items($ID);


            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
            {                
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);	
            }else{
                $this->db->trans_commit();
                return array('message'=>SAVED_SUCCESSFUL, 'has_error'=>false, 'id'=>$ID);
            }
        }
        catch(Exception$msg){
            return (array('message'=>$msg->getMessage(), 'has_error'=>true));
        }
    }

    public function update_jo_number($ID){
        
        $data = array(
            'Jo_num' => "JO-00".$ID
        );


        $this->db->where('ID', $ID);
        $this->db->update($this->Table->order,$data);
    }
    
    public function save_items($order_id){
        try{     
            $lenght = sizeof($this->Item_id);
            $x = 0;
            $this->db->trans_start();

            while($x <= $lenght){
                if(!empty($this->Item_id[$x])){
                    $data = array(
                        'Customer_ID' => $this->ID,
                        'Order_ID' => $order_id,
                        'Item_id' => $this->Item_id[$x],
                        'Item_qty' => $this->Item_qty[$x],
                        'Item_unitprice' => $this->Item_amount[$x],
                        // 'Book_date' => date('Y-m-d', strtotime($this->B_date))
                    );
        
                    $this->db->insert($this->Table->item,$data);
    
                 
                }
                $x++;
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
            {                
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);	
            }else{
                $this->db->trans_commit();
                return array('message'=>SAVED_SUCCESSFUL, 'has_error'=>false);
            }
        }
        catch(Exception$msg){
            return (array('message'=>$msg->getMessage(), 'has_error'=>true));
        }
    }


    public function save_additional_order(){
        try{     
            
            if(empty($this->Item_id)){
                throw new Exception(NO_SELECTION, true);
            }

            $this->db->select('*');
            $this->db->from($this->Table->order);
            $this->db->where('ID', $this->oid);
    
            $query = $this->db->get()->row();
    
            $new_total = $query->Total_amt + $this->Total;
            $new_subtotal = $query->Subtotal + $this->Total;
            $new_qty = $query->Act_qty + $this->Qty;
          

            $this->db->trans_start();
                           
            $data = array(
                'Total_amt' => $new_total,
                'Act_qty' => $new_qty,
                'Subtotal' => $new_subtotal,
            );

            $this->db->where('ID', $this->oid);
            $this->db->update($this->Table->order,$data);
            $this->save_additional_order_items();


            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
            {                
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);	
            }else{
                $this->db->trans_commit();
                return array('message'=>SAVED_SUCCESSFUL, 'has_error'=>false);
            }
        }
        catch(Exception$msg){
            return (array('message'=>$msg->getMessage(), 'has_error'=>true));
        }

    }

    public function save_additional_order_items(){
        try{     
            $lenght = sizeof($this->Item_id);
            $x = 0;
            $this->db->trans_start();

            while($x <= $lenght){
                if(!empty($this->Item_id[$x])){
                    $data = array(
                        'Customer_ID' => $this->ID,
                        'Order_ID' => $this->oid,
                        'Item_id' => $this->Item_id[$x],
                        'Item_qty' => $this->Item_qty[$x],
                        'Item_unitprice' => $this->Item_amount[$x],
                        // 'Book_date' => date('Y-m-d', strtotime($this->B_date))
                    );
        
                    $this->db->insert($this->Table->item,$data);
    
                 
                }
                $x++;
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
            {                
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);	
            }else{
                $this->db->trans_commit();
                return array('message'=>SAVED_SUCCESSFUL, 'has_error'=>false);
            }
        }
        catch(Exception$msg){
            return (array('message'=>$msg->getMessage(), 'has_error'=>true));
        }
    }

}