<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Deposit_services_model extends CI_Model
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

    public function add_deposit()
    {
        try {
            $date = $this->input->post('Date');
            $note = $this->input->post('Note');
            $cash = $this->input->post('Cash');
            $mode = $this->input->post('Mode');
            $branch;
            if(empty($this->input->post('Branch'))){
                $branch = $this->session->Branch;
            } else{
                $branch = $this->input->post('Branch');
            }

            if(isset($_FILES['image'])){
                  // Get the uploaded image file
               $image = $_FILES['image'];
                
              
               // Image upload configuration
               $config['upload_path'] = FCPATH . 'assets/uploaded/proofs/'; 
               $config['allowed_types'] = 'jpg|png|jpeg|gif'; 
               // $config['encrypt_name'] = TRUE; // Encrypt the filename. Activate if u want encrypted name for image files.
               $config['max_size'] = 10240; // 10 MB in bytes

               $this->load->library('upload', $config);

              // // Upload the image
               if ($this->upload->do_upload('image')) {
               
                   $uploadData = $this->upload->data();
                   $imagePath = $uploadData['file_name']; // Image file name
               } 
            }
             

            $data = array(
                'Date' => $date,
                'Notes' => $note,
                'Cash' => $cash,
                'Incharge' => $this->session->ID,
                'Proof' => $imagePath ?? false,
                'Mode' => $mode ,
            );

            // Insert the data into the database
            $this->db->insert($this->Table->bank, $data);

            return array('message' => 'Expense added successfully.', 'has_error' => false);
        } catch (Exception $e) {
            return array('message' => $e->getMessage(), 'has_error' => true);
        }
    }

    public function delete(){
        try{     

            $this->db->where('ID', $this->Deposit_id);
            $this->db->delete($this->Table->bank);
                           
    
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
}
