<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Widget { 
 
    static $a = array();

    function Widget() { 
        $this->_assign_libraries();
    }

    function run($name, $data = array()) {
        self::$a = $data;
        $args = func_get_args();

        require_once APPPATH . 'widgets/' . $name . EXT;
        $arrname = explode('/', $name);
        $name = $arrname[sizeof($arrname) - 1];
        $name = ucfirst($name);

        $widget = new $name();
        return call_user_func_array(array(&$widget, 'run'), array_slice($args, 1));
    }

    function render($view, $data = array()) {// echo "jaoi"; exit;
        $ci = & get_instance();
        //$defaultThemes = $ci->config->item('themes');
        //$data = array_merge($data, self::$a);
        extract($data);
       
        include APPPATH . 'views/front/widgets/' . $view . EXT;
    }

    function theme($view, $data = array(), $ret = false) {
        $ci = & get_instance();
        $defaultThemes = $ci->config->item('themes');
        $view = 'themes/' . $defaultThemes . '/widgets/' . $view;
        $ci->load->view($view, $data, $ret);
    }

    function view($view, $data = array(), $ret = false) {
        $ci = & get_instance();
        return $ci->load->view($view, $data, $ret);
    }

    function load($object) {
        $this->$object = & load_class(ucfirst($object));
    }

    function _assign_libraries() {
        $ci = & get_instance();
        foreach (get_object_vars($ci) as $key => $object) {
            //echo $key . '<br/>';
            $this->$key = & $ci->$key;
        }
        
     function testf(){
         echo "hai";
     }
    }
 
}