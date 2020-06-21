<?php

namespace SWAQElementorAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Albums Carousel
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */

class Single_Default_Post_Grid extends Widget_Base { #add ClassName

    public function get_name() {
        return 'Single_Default_Post_Grid';
    }

    public function get_title() {
        return 'Single Default Post Grid';
    }

    public function get_icon() {
        return 'fa fa-font';
    }

    public function get_categories() {
        return [ 'addon' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section-title',
            [
                'label' => _('Content', 'elementor' ),
            ]
            );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

    }

    protected function _content_template() {
        
    }
	

}

?>