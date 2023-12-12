<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Payment_services_model extends CI_Model
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

    public function save_payment(){

        try{     
            if($this->Payment_mode == 50 || $this->Payment_mode == 49){
                if(empty($this->Amount_paid)){
                    throw new Exception("Please enter amount to pay", true);
                }       
            }
          
            if($this->Payment_mode == 50){
                if(empty($this->Proof_of_reference)){
                    throw new Exception("Please upload proof of payment", true);
                    
                }
            }
            $data = array(
                'Order_ID' => $this->Order_ID,
                'Amount_paid' => $this->Amount_paid,
                'Amount_rendered' => $this->Amount_rendered,
                'Payment_mode' => $this->Payment_mode,
                'Incharge_ID' => $this->Incharge_ID,
                'Due_date' => $this->Due_date,
                'Date_paid' => date('Y:m:d H:i:s'),
            );
          

            $this->db->trans_start();
                     
            $this->db->insert($this->Table->payment,$data);
            $payment_ID = $this->db->insert_id();

             
            if($this->Payment_mode == 50){
                if(empty($this->Proof_of_reference)){
                    throw new Exception("Please submit proof of reference", true);
                }   else{
                    $this->save_proof($payment_ID);
                }
            } else if($this->Payment_mode == 49){
                if(empty($this->Receipt_number)){
                    throw new Exception("Please enter receipt number", true);
                }   else{
                    $this->save_rec_num($payment_ID);
                }
            } else if($this->Payment_mode == 51){
                if(empty($this->Waybill_number && $this->Due_date)){
                    throw new Exception("Please enter Waybill Number and Due Date", true);
                }   else{
                    $this->save_way_num($payment_ID);
                }
            } else if($this->Payment_mode == 52){
                if(empty($this->Due_date)){
                    throw new Exception("Please enter Due Date", true);
                }   else{
                    if(!empty($this->po_number)){
                        $this->save_po_num($payment_ID);
                    }
                }
            }
            
            $last_payment = $this->get_last_payment($this->Order_ID);
            $total_payment = $this->get_total_payment($this->Order_ID);

            $status = "";
            if($last_payment < $total_payment){
                $status = "DOWN";
            } else if($last_payment >= $total_payment){
                $status = "PAID";
            }
            // echo json_encode($last_payment." ".$status);

            $this->update_payment_status($this->Order_ID, $status);

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

    public function update_payment_status($ID,$status){
        try{     
           
            $data = array(
                'Payment_status' => $status,
            );
            $this->db->trans_start();
            $this->db->where('ID', $ID);
            $this->db->update($this->Table->order,$data);

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

    public function get_last_payment($x){
        $this->db->select('*');
        $this->db->where('Order_ID',$x);
        $this->db->from($this->Table->payment);

        $query = $this->db->get()->result();

        $Amount = 0;

        foreach ($query as $key => $value) {
            $Amount += $value->Amount_paid;
        }
         return $Amount;

    }

    public function get_total_payment($x){
        $this->db->select('Total_amt');
        $this->db->where('ID',$x);
        $this->db->from($this->Table->order);

        $query = $this->db->get()->row();

         return $query->Total_amt;

    }

    public function save_po_num($x){
        try{     
           
            $data = array(
                'Receipt_num' => $this->po_number,
            );
            $this->db->trans_start();
            $this->db->where('ID', $x);
            $this->db->update($this->Table->payment,$data);

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

    public function save_way_num($x){
        try{     
           
            $data = array(
                'Receipt_num' => $this->Waybill_number,
            );
            $this->db->trans_start();
            $this->db->where('ID', $x);
            $this->db->update($this->Table->payment,$data);

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

    public function save_rec_num($x){
        try{     
           
            $data = array(
                'Receipt_num' => $this->Receipt_number,
            );
            $this->db->trans_start();
            $this->db->where('ID', $x);
            $this->db->update($this->Table->payment,$data);

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

    public function save_proof($x){
        try{     
            $refData = array(
                'Payment_ID' => $x,
                'Proof_of_payment' => $this->Proof_of_reference
            );
            $this->db->trans_start();
            $this->db->insert($this->Table->proof,$refData);

            $refnum = array(
                'Receipt_num' => $this->Reference_number,
            );
            $this->db->where('ID', $x);
            $this->db->update($this->Table->payment,$refnum);

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


    public function update_details(){
        try{       
            $data = array(
                'Status' => $this->Order_status,
                'Sewer_assign' => $this->Sewer,
                'Layout_artist' => $this->Lay_artist,
                'Setup_artist' => $this->Set_artist,
                'Order_note' => $this->b_note,
                'Deadline_notes' => $this->d_note,
                'Freebies' => $this->freebies,
                'Deadline' => date('Y-m-d', strtotime($this->d_date))

            );

            $this->db->trans_start();
            
            $this->db->where('ID', $this->Order_id);
            $this->db->update($this->Table->order,$data);

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

    public function submit_modal_req($fileNames, $O_ID) {
        try {
    
            $this->db->trans_start();
    
            foreach ($fileNames as $fileName) {
            
                    $data = array(
                        'Mockup_design' => $fileName,
                        'Order_ID' => $O_ID,
                    );
    
                    $this->db->insert($this->Table->reference, $data);
            }
    
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

    public function cancel_order(){
        try{     
            $data = array(
                'Cancelled' => 1
            );
    
            $this->db->trans_start();
                           
            $this->db->where('ID', $this->Order_id);
            $this->db->update($this->Table->order,$data);
    
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
            {                
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);	
            }else{
                $this->db->trans_commit();
                return array('message'=>CANCELLED, 'has_error'=>false);
            }
        }
        catch(Exception$msg){
            return (array('message'=>$msg->getMessage(), 'has_error'=>true));
        }
       }
// november 17
    public function delete_item(){
        try{     
            $this->db->trans_start();
                           
            $this->db->where('ID', $this->Item_id);
            $this->db->delete($this->Table->item);
            
            $this->update_deleted_order_amounts();

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
            {                
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);	
            }else{
                $this->db->trans_commit();
                return array('message'=>DELETED_SUCCESSFUL, 'has_error'=>false);
            }
        }
        catch(Exception$msg){
            return (array('message'=>$msg->getMessage(), 'has_error'=>true));
        }
    }

    public function update_deleted_order_amounts(){
        try{     
            $this->db->trans_start();
                           
            $this->db->select('*');
            $this->db->from($this->Table->order);
            $this->db->where('ID', $this->Oid);

            $query = $this->db->get()->row();

            $new_total_amount = $query->Total_amt - $this->Amount;            
            $new_subtotal = $query->Subtotal - $this->Amount;            
            $new_qty = $query->Act_qty - $this->Qty;

            $data = array(
                'Total_amt' => $new_total_amount,
                'Act_qty' => $new_qty,
                'Subtotal' => $new_subtotal,
            );

            $this->db->where('ID', $this->Oid);
            $this->db->update($this->Table->order,$data);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
            {                
                $this->db->trans_rollback();
                throw new Exception(ERROR_PROCESSING, true);	
            }else{
                $this->db->trans_commit();
                return array('message'=>DELETED_SUCCESSFUL, 'has_error'=>false);
            }
        }
        catch(Exception$msg){
            return (array('message'=>$msg->getMessage(), 'has_error'=>true));
        }
    }
   
    public function update_updated_order_amounts(){
        try{     
            $this->db->trans_start();
                           
            $this->db->select('*');
            $this->db->from($this->Table->order);
            $this->db->where('ID', $this->Oid);

            $query = $this->db->get()->row();
            $old_selected_item_qty = $this->get_total_qty_amount()->Item_qty;
            $old_selected_item_amount = $this->get_total_qty_amount()->Item_unitprice;

            $new_qty = ($query->Act_qty - $old_selected_item_qty) + $this->Qty;
            $new_total_amount = ($query->Total_amt - $old_selected_item_amount) + $this->Amount;
            $new_subtotal = ($query->Subtotal - $old_selected_item_amount) + $this->Amount;

            // var_dump($new_total_amount);

            $data = array(
                'Total_amt' => $new_total_amount,
                'Act_qty' => $new_qty,
                'Subtotal' => $new_subtotal,
            );

            $this->db->where('ID', $this->Oid);
            $this->db->update($this->Table->order,$data);
            
            $this->update_item();

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

     public function get_total_qty_amount(){
        $this->db->select("*");
        $this->db->from($this->Table->item);
        $this->db->where('Order_ID', $this->Oid);
        $this->db->where('ID', $this->Item_id);

        $query = $this->db->get()->row();

        return $query;
    }

    public function update_item(){
        try{     
            $this->db->trans_start();
            
            $data = array(
                'Item_qty' => $this->Qty,
                'item_unitprice' => $this->Amount,
            );

            $this->db->where('ID', $this->Item_id);
            $this->db->update($this->Table->item,$data);
            
            $this->get_total_qty_amount();

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

// end of november 17
}