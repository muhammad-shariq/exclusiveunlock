<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Filter Class
 *
 * This class enables you to integrate filters like in rails into your web apps.
 *
 * @package     CodeIgniter
 * @subpackage  Hooks
 * @category    Hooks
 * @author      dioony
 * @version     1.0
 */
class Filter
{


    function doBeforeFilter(){
        $CI =& get_instance();
        $router =& load_class('Router');
        $called_function = $router->fetch_method();
        if(isset($CI->before_filter)){
            if(!isset($CI->before_filter["name"])){
                show_error("BeforeFilter: Name must be set");
            }else{
                if(method_exists($CI,$CI->before_filter["name"])){
                    if(isset($CI->before_filter["except"]) && isset($CI->before_filter["only"])){
                        show_error("BeforeFilter: Filter can only run either \"except\" or \"only\"");
                    }else{
                        if(isset($CI->before_filter["except"])){
                            if(!empty($CI->before_filter["except"])){
                                if(!in_array($called_function, $CI->before_filter["except"])){
                                    call_user_func(array($CI,$CI->before_filter["name"]));
                                }
                            }else{
                                call_user_func(array($CI,$CI->before_filter["name"]));
                            }
                        }else{
                            if(isset($CI->before_filter["only"])){
                                if(!empty($CI->before_filter["only"])){
                                    if(in_array($called_function, $CI->before_filter["except"])){
                                        call_user_func(array($CI,$CI->before_filter["name"]));
                                    }
                                }else{
                                    call_user_func(array($CI,$CI->before_filter["name"]));
                                }
                            }else{
                                call_user_func(array($CI,$CI->before_filter["name"]));
                            }
                        }
                    }
                }else{
                    show_error("BeforeFilter: Function \"".$CI->before_filter["name"]."\" does not exists");
                }
            }
        }
    }
    
}

?>