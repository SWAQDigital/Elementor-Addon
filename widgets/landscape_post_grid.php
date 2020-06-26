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

class Landscape_Post_Grid extends Widget_Base { #add ClassName

    public function get_name() {
        return 'Landscape_Post_Grid';
    }

    public function get_title() {
        return __( 'Landscape Post Grid', 'elementor' );
    }

    public function get_icon() {
        return 'fa fa-font';
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
                'max' => 30,
                'default' => 1,
            ]
        );

        $this->add_control(
            'post_category',
            [
                'label' => __( 'Post Category', 'swaq' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'Type your category slug here', 'swaq' ),
            ]
        );

        $this->add_control(
            'flip',
            [
                'label' => __( 'Flip Position', 'swaq' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'show_lable' => true,
                'default' => 'No',
            ]
        );

        $this->add_control(
            'show_post_title',
            [
                'label' => __( 'Show Post Title', 'swaq' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'show_lable' => true,
            ]
        );
        $this->add_control(
            'show_post_description',
            [
                'label' => __( 'Show Post Description', 'swaq' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'show_lable' => true,
            ]
        );
        $this->add_control(
            'show_post_button',
            [
                'label' => __( 'Show Post Button', 'swaq' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'show_lable' => true,
            ]
        );

        $this->add_control(
            'show_date',
            [
                'label' => __( 'Show Post Date', 'swaq' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'show_lable' => true,
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

        $args = array('post_type'=>'post', 'post_per_page'=>$settings['posts_per_page'], 'category_name'=>$settings['post_category']);


        $sq = new \WP_Query($args);
        $x = 0;

        if ($sq->have_posts()) : while ($sq->have_posts()) : $sq->the_post();
        ?>

        <?php if( $x < $settings['posts_per_page']) { ?>

    <div class="grid-container">

    <div class="grid-50 <?php if ($settings['flip']) { ?> push-50 <?php } ?>">
    <?php if(has_post_thumbnail()):; ?> 
    <img class="" width="420px" height="auto" src=<?php the_post_thumbnail_url(''); ?> />
    <?php endif ?>
    </div>

    <div class="grid-50 <?php if ($settings['flip']) { ?> pull-50 <?php } ?>">
    <h3 class=""><?php echo $settings['tagline'] ?></h3>
    <?php if ($settings['show_post_title']) { ?> <h1><strong class=""><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></strong></h1> <?php } ?>
    <?php if ($settings['show_post_description']) { ?> <p class=""><?php the_excerpt() ?></p> <?php } ?>
    <?php if ($settings['show_date']) { ?><h3 class=""><?php the_date() ?></h3><?php } ?>
    <div><?php if ($settings['show_post_button']) { ?><a href="<?php the_permalink(); ?>"> <button type="button"><?php echo $settings['button_text'] ?></button></a> <?php } ?></div>
    </div>

    </div>
        <?php $x = $x + 1; } ?>
    <?php endwhile; endif; wp_reset_postdata(); wp_reset_query(); ?>
    

<?php
    }
	

}

?>
