<?php

/**
 * 
 */
class SWAQ_Elementor_Addon
{
    
    protected static $instance = null;

    public static function get_instance() {
        if ( ! isset(static::$instance )) {
            # code...
            static::$instance = new static;
        }

        return static::$instance;
    }

    protected function __construct() {
        require_once('path/name_of_plugin'); # add your plugin path and filename
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets'] );
    }

    public function register_widgets() {
        \Elementor\Plugin::instance()=>widgets_manager->register_widget_type(new \Elementor\Widget_ClassName) # add your Widget_ClassName
    }
}

add_action( 'init', 'SWAQ_elementor_init');
function SWAQ_elementor_init() {
    SWAQ_Elementor_Addon::get_instance();
}

?>