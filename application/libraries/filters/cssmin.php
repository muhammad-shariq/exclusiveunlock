<?php

/**
 * Sprinkle - Asset management library
 * 
 * @author   			Edmundas Kondrašovas <as@edmundask.lt>
 * @license  			http://www.opensource.org/licenses/MIT
 */

namespace Sprinkle\Filters;

require_once(SPRINKLE_ROOT .'/libraries/Filter_Interface.php');
require_once(SPRINKLE_ROOT .'/vendor/CssMin/cssmin-v3.0.1.php');

/**
* CssMin Filter
*/

class cssmin extends Sprinkle_Filter
{
	protected $_settings = array
	(
		'filters' => array
		(
			"ImportImports"           		=> array("BasePath" => "path/to/base"),
			"RemoveComments"          		=> true, 
			"RemoveEmptyRulesets"     		=> true,
			"RemoveEmptyAtBlocks"     		=> true,
			"ConvertLevel3AtKeyframes"		=> array("RemoveSource" => false),
			"ConvertLevel3Properties" 		=> true,
			"Variables"               		=> true,
			"RemoveLastDelarationSemiColon" => true
		),
		'plugins' => array
		(
			"ImportImports"                	=> false,
			"RemoveComments"               	=> true, 
			"RemoveEmptyRulesets"          	=> true,
			"RemoveEmptyAtBlocks"          	=> true,
			"ConvertLevel3AtKeyframes"     	=> false,
			"ConvertLevel3Properties"      	=> false,
			"Variables"                    	=> true,
			"RemoveLastDelarationSemiColon"	=> true
		)
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
		$processed = \CssMin::minify($buffer, $this->_settings['filters'], $this->_settings['plugins']);

		return $this->_save_file($asset, $processed);
	}
}