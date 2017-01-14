<?php

/**
 * Sprinkle - Asset management library
 * 
 * @author   			Edmundas Kondrašovas <as@edmundask.lt>
 * @license  			http://www.opensource.org/licenses/MIT
 */

namespace Sprinkle\Filters;

require_once(SPRINKLE_ROOT .'/libraries/Filter_Interface.php');
require_once(SPRINKLE_ROOT .'/vendor/leafo-lessphp/lessc.inc.php');

/**
* LessPHP Filter
*/

class lessphp extends Sprinkle_Filter
{
	protected $_settings = array();

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

		$lc = new \lessc();

		try
		{
			$processed = $lc->parse($buffer);
		}
		catch(Exception $e)
		{
			$processed = $buffer;
		}

		return $this->_save_file($asset, $processed);
	}
}

