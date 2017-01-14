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
* CssRewrite Filter
*
* Cached assets usually won't be in the same location as the
* original ones, which means that URLs in CSS cached files will
* become incorrect. Therefore this filter will rewrite the URLs.
*/

class css_rewrite extends Sprinkle_Filter
{
	/**
	* Output
	*
	* @access	public
	* @param 	Asset 	asset object
	* @return	string	path to the temporary file
	*/

	public function output(\Sprinkle\Asset $asset)
	{
		$pathinfo = pathinfo($asset->location . $asset->src);
		$buffer = $asset->get_contents();
		
		preg_match_all('/url\([\'"]?(?<url>.*?)[\'"]?\)/', $buffer, $matches);

		if(count($matches[0]) > 0)
		{
			$paths = $matches[1];

			foreach($matches[0] as $k => $v)
			{
				// Rewrite the path only if it's not a URL
				if(!preg_match('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@', $paths[$k]))
				{
					$info    	= pathinfo($pathinfo['dirname'] . '/'. $paths[$k]);
					$new_path	= dirname($pathinfo['dirname'] .'/'. $paths[$k]) . '/' . $info['filename'] . '.' . $info['extension'];

					$buffer = str_replace($v, 'url('. $new_path .')', $buffer);
				}
			}
		}
	
		return $this->_save_file($asset, $buffer);
	}
}