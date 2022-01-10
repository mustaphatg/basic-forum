<?php
/**
 * CodeIgnighter layout support library
 *  with Twig like inheritance blocks
 *
 * v 1.0
 *
 *
 * @author Constantin Bosneaga
 * @email  constantin@bosneaga.com
 * @url    http://a32.me/
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout {
    private $obj;
    private $layout_view;
    private $title = '';
    private $css_list = array(), $js_list = array();


    function __construct(){
        $this->obj =& get_instance();
        $this->layout_view = "layout/default.php";
        // Grab layout from called controller
        if (isset($this->obj->layout_view)) $this->layout_view = $this->obj->layout_view;
    }

    function view($view, $data = null, $return = false) {
        // Render template
        $data['content_for_layout'] = $this->obj->load->view($view, $data, true);
        $data['title_for_layout'] = $this->title;

        // Render resources
        $data['js_for_layout'] = '';
        foreach ($this->js_list as $v)
            $data['js_for_layout'] .= sprintf('<script type="text/javascript" src="%s"></script>', $v);

        $data['css_for_layout'] = '';
        foreach ($this->css_list as $v)
            $data['css_for_layout'] .= sprintf('<link rel="stylesheet" type="text/css"  href="%s" />', $v);

        // Render template
  
        $output = $this->obj->load->view($this->layout_view, $data, $return);

        return $output;
    }

    /**
     * Set page title
     *
     * @param $title
     */
    function title($title) {
        $this->title = $title;
    }

    /**
     * Adds Javascript resource to current page
     * @param $item
     */
    function js($item) {
        $this->js_list[] = $item;
    }

    /**
     * Adds CSS resource to current page
     * @param $item
     */
    function css($item) {
        $this->css_list[] = $item;
    }



}