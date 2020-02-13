<?php

namespace WPMVC\Addons\Customizer\Controls;

use WP_Customize_Control;
use WPMVC\Addons\Customizer\CustomizerAddon;

/**
 * Adds a size input control.
 * WordPress Customizer Control.
 * 
 * @author 10 Quality <info@10quality.com>
 * @package wpmvc-addon-customizer
 * @license MIT
 * @version 1.0.4
 */
class SizeControl extends WP_Customize_Control
{
    /**
     * Control type.
     * @since 1.0.4
     * 
     * @var string
     */
    const TYPE = 'size';
    /**
     * Control's Type.
     * @since 1.0.4
     * 
     * @var string
     */
    public $type = self::TYPE;
    /**
     * Enqueue control related scripts/styles.
     * @since 1.0.4
     */
    public function enqueue()
    {
        wp_enqueue_style(
            'customizer_size',
            addon_assets_url( 'css/size.css', __DIR__ ),
            ['font-awesome'],
            '1.0.4'
        );
        wp_enqueue_script(
            'customizer_size',
            addon_assets_url( 'js/jquery.size.js', __DIR__ ),
            ['jquery'],
            '1.0.4'
        );
    }
    /**
     * Render the control in the customizer.
     * @since 1.0.4
     */
    public function render_content()
    {
        // Add default input attributes
        if ( !array_key_exists( 'step', $this->input_attrs ) ) {
            $this->input_attrs['step'] = 1;
        }
        if ( !array_key_exists( 'min', $this->input_attrs ) ) {
            $this->input_attrs['min'] = 0;
        }
        // Render
        CustomizerAddon::view( 'controls.size', [
            'data_type' => $this->get_input_data_type(),
            'unit'      => $this->get_size_unit(),
            'control'   => &$this,
            'value'     => customizer_sanitize_size( $this->value(), true ), // As array
        ] );
    }
    /**
     * Returns the type of data that inputs will be handleing.
     * @since 1.0.4
     * 
     * @return string
     */
    private function get_input_data_type()
    {
        return array_key_exists( 'step', $this->input_attrs ) && strpos( $this->input_attrs['step'], '.' ) !== false
            ? 'float'
            : 'int';
    }
    /**
     * Returns the size unit to display.
     * @since 1.0.4
     * 
     * @return string
     */
    private function get_size_unit()
    {
        $unit = 'px'; // Pixels
        if ( array_key_exists( 'unit', $this->input_attrs ) && !empty( $this->input_attrs['unit'] ) ) {
            $unit = $this->input_attrs['unit'];
            unset( $this->input_attrs['unit'] );
        }
        return $unit;
    }
}