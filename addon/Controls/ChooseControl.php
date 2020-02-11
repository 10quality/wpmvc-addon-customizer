<?php

namespace WPMVC\Addons\Customizer\Controls;

use WP_Customize_Control;
use WPMVC\Addons\Customizer\CustomizerAddon;

/**
 * Adds a separator line between other controls.
 * WordPress Customizer Control.
 * 
 * @author 10 Quality <info@10quality.com>
 * @package wpmvc-addon-customizer
 * @license MIT
 * @version 1.0.3
 */
class ChooseControl extends WP_Customize_Control
{
    /**
     * Control type.
     * @since 1.0.3
     * 
     * @var string
     */
    const TYPE = 'choose';
    /**
     * Control's Type.
     * @since 1.0.3
     * 
     * @var string
     */
    public $type = self::TYPE;
    /**
     * Enqueue control related scripts/styles.
     * @since 1.0.3
     */
    public function enqueue()
    {
        wp_enqueue_style(
            'customizer_choose',
            addon_assets_url( 'css/choose.css', __DIR__ ),
            [],
            '1.0.3'
        );
    }
    /**
     * Render the control in the customizer.
     * @since 1.0.2
     */
    public function render_content()
    {
        // Prepare choices
        $this->choices = array_map( function( $choice ) {
            $choice = is_array( $choice )
                ? array_merge( ['type' => 'text'], $choice )
                : [
                    'type' => 'text',
                    'value' => trim( $choice ),
                ];
            if ( filter_var( $choice['value'], FILTER_VALIDATE_URL ) ) {
                $choice['type'] = 'url';
            } elseif ( preg_match( '/^dashicons-/', $choice['value'] ) ) {
                $choice['type'] = 'dashicon';
            } elseif ( preg_match( '/^dashicons-/', $choice['fa'] ) ) {
                $choice['type'] = 'fa';
            }
            return $choice;
        }, $this->choices );
        // Render
        CustomizerAddon::view( 'controls.switch', ['control' => &$this] );
    }
}