<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class bulksms{
	
	
	var $bulksms_host = "http://www.bulksms.co.uk";
	var $bulksms_username = "areeb";
	var $bulksms_password = "IamBest2";
	
	
	
	function initialize($host,$username,$password)
	{
		$this->bulksms_host = $host;
		$this->bulksms_username = $username;
		$this->bulksms_password = $password;
	}
	
	
	
	function sms_credits() {
	$url = file_get_contents($this->bulksms_host.":5567/eapi/user/get_credits/1/1.1?username=".urlencode($this->bulksms_username)."&password=".urlencode($this->bulksms_password));
	$url = explode("|",$url);	
	return $url[1];
	}
	
	
	
	
	
		// SEND SMS
	function send_sms($number,$message) {
			
	//==================================== Simple PHP code sample ==========================================//
		
		/*
		* This example requires allow_url_fopen to be enabled in php.ini. If it is not enabled, file_get_contents()
		* will return an empty result. 
		* 
		* We recommend that you use port 5567 instead of port 80, but your
		* firewall will probably block access to this port (see FAQ for more
		* details):
		* $url = 'http://bulksms.vsms.net:5567/eapi/submission/send_sms/2/2.0';
		* 
		* Please note that this is only for illustrative purposes, we strongly recommend that you use our comprehensive */
		
		$check_1 = substr($number,0,1);
		$check_1_2 = substr($number,1,1);
		$check_2 = substr($number,0,1);
		$check_3 = substr($number,0,2);
		
		if($check_1=="0" && $check_1_2 > 0) {
			$number = ltrim($number,"0");
			$number = "44".$number;
		}
		
		if($check_2=="+") {
			$number = ltrim($number,"+");
		}
		
		if($check_3=="00") {
			$number = ltrim($number,"00");
		}
	
		
			$username = $this->$this->bulksms_username;
			$password = $this->bulksms_password;
			$msisdn = $number;
			$message = substr($message,0,160);
			
			$url = $this->bulksms_host.'/eapi/submission/send_sms/2/2.0';
			$port = 80;
		
		
		/*
		* We recommend that you use port 5567 instead of port 80, but your
		* firewall will probably block access to this port (see FAQ for more
		* details):
		* $port = 5567;
		*/
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_PORT, $port);
		curl_setopt ($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		$post_body = '';
		
		$post_fields = array(
			username => $username,
			password => $password,
			message => $message,
			msisdn => $msisdn
		);
		
		foreach($post_fields as $key=>$value) {
			$post_body .= urlencode($key).'='.urlencode($value).'&';
		}
		$post_body = rtrim($post_body,'&');
		
		# Do not supply $post_fields directly as an argument to CURLOPT_POSTFIELDS,
		# despite what the PHP documentation suggests: cUrl will turn it into in a
		# multipart formpost, which is not supported:
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $post_body);
		$response_string = curl_exec($ch);
		$curl_info = curl_getinfo($ch);
		
		if ($response_string == FALSE) {
			//print "cURL error: ".curl_error($ch)."\n";
		} elseif ($curl_info['http_code'] != 200) {
			//print "Error: non-200 HTTP status code: ".$curl_info['http_code']."\n";
		}
		else {
			//print "Response from server:$response_string\n";
			$result = split('\|', $response_string);
			if (count($result) != 3) {
				//print "Error: could not parse valid return data from server.\n".count($result);
			} else {
				if ($result[0] == '0') {
					//print "Message sent - batch ID $result[2]\n";
				}
				else {
					//print "Error sending: status code [$result[0]] description [$result[1]]\n";
				}
			}
		}
		curl_close($ch);
	}
	
	
		//Bulk SMS Send
	function send_bulksms($array) {
			
		//Example String
		//$sCSV="msisdn,message"."\n".'"923332691187","Hello shariq"';	
	
		$sCSV = $this->array_2_csv($array);
		$username = $this->bulksms_username;
		$password = $this->bulksms_password;
		
		$url = $this->bulksms_host.'/eapi/submission/send_batch/1/1.0';
		$port = 80;
		/*
		* We recommend that you use port 5567 instead of port 80, but your
		* firewall will probably block access to this port (see FAQ for more
		* details):
		* $port = 5567;
		*/
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_PORT, $port);
		curl_setopt ($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		$post_body = '';
		
		$post_fields = array(
			username => $username,
			password => $password,
			batch_data => $sCSV
		);
	
		foreach($post_fields as $key=>$value) {
			$post_body .= urlencode($key).'='.urlencode($value).'&';
		}
		$post_body = rtrim($post_body,'&');
	
		# Do not supply $post_fields directly as an argument to CURLOPT_POSTFIELDS,
		# despite what the PHP documentation suggests: cUrl will turn it into in a
		# multipart formpost, which is not supported:
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $post_body);
		$response_string = curl_exec($ch);
		$curl_info = curl_getinfo($ch);
		
		if ($response_string == FALSE) {
			//print "cURL error: ".curl_error($ch)."\n";
		} elseif ($curl_info['http_code'] != 200) {
			//print "Error: non-200 HTTP status code: ".$curl_info['http_code']."\n";
		}
		else {
			//print "Response from server:$response_string\n";
			$result = split('\|', $response_string);
			if (count($result) != 3) {
				print "Error: could not parse valid return data from server.\n".count($result);
			} else {
				if ($result[0] == '0') {
					print "Message sent - batch ID $result[2]\n";
				}
				else {
					print "Error sending: status code [$result[0]] description [$result[1]]\n";
				}
			}
		}
		curl_close($ch);
	}

	function array_2_csv($array) {
	    $csv = array();
	    foreach ($array as $item) {
	        if (is_array($item)) {
	            $csv[] = $this->array_2_csv($item);
	        } else {
	            $csv[] = $item;
	        }
	    }
	    return implode(',', $csv);
	} 
	
}
