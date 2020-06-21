<?php

namespace SWAQElementorAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * SWAQ Elementor Addon
 *
 *
 * @since 1.0.0
 */

class Single_Default_Post_Grid extends Widget_Base { #add ClassName

    public function get_name() {
        return 'Single_Default_Post_Grid';
    }

    public function get_title() {
        return __( 'SWAQ Default Post Grid', 'elementor' );
    }

    public function get_icon() {
        return 'fa fa-font';
    }

    public function get_categories() {
        return 'SWAQ Elementor Addon';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'swaq' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
            );
            $this->add_control(
                'tagline',
                [
                    'label' => __( 'Tagline', 'swaq' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => __( 'Type your tagline here', 'swaq' ),
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'settings',
            [
                'label' => __( 'Post Settings', 'swaq' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __( 'Number of Posts', 'swaq' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 2,
                'step' => 5,
                'default' => 1,
            ]
        );

        $this->add_control(
            'post_categories',
            [
                'label' => __( 'Post Categoreis', 'swaq' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => false,
                'options' => $this->get_categories(),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'button',
            [
                'label' => __( 'Button Settings', 'swaq' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'swaq' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => 'type your button text here',
                'default' => 'Learn more',
            ]
        );

        $this->end_controls_section();
      
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>


        <?php

        $args = array('post_type'=>'post', 'post_per_page'=>2);

        if(!empty($settings['post_categories'])) {
            $args['tax_query'] = 
            array(
                array(
                    'taxonomy' => 'post_categories',
                    'field' => 'term_id',
                    'terms' => $settings['post_categories'],
                )
                );
        }

        $sq = new \WP_Query($args);
        $x = 0;

        if ($sq->have_posts()) : while ($sq->have_posts()) : $sq->the_post();
        ?>

        <?php if(! $x >= 1) { ?>

    <div class="grid-container">

    <div class="grid-50">
    <?php if(has_post_thumbnail()):; ?> 
    <img class="" width="420px" height="auto" src=<?php the_post_thumbnail_url(''); ?> />
    <?php endif ?>
    </div>

    <div class="50">
    <h3 class=""><?php echo $settings['tagline'] ?></h3>
    <strong class=""><?php the_title() ?></strong>
    <p class=""><?php the_content() ?></p>
    <button type="button"><?php echo $settings['button_text'] ?></button>
    </div>

    </div>
        <?php $x = $x + 1; } ?>
    <?php endwhile; endif; wp_reset_postdata(); wp_reset_query(); ?>
    

<?php
    }
	

}

?>
