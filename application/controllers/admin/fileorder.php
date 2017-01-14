<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class fileorder extends FSD_Controller 
{
	var $before_filter = array('name' => 'authorization', 'except' => array());
	var $access = array('view' => '', 'add' => '', 'edit' => '', 'delete' => '');
	var $status;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('fileorder_model');
		$this->load->model('fileservices_model');
		$this->load->model('credit_model');
        $this->load->model('autoresponder_model');
        $this->load->model('member_model');
        $this->status = array(''=>'', 'Pending'=>'Pending', 'Issued'=>'Issued', 'Canceled'=>'Canceled');
	}
	
	public function index()
	{
		$service_list = array();
		foreach ($this->fileservices_model->get_all() as $value) 
		{
			$service_list[] = $value['Title'];
		}
		$data['service_list'] = json_encode($service_list);
		$data['template'] = "admin/fileorder/list";
		
		$this->load->view('admin/master_template',$data);
	}
	
	public function listener()
	{
		echo $this->fileorder_model->get_datatable($this->access);
	}

	public function edit($id)
	{
		$service_list = array(''=>'');
		foreach ($this->fileservices_model->get_all() as $value) 
		{
			$service_list[$value['ID']] = $value['Title'];
		}
		$data['service_list'] = $service_list;
		$data['status_list'] = $this->status;
		$data['data'] = $this->fileorder_model->get_where(array('ID'=> $id));			
		$data['template'] = "admin/fileorder/edit";
		
		$this->load->view('admin/master_template',$data);
	}
		
	public function delete($id)
	{
		$id = $this->input->get('id',TRUE);
		$this->fileorder_model->delete($id);
		$this->session->set_flashdata('success', 'Record delete successfully.');
		redirect("admin/fileorder/");
    }		

	public function update()
	{
		$this->load->library('form_validation');
		$data = $this->input->post(NULL,TRUE);
		$id = $data['ID'];		
				
		$this->form_validation->set_rules('FileServiceID' , 'Method' ,'required');
		$this->form_validation->set_rules('Maker' , 'Maker' ,'');
		$this->form_validation->set_rules('Model' , 'Model' ,'');
		$this->form_validation->set_rules('IMEI' , 'IMEI' ,'required');
		$this->form_validation->set_rules('Email' , 'Email' ,'required|valid_email');
		$this->form_validation->set_rules('Mobile' , 'Mobile No' ,'');
		$this->form_validation->set_rules('Note' , 'Note' ,'');
		$this->form_validation->set_rules('Comments' , 'Comments' ,'');		
		if($this->form_validation->run() === FALSE)
		{
			$this->edit($id);
		}
		else
		{
			unset($data['ID']);					
			$data['UpdatedDateTime'] = date("Y-m-d H:i:s");
						
			$this->fileorder_model->update($data, $id);
			$this->session->set_flashdata('success', 'Record updated successfully.');
			redirect("admin/fileorder/");
		}
	}
	
	public function bulk()
	{
		$json = $this->input->post('json',TRUE);
		$ids = json_decode($json);
		
		if(count($ids) < 1 )
		{
			$this->session->set_flashdata('error', 'No record selected.');
			redirect("admin/fileorder/");				
		}
		$data['data'] = $this->fileorder_model->get_where_in($ids);
		$data['template'] = "admin/fileorder/bulk";
		$this->load->view('admin/master_template',$data);			
	}
	
	public function bulk_operation()
	{
		$post = $this->input->post(NULL, TRUE);
		## Refund Issue to selected codes ##
        if(isset($post['refund']) && count($post['refund'])>0)
        {
            foreach ($post['refund'] as $id) 
            {
                $order = $this->fileorder_model->get_where(array( 'ID' => $id ));
                if(isset($order[0]) && count($order) > 0)
                {
                    $data = array();
                    $data['Code'] = empty($post['Code'][$id])? NULL: $post['Code'][$id];
                    $data['Comments'] = empty($post['Comments'][$id])? NULL: $post['Comments'][$id];
                    $data['Status'] = 'Canceled';
                    $data['UpdatedDateTime'] = date("Y-m-d H:i:s");									
                    $this->fileorder_model->update($data, $id);
                    
                    ## Amount Refund ##
                    $this->credit_model->refund($id, BROUTFORCE_CODE_REQUEST, $order[0]['MemberID']);
                    ## Get Canceled Email Template ##
                    $data = $this->autoresponder_model->get_where(array('Status' => 'Enabled', 'ID' => 6)); // File Code Canceled
                    ## Send Email with Template ## 		
                    if(isset($data) && count($data)>0)
                    {
                        $from_name = $data[0]['FromName'];
                        $from_email = $data[0]['FromEmail'];
                        $to_email = $data[0]['ToEmail'];	
                        $subject = $data[0]['Subject'];
                        $message = html_entity_decode($data[0]['Message']);
                        //get member information
                        $member = $this->member_model->get_where(array('ID' => $data['MemberID']));
                        //Information
                        $param['Code'] = empty($post['Code'][$id])? NULL: $post['Code'][$id];
                        $param['IMEI'] = $order['IMEI'];
                        $param['FirstName'] = $member[0]['FirstName'];
                        $param['LastName'] = $member[0]['LastName'];
                        $param['Email'] = $member['Email'];
            
                        $this->fsd->email_template($param, $from_email, $from_name, $to_email, $subject, $message );
                        $this->fsd->sent_email($from_email, $from_name,$to_email, $subject, $message );
                    }
                }		
            } // foreachend
        }
		## Bulk Isse code ##
		foreach ($post['Code'] as $id => $code) 
		{
			if( !empty($code) && ( !isset($post['refund']) || !in_array($id, $post['refund']) ) )
			{
				$order = $this->fileorder_model->get_where(array( 'ID' => $id ));
				if(isset($order[0]) && count($order) > 0)
				{				
					$data = array();
					$data['Code'] = $code;
					$data['Status'] = 'Issued';
					$data['UpdatedDateTime'] = date("Y-m-d H:i:s");									
					$this->fileorder_model->update($data, $id);
					## Get Issue Email Template ##
					$data = $this->autoresponder_model->get_where(array('Status' => 'Enabled', 'ID' => 7)); // File Code Issed
					## Send Email with Template ## 		
					if(isset($data) && count($data)>0)
					{
						$from_name = $data[0]['FromName'];
						$from_email = $data[0]['FromEmail'];
						$to_email = $data[0]['ToEmail'];
						$subject = $data[0]['Subject'];
						$message = html_entity_decode($data[0]['Message']);
						//get member information
						$member = $this->member_model->get_where(array('ID' => $data['MemberID']));
						//Information
						$param['Code'] = $code;
						$param['IMEI'] = $order['IMEI'];
						$param['FirstName'] = $member[0]['FirstName'];
						$param['LastName'] = $member[0]['LastName'];
						$param['Email'] = $member['Email'];						
					
						$this->fsd->email_template($param, $from_email, $from_name, $to_email, $subject, $message );
						$this->fsd->sent_email($from_email, $from_name,$to_email, $subject, $message );
					}				
				}
			}
		}
		$this->session->set_flashdata('success', 'Bulk operation has been successfully completed.');
		redirect("admin/fileorder/");
	}
	
	############# Cancel File Services Request Order ##############
	
	public function cancel($id)
	{
        $order = $this->fileorder_model->get_where(array( 'ID' => $id ));
        if(isset($order[0]) && count($order) > 0)
        {
            $data = array();
            $data['Code'] = empty($post['Code'][$id])? NULL: $post['Code'][$id];
            $data['Comments'] = empty($post['Comments'][$id])? NULL: $post['Comments'][$id];
            $data['Status'] = 'Canceled';
            $data['UpdatedDateTime'] = date("Y-m-d H:i:s");									
            $this->fileorder_model->update($data, $id);
            
            ## Amount Refund ##
            $this->credit_model->refund($id, BROUTFORCE_CODE_REQUEST, $order[0]['MemberID']);
            ## Get Canceled Email Template ##
            $data = $this->autoresponder_model->get_where(array('Status' => 'Enabled', 'ID' => 6)); // File Code Canceled
            ## Send Email with Template ## 		
            if(isset($data) && count($data)>0)
            {
                $from_name = $data[0]['FromName'];
                $from_email = $data[0]['FromEmail'];
                $to_email = $data[0]['ToEmail'];	
                $subject = $data[0]['Subject'];
                $message = html_entity_decode($data[0]['Message']);
                //get member information
                $member = $this->member_model->get_where(array('ID' => $data['MemberID']));
                //Information
                $param['Code'] = empty($post['Code'][$id])? NULL: $post['Code'][$id];
                $param['IMEI'] = $order['IMEI'];
                $param['FirstName'] = $member[0]['FirstName'];
                $param['LastName'] = $member[0]['LastName'];
                $param['Email'] = $member['Email'];
    
                $this->fsd->email_template($param, $from_email, $from_name, $to_email, $subject, $message );
                $this->fsd->sent_email($from_email, $from_name,$to_email, $subject, $message );
            }
            $this->session->set_flashdata('success', 'Order has been cancelled successfully.');
            redirect("admin/fileorder/");            
        }
        $this->session->set_flashdata('error', 'No record exist with this id.');
        redirect("admin/fileorder/");	        
	}
}

/* End of file fileorder.php */
/* Location: ./application/controllers/admin/fileorder.php */