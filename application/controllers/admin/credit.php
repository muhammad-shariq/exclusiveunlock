<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class credit extends FSD_Controller 
{
	var $before_filter = array('name' => 'authorization', 'except' => array());
	var $access = array('view' => '', 'add' => '', 'edit' => '', 'delete' => '');
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('credit_model');
		$this->load->model('employee_model');
		$this->load->model('member_model');
	}
	
	public function index()
	{
		$data['template'] = "admin/credit/list";
		$this->load->view('admin/master_template',$data);
	}
	
	public function listener()
	{
		echo $this->credit_model->get_datatable($this->access);
	}

	public function add()
	{
		$data['member'] = $this->member_model->get_all();		
		$data['template'] = "admin/credit/add";		
		$this->load->view('admin/master_template',$data);
	}

	public function insert()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('MemberID' , 'Member' ,'required');
		$this->form_validation->set_rules('Description' , 'Description' ,'required|min_length[3]|max_length[255]');
		$this->form_validation->set_rules('Amount' , 'Amount' ,'required|numeric');
		if($this->form_validation->run() === FALSE)
		{
			$this->add();
		}
		else
		{
			$data = $this->input->post(NULL,TRUE);	
			$transaction_id = 1 + $this->credit_model->get_max_transaction_id(array('TransactionCode' => CASH_PAYMENT_RECEIVED));
			$data['TransactionID'] = $transaction_id;
			$data['TransactionCode'] = CASH_PAYMENT_RECEIVED;
			$data['CreatedDateTime'] = date("Y-m-d H:i:s");
			
			$this->credit_model->insert($data);
			$this->session->set_flashdata('success', 'Record added successfully.');
			redirect("admin/credit/");
		}
	}			
}

/* End of file credit.php */
/* Location: ./application/controllers/admin/credit.php */