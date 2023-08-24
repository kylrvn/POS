<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Expense_services_model extends CI_Model
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


    //    public function add_expense(){
    //     try{     

    //         if(empty($this->date_added ||
    //                 $this->description||
    //                 $this->actual_money ||
    //                 $this->incharge||
    //                 $this->actual_expenses||
    //                 $this->bal||
    //                 $this->branch)){
    //             throw new Exception(MISSING_DETAILS, true);
    //         }

    //         $data = array(
    //             'Date' => $this->date_added,
    //             'Descr' => $this->description,
    //             'Actual_Money' => $this->actual_money,
    //             'Incharge' => $this->incharge,
    //             'expense' => $this->actual_expenses,
    //             'Balance' => $this->bal,
    //             'Branch' => $this->branch,
    //         );

    //         $this->db->trans_start();

    //         $this->db->insert($this->Table->expenses,$data);

    //         $this->db->trans_complete();
    //         if ($this->db->trans_status() === FALSE)
    //         {                
    //             $this->db->trans_rollback();
    //             throw new Exception(ERROR_PROCESSING, true);	
    //         }else{
    //             $this->db->trans_commit();
    //             return array('message'=>SAVED_SUCCESSFUL, 'has_error'=>false);
    //         }
    //     }
    //     catch(Exception$msg){
    //         return (array('message'=>$msg->getMessage(), 'has_error'=>true));
    //     }
    //    }

    public function add_expense()
    {
        try {
            $date = $this->input->post('Date_added');
            $description = $this->input->post('Desc');
            $actualMoney = $this->input->post('Actual_money');
            $incharge = $this->input->post('Incharge');
            $actualExpenses = $this->input->post('Actual_Expenses');
            $balance = $this->input->post('Balance');
            $branch = $this->input->post('Branch');

            // // Get the uploaded image file
            // $image = $_FILES['image'];

            // // Image upload configuration
            // $config['upload_path'] = FCPATH . 'assets/uploaded/proofs/'; 
            // $config['allowed_types'] = 'jpg|png|jpeg|gif'; 
            // // $config['encrypt_name'] = TRUE; // Encrypt the filename. Activate if u want encrypted name for image files.
            // $config['max_size'] = 10240; // 10 MB in bytes

            // $this->load->library('upload', $config);

            // // Upload the image
            // if ($this->upload->do_upload('image')) {
               
            //     $uploadData = $this->upload->data();
            //     $imagePath = $uploadData['file_name']; // Image file name
            // } else {
            //     throw new Exception('Image upload failed: ' . $this->upload->display_errors('', ''));
            // }

          
            $data = array(
                'Date' => $date,
                'Descr' => $description,
                'Actual_Money' => $actualMoney,
                'Incharge' => $this->session->ID,
                'expense' => $actualExpenses,
                'Balance' => $balance,
                'Branch' => $this->session->Branch,
                // 'Image' => $imagePath 
            );

            // Insert the data into the database
            $this->db->insert($this->Table->expenses, $data);

            return array('message' => 'Expense added successfully.', 'has_error' => false);
        } catch (Exception $e) {
            return array('message' => $e->getMessage(), 'has_error' => true);
        }
    }

    public function edit_expense()
    {
        try {
            $date = $this->input->post('Date_added');
            $description = $this->input->post('Desc');
            $actualMoney = $this->input->post('Actual_money');
            $incharge = $this->input->post('Incharge');
            $actualExpenses = $this->input->post('Actual_Expenses');
            $balance = $this->input->post('Balance');
            $branch = $this->input->post('Branch');
            $ID = $this->input->post('ID');
            $image_2 = $this->input->post('image_2');

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
                } else {
                    throw new Exception('Image upload failed: ' . $this->upload->display_errors('', ''));
                }

                $data = array(
                    'Date' => $date,
                    'Descr' => $description,
                    'Actual_Money' => $actualMoney,
                    'Incharge' => $this->session->ID,
                    'expense' => $actualExpenses,
                    'Balance' => $balance,
                    'Branch' => $this->session->Branch,
                    'Image' => $imagePath 
                );

            // Update the data into the database
            $this->db->where('ID', $ID);
            $this->db->update($this->Table->expenses, $data);

            return array('message' => 'Expense updated successfully.', 'has_error' => false);
        } catch (Exception $e) {
            return array('message' => $e->getMessage(), 'has_error' => true);
        }
    }
}
