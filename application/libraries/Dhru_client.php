<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Dhru_client
{
    var $xmlData;
    var $xmlResult;
    var $debug;
    var $action;
	//Constants
	var $DHRUFUSION_URL;
	var $USERNAME;
	var $API_ACCESS_KEY;
	
    function __construct($params)
    {
        $this->DHRUFUSION_URL = $params['host'];
		$this->USERNAME = $params['username'];
		$this->API_ACCESS_KEY = $params['key'];
		$this->xmlData = new DOMDocument();
    }
	
    function getResult()
    {
        return $this->xmlResult;
    }
	
    function action($action, $arr = array())
    {
        if (is_string($action))
        {
            if (is_array($arr))
            {
                if (count($arr))
                {
                    $request = $this->xmlData->createElement("PARAMETERS");
                    $this->xmlData->appendChild($request);
                    foreach ($arr as $key => $val)
                    {
                        $key = strtoupper($key);
                        $request->appendChild($this->xmlData->createElement($key, $val));
                    }
                }
                $posted = array(
                    'username' => $this->USERNAME,
                    'apiaccesskey' => $this->API_ACCESS_KEY,
                    'action' => $action,
                    'requestformat' => "JSON",
                    'parameters' => $this->xmlData->saveHTML());
                $crul = curl_init();
                curl_setopt($crul, CURLOPT_HEADER, false);
                curl_setopt($crul, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
                //curl_setopt($crul, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($crul, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($crul, CURLOPT_URL, $this->DHRUFUSION_URL.'/api/index.php');
                curl_setopt($crul, CURLOPT_POST, true);
                curl_setopt($crul, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($crul, CURLOPT_POSTFIELDS, $posted);
                $response = curl_exec($crul);
                if (curl_errno($crul) != CURLE_OK)
                {
                    echo curl_error($crul);
                    curl_close($crul);
                }
                else
                {
                    curl_close($crul);
                    // $response = XMLtoARRAY(trim($response));
                    if ($this->debug)
                    {
                        echo "<textarea rows='20' cols='200'> ";
                        print_r($response);
                        echo "</textarea>";
                    }
                    return (json_decode($response, true));
                }
            }
        }
        return false;
    }
}