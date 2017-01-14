<?php

/**
 * Sprinkle - Asset management library
 * 
 * @author   			Edmundas Kondrašovas <as@edmundask.lt>
 * @license  			http://www.opensource.org/licenses/MIT
 */

namespace Sprinkle\Filters;

require_once(SPRINKLE_ROOT .'/libraries/Filter_Interface.php');

/**
* Prefixr Filter
*
* Utilizes prefixr.com API
*/

class prefixr extends Sprinkle_Filter
{
	protected $_settings = array
	(
		'service_url'		=>	'http://prefixr.com/api/index.php'
	);

	/**
	* Output
	*
	* @access	public
	* @param 	Asset 	asset object
	* @return	string	path to the temporary file
	*/

	public function output(\Sprinkle\Asset $asset)
	{
		$buffer = $asset->get_contents();

		if(!function_exists('curl_init'))
		{
			$processed = $buffer;
		}
		else
		{
			$handle = curl_init();

			curl_setopt($handle, CURLOPT_URL, $this->_settings['service_url']);
			curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($handle,CURLOPT_POST, 1);
			curl_setopt($handle,CURLOPT_POSTFIELDS, "css=". urlencode($buffer));
			curl_setopt($handle, CURLOPT_TIMEOUT, 10);

			$processed = curl_exec($handle);
			curl_close($handle);

			if(!$processed) $processed = $buffer;
		}

		return $this->_save_file($asset, $processed);
	}
}