<?php

namespace WPMVC\Addons\Customizer\Controllers;

use ReflectionClass;
use WP_Customize_Cropped_Image_Control;
use WP_Customize_Upload_Control;
use WP_Customize_Media_Control;
use WP_Customize_Color_Control;
use TenQuality\WP\File;
use WPMVC\Config;
use WPMVC\MVC\Controller;
use WPMVC\Addons\Customizer\Controls\SeparatorControl;
use WPMVC\Addons\Customizer\Controls\HeadingControl;
use WPMVC\Addons\Customizer\Controls\AlertControl;
use WPMVC\Addons\Customizer\Controls\SwitchControl;

/**
 * Customizer hooks and handling.
 * 
 * @link https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @author 10 Quality <info@10quality.com>
 * @package wpmvc-addon-customizer
 * @license MIT
 * @version 1.0.1
 */
class CustomizerController extends Controller
{
    /**
     * Returns a setting value.
     * @since 1.0.0
     * 
     * @param \WPMVC\Config &$config
     * @param string        $setting_id
     * @param mixed         $default
     */
    public static function get_value( &$config, $setting_id, $default = null )
    {
        if ( $config->get( 'settings.' . $setting_id . '.type' ) === 'option' ) {
            if ( preg_match( '/\[[\s\S]+\]/', $setting_id, $key ) ) {
                $setting_id = str_replace( $key, '', $setting_id );
                $key = preg_replace( '/\[|\]/', '', $key[0] );
            }
            $value = get_option( $setting_id );
            if ( ! empty( $key ) && is_array( $value ) )
                $value = array_key_exists( $key , $value ) ? $value[$key] : null;
            return apply_filters(
                'wpmvc_addon_customizer_get_value',
                $value === null || is_array( $value ) ? $default : $value,
                $setting_id,
                $config
            );
        }
        return apply_filters(
            'wpmvc_addon_customizer_get_value',
            get_theme_mod( $setting_id, $default ),
            $setting_id,
            $config
        );
    }
    /**
     * Prints a style line related to a customizer setting.
     * @since 1.0.0
     * 
     * @param \WPMVC\Config &$config
     * @param string        $setting_id
     * @param string        $style
     * @param mixed         $value
     * @param string        $media_size
     */
    public static function print_style( &$config, $setting_id, $style, $value, $media_size = null )
    {
        // Check if setting is media
        if ( $config->get( 'controls.' . $setting_id . '.type' ) === 'media' ) {
            $value = wp_get_attachment_image_src( $value, $media_size );
            if ( is_wp_error( $value ) )
                return;
            if ( is_array( $value ) )
                $value = $value[0];
        }
        // Print
        printf( $style, $value );
    }
    /**
     * Registers customizer customizations.
     * @since 1.0.0
     * 
     * @param \WPMVC\Bridge $main
     * @param \WP_Customize $wp_customize
     */
    public function register( $main, $wp_customize )
    {
        // Load configuration
        $config = $this->get_config( $main );
        if ( empty( $config ) )
            return;
        // Register configuration
        // -- Panels
        if ( is_array( $config->get( 'panels' ) ) )
            foreach ( $config->get( 'panels' ) as $id => $options ) {
                $wp_customize->add_panel( $id, $options );
            }
        // -- Sections
        if ( is_array( $config->get( 'sections' ) ) )
            foreach ( $config->get( 'sections' ) as $id => $options ) {
                $wp_customize->add_section( $id, $options );
            }
        // -- Settings
        if ( is_array( $config->get( 'settings' ) ) )
            foreach ( $config->get( 'settings' ) as $id => $options ) {
                $wp_customize->add_setting( $id, $options );
            }
        // -- Controls
        if ( is_array( $config->get( 'controls' ) ) )
            foreach ( $config->get( 'controls' ) as $id => $options ) {
                if ( ! array_key_exists( 'type' , $options ) )
                    $options['type'] = 'text';
                switch ( $options['type'] ) {
                    case 'media':
                        unset( $options['type'] );
                        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, $id, $options ) );
                        break;
                    case 'color':
                        unset( $options['type'] );
                        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, $options ) );
                        break;
                    case 'upload':
                        unset( $options['type'] );
                        $wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, $id, $options ) );
                        break;
                    case 'cropped-image':
                        unset( $options['type'] );
                        $wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, $id, $options ) );
                        break;
                    case 'checkbox':
                    case 'textarea':
                    case 'radio':
                    case 'select':
                    case 'dropdown-pages':
                    case 'text':
                    case 'hidden':
                    case 'number':
                    case 'range':
                    case 'url':
                    case 'tel':
                    case 'email':
                    case 'search':
                    case 'time':
                    case 'date':
                    case 'datetime':
                    case 'week':
                        $wp_customize->add_control( $id, $options );
                        break;
                    default:
                        // Custom control
                        $controls = apply_filters( 'wpmvc_addon_customizer_controls', [] );
                        if ( ! in_array( $options['type'], array_keys( $controls ) ) )
                            break;
                        $control_class = $controls[$options['type']];
                        unset( $options['type'] );
                        $reflector = new ReflectionClass( $control_class );
                        $wp_customize->add_control( $reflector->newInstanceArgs( [$wp_customize, $id, $options] ) );
                        break;
                }
            }
    }
    /**
     * Renders customizer settings.
     * @since 1.0.0
     * 
     * @param \WPMVC\Bridge $main
     */
    public function render( $main )
    {
        // Load configuration
        $config = $this->get_config( $main );
        if ( empty( $config ) )
            return;
        // Render settings
        $settings = $config->get( 'rendering' );
        if ( ! empty( $settings ) )
            $this->view->show( 'styles', [
                'config'    => &$config,
                'settings'  => &$settings,
            ] );
    }
    /**
     * Returns customizer.php configuration.
     * @since 1.0.0
     * 
     * @return \WPMVC\Config
     */
    public function get_config( $main )
    {
        $filename = $main->config->get( 'paths.base' ) . 'Config/customizer.php';
        if ( ! File::auth()->is_file( $filename ) )
            return null;
        $customizer_data = include $filename;
        return ! isset( $customizer_data ) || empty( $customizer_data )
            ? null
            : new Config( $customizer_data );
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
    public function controls( $controls = [] )
    {
        $controls[SeparatorControl::TYPE] = SeparatorControl::class;
        $controls[HeadingControl::TYPE] = HeadingControl::class;
        $controls[AlertControl::TYPE] = AlertControl::class;
        $controls[SwitchControl::TYPE] = SwitchControl::class;
        return $controls;
    }
}