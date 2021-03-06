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
 * @version 1.0.5
 */
class CustomizerAddon extends Addon
{
    /**
     * Instance.
     * @since 1.0.1
     * 
     * @var \WPMVC\Addons\Customizer\CustomizerAddon
     */
    protected static $instance;
    /**
     * Function called when plugin or theme starts.
     * @since 1.0.0
     */
    public function init()
    {
        static::$instance = $this;
        add_action( 'admin_enqueue_scripts', [&$this, 'admin_enqueue'], 99 );
        add_action( 'customize_register', [&$this, 'customizer_register'], 99 );
        add_action( 'wp_head', [&$this, 'customizer_render'], 99 );
        add_filter( 'wpmvc_addon_customizer_controls', [&$this, 'customizer_controls'], 1 );
        add_filter( 'init', [&$this, 'register_filters'], 1 );
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
    /**
     * Returns registered customizer controls.
     * @since 1.0.1
     * 
     * @hook wpmvc_addon_customizer_controls
     * 
     * @param array $controls
     * 
     * @return array
     */
    public function customizer_controls( $controls )
    {
        return $this->mvc->action( 'CustomizerController@controls', $controls );
    }
    /**
     * Registers special filters over settings.
     * @since 1.0.4
     * 
     * @hook init
     */
    public function register_filters()
    {
        return $this->mvc->action( 'CustomizerController@register_filters', $this->main );
    }
    /**
     * Registers/enqueues general admin assets.
     * @since 1.0.4
     * 
     * @hook admin_enqueue_scripts
     */
    public function admin_enqueue()
    {
        wp_register_style(
            'font-awesome',
            addon_assets_url( 'css/font-awesome.min.css', __FILE__ ),
            [],
            '4.7.0'
        );
    }
    /**
     * Renders an addon view.
     * @since 1.0.1
     * 
     * @param string $key  View key.
     * @param array  $args View arguments.
     */
    public static function view( $key, $args = [] )
    {
        if ( isset( static::$instance ) ) {
            static::$instance->mvc->view->show( $key, $args );
        }
    }
}