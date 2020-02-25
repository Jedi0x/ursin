<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');



/**
* Layout  ::  HOOKS
*
* Adds layout support :: Similar to RoR <%= yield =>
* '{_content}' will be replaced with all output generated by the controller/view.
*/
class _Layout{
    
    public function doLayout()
    {
       
        global $OUT;
        $CI =& get_instance();
        $output = $CI->output->get_output();
        $default = APPPATH.'../modules/'.'views/layouts/default.php';
        $view = '';
        if(isset($CI->layout))
        {
            if(!preg_match('/(.+).php$/', $CI->layout)){
                $CI->layout .= '.php';
            }
            $requested = APPPATH.'../modules/'.$CI->layout;
            if(file_exists($requested)){
                $layout = $CI->load->file($requested, true);
                $view = str_replace("{_title}", $output, $layout);
            }
        }
        elseif(file_exists($default)){
            $layout = $CI->load->file($default, true);
            $view = str_replace("{_title}", $output, $layout);
        }
        else
        {
            $view = $output;
        }
        $OUT->_display($view);

    }

    // NEW LAYOUT TEMPLATE
    public function render() {
        
        global $OUT;
        $CI = & get_instance();
        $output = $CI->output->get_output();

        if (!isset($CI->layout)) {
            $CI->layout = "default";
        }

        if ($CI->layout != false) {
            if (!preg_match('/(.+).php$/', $CI->layout)) {
                $CI->layout .= '.php';
            }

            $requested = APPPATH.'../modules/'.$CI->layout;

            $default = APPPATH.'../modules/'.'views/layouts/default.php';

            if (file_exists($requested)) {
                $layout = $CI->load->file($requested, true);
            } else {
                $layout = $CI->load->file($default, true);
            }

            $view = str_replace("{content}", $output, $layout);
            $view = str_replace("{title}", $CI->title, $view);

            $scripts = "";
            $styles = "";
            $metas = "";
            if (!empty($CI->meta) && count($CI->meta) > 0) {     // meta tags
                $metas = implode("\n", $CI->meta);
            }
            if (!empty($CI->scripts) && count($CI->scripts) > 0) {  // scripts
                foreach ($CI->scripts as $script) {
                    $scripts .= "<script type='text/javascript' src='assets/js/" . $script . ".js'></script>";
                }
            }
            if (!empty($CI->styles) && count($CI->styles) > 0) {   // styles
                foreach ($CI->styles as $style) {
                    $styles .= "<link rel='stylesheet' type='text/css' href='assets/css/" . $style . ".css' />";
                }
            }

            if (!empty($CI->parts) && count($CI->parts) > 0) {    // parts
                foreach ($CI->parts as $name => $part) {
                    $view = str_replace("{" . $name . "}", $part, $view);
                }
            }
            $view = str_replace("{metas}", $metas, $view);
            $view = str_replace("{scripts}", $scripts, $view);
            $view = str_replace("{styles}", $styles, $view);
  
        } else {
            $view = $output;
        }
        $OUT->_display($view);
    }


}

?>