<?php

/**
 * Sprinkle - Asset management library
 * 
 * @author 		Edmundas Kondrašovas <as@edmundask.lt>
 * @license		http://www.opensource.org/licenses/MIT
 */

namespace Sprinkle;

interface Sprinkle_Asset_Interface
{
	/**
	* Load asset parameters
	*
	* @access	public
	* @return	void
	*/

	public function load_params($params);

	/**
	* Get contents of the asset
	*
	* @access	public
	* @return	string	asset contents
	*/

	public function get_contents();

	/**
	* MD5 checksum of the asset
	*
	* @access	public
	* @return	string	asset contents
	*/

	public function get_contents_md5();

	/**
	* Get the time when the file was last modified
	*
	* @access	public
	* @return	integer
	*/

	public function get_last_modified();

	/**
	* Check if the asset has filters assigned to it
	*
	* @access	public
	* @return	boolean
	*/

	public function has_filters();

	/**
	* Set temporary file path
	*
	* @access	public
	* @param 	string	realpath to the tmp file
	* @return	void
	*/

	public function set_tmp($filepath);

	/**
	* Assign asset to a particular group
	*
	* @access	public
	* @param 	string	group name
	* @return	void
	*/

	public function assign_to_group($group);

	/**
	* Cache the asset
	*
	* @access	public
	* @return	void
	*/

	public function cache();

	/**
	* Is the asset already cached?
	*
	* @access	public
	* @return	boolean
	*/

	public function is_cached();

	/**
	* Assign filter to the asset
	*
	* @access	public
	* @return	void
	*/

	public function add_filter($name);
}

class Asset implements Sprinkle_Asset_Interface
{
	protected $_params = array();

	protected $last_modified;
	protected $tmp_file;
	protected $cached_file;

	public function __construct($params = array())
	{
		$this->load_params($params);
	}

	/**
	* Load asset parameters
	*
	* @access	public
	* @return	void
	*/

	public function load_params($params = array())
	{
		$this->_params = array_merge($this->_params, $params);
	}

	/**
	* Get asset contents from a local file
	*
	* @access	public
	* @return	string	asset contents
	*/

	public function get_contents()
	{
		$path = (!empty($this->tmp_file)) ? $this->tmp_file : $this->full_path;
		$path = ($this->is_cached() && empty($this->tmp_file)) ? $this->cached_file : $path;
		
		return @file_get_contents($path);
	}

	/**
	* MD5 checksum of the asset
	*
	* @access	public
	* @return	string	(optional) asset contents
	*/

	public function get_contents_md5()
	{
		$contents = $this->get_contents();

		return hash('md5', $contents);
	}

	/**
	* Get the time when the file was last modified
	*
	* @access	public
	* @return	integer
	*/

	public function get_last_modified()
	{
		return filemtime($this->full_path);
	}

	/**
	* Check if the asset has filters assigned to it
	*
	* @access	public
	* @return	boolean
	*/

	public function has_filters()
	{
		if(!array_key_exists('filters', $this->_params) || count($this->_params['filters']) === 0) return FALSE;

		return TRUE;
	}

	/**
	* Set temporary file path
	*
	* @access	public
	* @param 	string	realpath to the tmp file
	* @return	void
	*/

	public function set_tmp($filepath)
	{
		// Remove previous tmp file if such exists
		if(!empty($this->tmp_file)) @unlink($this->tmp_file);

		$this->tmp_file = $filepath;
	}

	/**
	* Assign asset to a particular group
	*
	* @access	public
	* @param 	string	group name
	* @return	void
	*/

	public function assign_to_group($group)
	{
		$this->_params['group'] = $group;
	}

	/**
	* Cache the asset
	*
	* @access	public
	* @return	void
	*/

	public function cache()
	{
		$filename_hash = substr(hash("md5", ($this->filename . $this->selected_version . $this->src)), 0, 8);
		$this->cached_file = $this->cache_dir . $this->filename . '-' . $this->selected_version . '-'. $filename_hash . '.'. $this->type;
		@file_put_contents($this->cached_file, $this->get_contents());
	}

	/**
	* Is the asset already cached?
	*
	* @access	public
	* @return	boolean
	*/

	public function is_cached()
	{
		$filename_hash = substr(hash("md5", ($this->filename . $this->selected_version . $this->src)), 0, 8);
		$file = $this->cache_dir . $this->filename . '-' . $this->selected_version . '-'. $filename_hash . '.'. $this->type;

		if(is_file(realpath($file)))
		{
			$this->cached_file = $file;
			return TRUE;
		}

		return FALSE;
	}

	/**
	* Assign filter to the asset
	*
	* @access	public
	* @return	void
	*/

	public function add_filter($name)
	{
		if(!in_array($name, $this->_params['filters'])) $this->_params['filters'][] = $name;
	}

	/**
	* Magic method for getting asset attributes
	*
	* @access	public
	* @return	mixed	returns an attribute based on the key
	*/

	public function __get($variable)
	{
		if(isset($this->_params[$variable])) 
			return $this->_params[$variable];

		if(isset($this->$variable))
			return $this->$variable;

		return NULL;
	}
}

class RemoteAsset extends Asset
{
	/**
	* Get asset contents from a remote server
	*
	* @access	public
	* @return	string	asset contents
	*/
	
	public function get_contents()
	{
		// The file was already downloaded (and probably processed in some way), so get contents from there.
		if(!empty($this->tmp_file)) return @file_get_contents($this->tmp_file);

		// If asset already exists in the cache (for ex, it was pre-baked), get the cached contents.
		if($this->is_cached()) return @file_get_contents($this->cached_file);

		// If cURL is not available or we don't want to use it, use file_get_contents() instead.
		if(!function_exists('curl_init') || $this->use_curl === FALSE)
		{
			if(FALSE === $buffer = @file_get_contents($this->full_path)) return '';

			return $buffer;
		}
		else
		{
			$handle = curl_init();

			curl_setopt($handle, CURLOPT_URL, $this->full_path);
			curl_setopt($handle, CURLOPT_HEADER, 0);
			curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($handle, CURLOPT_TIMEOUT, 10);
			// Make sure https protocol is also available for us
			curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);

			$buffer = curl_exec($handle);
			curl_close($handle);

			if(!$buffer) return '';

			return $buffer;
		}
	}

	/**
	* Get the time when the file was last modified
	*
	* @access	public
	* @return	integer
	*/

	public function get_last_modified()
	{
		// Let's be smart and don't look for information that we already have.
		if(!empty($this->last_modified)) return $this->last_modified;

		// We use file_get_contents() instead of cURL because the latter one is for some reason VERY SLOW.
		if(FALSE !== @file_get_contents($this->full_path, FALSE, stream_context_create(array('http' => array('method' => 'HEAD')))))
		{
			foreach ($http_response_header as $header)
			{
				if(0 === stripos($header, 'Last-Modified: '))
				{
					list(, $mtime) = explode(':', $header, 2);
					$this->last_modified = strtotime(trim($mtime));

					return $this->last_modified;
				}
			}
		}
		else
		{
			return 0;
		}
	}
}

class FileAsset extends Asset
{

}

