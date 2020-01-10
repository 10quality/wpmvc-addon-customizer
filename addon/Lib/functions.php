<?php

use WPMVC\Addons\Customizer\Controllers\CustomizerController;

/**
 * Global functions.
 *
 * @author 10 Quality <info@10quality.com>
 * @package wpmvc-addon-customizer
 * @license MIT
 * @version 1.0.0
 */

if ( ! function_exists( 'wpmvc_addon_customizer_get_value' ) ) {
    /**
     * Returns a setting value.
     * @since 1.0.0
     * 
     * @param \WPMVC\Config &$config
     * @param string        $setting_id
     */
    function wpmvc_addon_customizer_get_value( &$config, $setting_id )
    {
        return CustomizerController::get_value( $config, $setting_id );
    }
}

if ( ! function_exists( 'wpmvc_addon_customizer_print_style' ) ) {
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
    function wpmvc_addon_customizer_print_style( &$config, $setting_id, $style, $value, $media_size = null )
    {
        CustomizerController::print_style( $config, $setting_id, $style, $value, $media_size );
    }
}