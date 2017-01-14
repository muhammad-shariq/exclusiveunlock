<?php

/**
 * Sprinkle - Asset management library
 * 
 * @author 		Edmundas Kondrašovas <as@edmundask.lt>
 * @license		http://www.opensource.org/licenses/MIT
 */

namespace Sprinkle\Filters;

require_once(SPRINKLE_ROOT . '/libraries/Asset_Interface.php');

/**
 * Generic Sprinkle Filter Interface
 */

interface Sprinkle_Filter_Interface
{
	/**
	* Output
	*
	* @access	public
	* @param 	Asset	asset object
	* @return	string
	*/

	public function output(\Sprinkle\Asset $asset);
}

/**
 * Basic Sprinkle filter class implementing the interface above
 */

class Sprinkle_Filter implements Sprinkle_Filter_Interface
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
		$buffer = $this->get_contents();

		return $this->_save_file($asset, $buffer);
	}

	/**
	* Save the file
	*
	* @access	protected
	* @param 	Asset 	asset object
	* @param 	string	temporary file name
	* @param 	string	contents
	* @return	string	path to the temporary file
	*/

	protected function _save_file(\Sprinkle\Asset $asset, $contents)
	{
		// Attempt creating the tmp directory if it does not exist
		if(!is_dir($dir = SPRINKLE_ROOT .'/tmp/') && (@mkdir($dir, 0777, true) === FALSE)) return '';

		// Add some randomness to the filename to avoid name collisions.
		$file = $dir . $asset->filename . '-'. rand(1000, time()) .'.filtered';
		@file_put_contents($file, $contents);

		$asset->set_tmp($file);

		return $file;
	}

	/**
	* Set the configuration for the filter
	*
	* @access	public
	* @param 	array	settings array
	* @return	void
	*/

	public function settings($settings = array())
	{
		$this->_settings = array_merge($this->_settings, $settings);
	}
}