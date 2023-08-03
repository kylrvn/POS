<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment_service extends MY_Controller
{
	private $data = [];
	protected $session;
	public function __construct()
	{
		parent::__construct();
		$this->session = (object)get_userdata(USER);

		// if(is_empty_object($this->session)){
		// 	redirect(base_url().'login/authentication', 'refresh');
		// }

		$model_list = [
			'payment/service/Payment_services_model' => 'psModel'
		];
		$this->load->model($model_list);
	}


	public function save_payment()
{
    $this->psModel->Incharge_ID = $this->session->ID;
    $this->psModel->Order_ID = $this->input->post("Order_id");
    $this->psModel->Amount_paid = $this->input->post("Amount_paid");
    $this->psModel->Payment_mode = $this->input->post("Payment_mode");
    $this->psModel->mockupFilename = $this->input->post("mockupFilename");

    // Check if an image file is uploaded
    if (!empty($_FILES['image']['name'])) {
        // Specify allowed file formats
        $allowedFormats = array('jpg', 'png', 'gif');
        // Array to store any error messages
        $errors = array();

        $fileName = $this->psModel->Order_ID . "_" . $_FILES['image']['name'];
        $fileType = $_FILES['image']['type'];
        $fileTemp = $_FILES['image']['tmp_name'];
        $fileSize = $_FILES['image']['size'];

        // Get the file extension
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);

        // Check if the file format is allowed
        if (in_array($fileExt, $allowedFormats)) {
            // Perform your file upload logic here
            // For example, move the uploaded file to a specific directory
            move_uploaded_file($fileTemp, 'assets/uploaded/proofs/' . $fileName);

            $this->psModel->Proof_of_reference = $fileName;
        } else {
            $errors[] = 'Invalid file format: ' . $fileName;
        }

        if (!empty($errors)) {
            // Handle error messages as needed
            $response = array(
                'has_error' => true,
                'message' => implode('<br>', $errors)
            );
            echo json_encode($response);
            return;
        }
    } else {
        $this->psModel->Proof_of_reference = '';
    }

    // Save payment details using the model
    $response = $this->psModel->save_payment();
    if ($response['has_error']) {
        echo json_encode($response);
        return;
    }

    // Success handling
    $response = array(
        'has_error' => false,
        'message' => 'Payment saved successfully.'
    );
    echo json_encode($response);
}
	

	public function update_details(){
		$this->psModel->Order_id = $this->input->post("Order_id");
		$this->psModel->Order_status = $this->input->post("Order_status");
		$this->psModel->Sewer = $this->input->post("Sewer");
		$this->psModel->Lay_artist = $this->input->post("Lay_artist");
		$this->psModel->Set_artist = $this->input->post("Set_artist");
		$this->psModel->b_note = $this->input->post("b_note");
		$this->psModel->d_note = $this->input->post("d_note");
		$this->psModel->freebies = $this->input->post("freebies");
		$this->psModel->d_date = $this->input->post("d_date");


		$response = $this->psModel->update_details();
		echo json_encode($response);
	}

	public function save_modal_req() {
		// Check if files are uploaded
		if (!empty($_FILES['files']['name'])) {
			// Specify allowed file formats
			$allowedFormats = array('jpg', 'png', 'docx', 'pdf');
			$O_ID = $this->input->get('oid');
			$C_ID = $this->input->get('cid');
			// Array to store any error messages
			$errors = array();
			$fileNames = array();
	
			// Loop through each uploaded file
			for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
				$fileName = $O_ID . "_". $C_ID. "_". $_FILES['files']['name'][$i];
				$fileType = $_FILES['files']['type'][$i];
				$fileTemp = $_FILES['files']['tmp_name'][$i];
				$fileSize = $_FILES['files']['size'][$i];
	
				// Get the file extension
				$fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
	
				// Check if the file format is allowed
				if (in_array($fileExt, $allowedFormats)) {
					// Perform your file upload logic here
					// For example, move the uploaded file to a specific directory
					move_uploaded_file($fileTemp, 'assets/uploaded/proofs/' . $fileName);
	
					$fileNames[] = $fileName;
				} else {
					$errors[] = 'Invalid file format: ' . $fileName;
				}
			}
	
			if (!empty($fileNames)) {
				// Insert file details into the database using the model
				$response = $this->psModel->submit_modal_req($fileNames, $O_ID);
				if ($response['has_error']) {
					$errors[] = $response['message'];
				}
			}
	
			if (!empty($errors)) {
				// Handle error messages as needed
				$response = array(
					'has_error' => true,
					'message' => implode('<br>', $errors)
				);
			} else {
				// Success handling
				$response = array(
					'has_error' => false,
					'message' => 'File(s) uploaded successfully for Requirement ID: ' . $O_ID
				);
			}
		} else {
			$response = array(
				'has_error' => true,
				'message' => 'No files were uploaded.'
			);
		}
	
		// Return response
		echo json_encode($response);
	}
}
