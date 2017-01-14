<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * FSD Library By Shariq
 */
class Fsd
{	
	public function __construct() 
	{
		$this->CI =& get_instance();
		$this->CurrencyCode = array(
			'USD' => '$', 
			'GBP' => '&pound;', 
			'EUR' => '&euro;' 
		); 	
	}
	
	public function sent_email($from_email, $from_name, $to_email, $subject, $message, $attachments = array() )
	{
		$this->CI->load->library('email');		
		$config['mailtype'] = 'html';		
		
		$this->CI->email->initialize($config);
		
		$this->CI->email->from($from_email, $from_name);
		$this->CI->email->to($to_email);		
		$this->CI->email->subject($subject);
		$this->CI->email->message($message);
		
		if(count($attachments)>0)
		{
			foreach ($attachments as $field_name) 
			{
				$upload_path = $this->CI->config->item('upload_email_dir');
				$allowed_types = 'psd|eps|ai|tiff|jpg|gif|png|doc|xls|docx|xlsx';
				$data = $this->do_upload($field_name, $upload_path, $allowed_types);
				if(!isset($data['error']))
				{
					$this->CI->email->attach($data['upload_data']['file_path'].$data['upload_data']['file_name']);	
				}	
			}		
		}		
		return $this->CI->email->send();		
		//echo $this->CI->email->print_debugger();
	}

	public function do_upload($field_name, $upload_path, $allowed_types = 'gif|jpg|png')
	{
		$config['upload_path'] = $upload_path;
		$config['allowed_types'] = $allowed_types;
		$config['max_size']	= '20480'; //in KB

		$this->CI->load->library('upload', $config);

		if ( ! $this->CI->upload->do_upload($field_name))
		{
			return array('error' => $this->CI->upload->display_errors());
		}
		else
		{
			return array('upload_data' => $this->CI->upload->data());
		}
	}
	
	public function email_template($post, &$from_email, &$from_name,&$to_email, &$subject, &$message)
	{
		$this->CI->load->model('autoresponder_model');
		$tags = array();
		$values  = array();
		
		$data = $this->CI->autoresponder_model->get_tags();
		foreach ($data as $v) 
		{
			if(isset($post[$v['FieldName']]))
			{
				$tags[] = $v['Tag'];
				$values[] = $post[$v['FieldName']];				
			}
		}
		
		$from_name = str_replace($tags, $values, $from_name);
		$from_email = str_replace($tags, $values, $from_email);
		$to_email = str_replace($tags, $values, $to_email);
		$subject = str_replace($tags, $values, $subject);
		$message = str_replace($tags, $values, $message);		
	}
}
