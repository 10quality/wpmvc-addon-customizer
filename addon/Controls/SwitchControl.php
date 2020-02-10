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
 * @version 1.0.2
 */
class SwitchControl extends WP_Customize_Control
{
    /**
     * Control type.
     * @since 1.0.2
     * 
     * @var string
     */
    const TYPE = 'switch';
    /**
     * Control's Type.
     * @since 1.0.2
     * 
     * @var string
     */
    public $type = self::TYPE;
    /**
     * Enqueue control related scripts/styles.
     * @since 1.0.2
     */
    public function enqueue()
    {
        wp_enqueue_style(
            'customizer_switch',
            addon_assets_url( 'css/switch.css', __DIR__ ),
            [],
            '1.0.2'
        );
        wp_enqueue_script(
            'customizer_switch',
            addon_assets_url( 'js/jquery.switch.js', __DIR__ ),
            ['jquery'],
            '1.0.2',
            true
        );
    }
    /**
     * Render the control in the customizer.
     * @since 1.0.2
     */
    public function render_content()
    {
        CustomizerAddon::view( 'controls.switch', ['control' => &$this] );
    }
}