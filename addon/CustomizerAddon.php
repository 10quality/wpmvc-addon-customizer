<?php

namespace WPMVC\Addons\Customizer;

use WPMVC\Addon;

/**
 * Addon class.
 * Wordpress MVC.
 *
 * @link http://www.wordpress-mvc.com/v1/add-ons/
 * @author 10 Quality <info@10quality.com>
 * @package wpmvc-addon-customizer
 * @license MIT
 * @version 1.0.0
 */
class CustomizerAddon extends Addon
{
    /**
     * Function called when plugin or theme starts.
     * @since 1.0.0
     */
    public function init()
    {
        add_action( 'customize_register', [&$this, 'customizer_register'], 99 );
        add_action( 'wp_head', [&$this, 'customizer_render'], 99 );
    }
    /**
     * Registers customizer settings.
     * @since 1.0.0
     * 
     * @hook customize_register
     * 
     * @param WP_Customize $wp_customize
     */
    public function customizer_register( $wp_customize  )
    {
        $this->mvc->call( 'CustomizerController@register', $this->main, $wp_customize );
    }
    /**
     * Renders customizer.
     * @since 1.0.0
     * 
     * @hook wp_head
     */
    public function customizer_render()
    {
        $this->mvc->call( 'CustomizerController@render', $this->main );
    }
}