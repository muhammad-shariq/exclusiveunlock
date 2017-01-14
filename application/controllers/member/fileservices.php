<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class fileservices extends FSD_Controller 
{
	var $before_filter = array('name' => 'member_authorization', 'except' => array());
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('menu_model');
		$this->load->model('fileservices_model');
		$this->load->model('fileorder_model');
		$this->load->model('credit_model');
	}
	
	############ File Service Request Order Form for users ###########33
	
	public function index()
	{
		$data = array();
		$data['menu_header'] = $this->menu_model->get_tree((array('MenuID'=>1, 'ParentID'=>null,'Status'=>'Enabled')),1);
		$data['Title'] = "File Services";
		$data['template'] = "member/fileservices/fileservices";
		$data['services'] = $this->fileservices_model->get_all();
		$memberid = $this->session->userdata('MemberID');
		$data['credit'] = $this->credit_model->get_credit($memberid);
		if($data['credit'][0]['credit'] == ""  )
		{
			$data['credit'][0]['credit'] = 0;
		}
		$this->load->view('mastertemplate',$data);
	}
	
	function request()
	{
		$data = array();
		$data['menu_header'] = $this->menu_model->get_tree((array('MenuID'=>1, 'ParentID'=>null,'Status'=>'Enabled')),1);
		$data['Title'] = "File Services";
		$data['template'] = "member/fileservices/fileservices";
		$data['services'] = $this->fileservices_model->get_all();
		$data['credit'] = $this->credit_model->get_credit($id);
		if($data['credit'][0]['credit'] == ""  )
		{
			$data['credit'][0]['credit'] = 0;
		}
		$this->load->view('mastertemplate',$data);
	}

	function history()
	{
		$data = array();
		$data['menu_header'] = $this->menu_model->get_tree((array('MenuID'=>1, 'ParentID'=>null,'Status'=>'Enabled')),1);
		$id = $this->session->userdata('MemberID');
		$data['Title'] = "File Service History";
		$data['template'] = "member/fileservices/history";
		$data['credit'] = $this->credit_model->get_credit($id);
		if($data['credit'][0]['credit'] == ""  )
		{
			$data['credit'][0]['credit'] = 0;
		}
		$this->load->view('mastertemplate',$data);
	}
	
	function insert()
	{
		$this->load->library('form_validation');			
		
        $this->form_validation->set_rules('FileServiceID' , 'Service' ,'required');
        $this->form_validation->set_rules('Mobile' , 'Mobile No.' ,'required|numeric');
        $this->form_validation->set_rules('Email' , 'Email' ,'required|valid_email');        
        $this->form_validation->set_rules('Note' , 'Note' ,'');
		if($this->form_validation->run() === FALSE)
		{
			$this->index();
		}        
        else
        {
            $data = $this->input->post(NULL, TRUE);
            
            ## Get Member available credits ##
            $member_id = $this->session->userdata('MemberID');
            $credit = $this->credit_model->get_credit($member_id);
            
            ## Get Member custom price ##
            $result = $this->fileservices_model->get_member_price($member_id, $data['FileServiceID']);
            $price = abs($result[0]['Price']);
            $allowed_extension = str_replace(',', '|', $result[0]['AllowExtension']);            
            
            ## Count Total order price ##
            $file_data_total = count($_FILES['File']['name']);
            $file_price = $file_data_total * $price;
            
            ## Validate Credits with required credits ##
            if($file_price > $credit[0]['credit'])
            {
                $this->session->set_flashdata('fail', "You have not enough credit for the request.");
                redirect("member/fileservices/");
            }
         
            ## File uploads ##                    
            $uploaded_files = $this->upload_files($this->config->item('upload_fileservice_dir'), $allowed_extension);
            if( isset($uploaded_files['SUCCESS']) )
            {
                foreach($uploaded_files['SUCCESS'] as $file )
                {
                    $insert = array();
                    $insert['FileServiceID'] = $data['FileServiceID'];
                    $insert['Email'] = $data['Email'];
                    $insert['Mobile'] = $data['Mobile'];
                    $insert['Note'] = $data['Note'];
                    $insert['FileName'] = $file['file_name'];
                    $insert['IMEI'] = explode('.', $file['file_name'])[0];
                    $insert['MemberID'] = $member_id;
                    $insert['Status'] = "Pending";
                    $insert["CreatedDateTime"] = date("y-m-d H:i:s");
                    $insert["UpdatedDateTime"] = date("y-m-d H:i:s");
                    
                    $file_id = $this->fileorder_model->insert($insert);
                    
                    //deduct credit
                    $credit_data = array(
                        'MemberID' => $member_id,
                        'TransactionCode' => 'BFC',
                        'TransactionID' => $file_id,
                        'Description' => $file['file_name']." from File Service Request",
                        'Amount' => -1 * $price,
                        'CreatedDateTime' => date("Y-m-d H:i:s")
                    );
                    $this->credit_model->insert($credit_data);	
                }
                
                $this->session->set_flashdata('success', 'The order has been placed successfully');
                redirect('member/fileservices/');
            }
            $this->session->set_flashdata('fail', $uploaded_files['FAILED']);
            redirect("member/fileservices/");            
        }
	}

	public function filedata()
	{
		$id = $this->input->post('FileServiceID');
		$memberid = $this->session->userdata('MemberID');
		$result = $this->fileservices_model->get_member_price($memberid, $id);
        $data['price'] = $result[0]['Price'];
        $data['delivery_time'] = $result[0]['DeliveryTime'];
        $data['description'] = $result[0]['Description'];
        $data['allowed_extension'] = $result[0]['AllowExtension'];
		$this->load->view("member/fileservices/form", $data);
	}

	public function listener($status)
    {
        $id = $this->session->userdata('MemberID');
        echo $this->fileorder_model->get_file_data_select($id, $status);
    }		

    private function upload_files($path, $allowed_types)
    {
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => $allowed_types,
            'overwrite'     => 1,      
        );

        $this->load->library('upload', $config);
        //Configure upload.
        $this->upload->initialize($config);

        //Perform upload.
        if($this->upload->do_multi_upload("File")) 
        {
            //Code to run upon successful upload.
            return array( 'SUCCESS' => $this->upload->get_multi_upload_data());
        }      
        return array( 'FAILED' => strip_tags($this->upload->display_errors()) );
    }		
}