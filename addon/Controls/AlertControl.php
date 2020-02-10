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
 * @version 1.0.1
 */
class AlertControl extends WP_Customize_Control
{
    /**
     * Control type.
     * @since 1.0.1
     * 
     * @var string
     */
    const TYPE = 'alert';
    /**
     * Render the control in the customizer.
     * @since 1.0.1
     */
    public function render_content()
    {
        $this->prepare_input_attrs();
        CustomizerAddon::view( 'controls.alert', ['control' => &$this] );
    }
    /**
     * Prepares input attributes with default values.
     * @since 1.0.1
     */
    private function prepare_input_attrs()
    {
        $type = array_key_exists( 'type', $this->input_attrs ) && ! empty( $this->input_attrs['type'] ) ? trim( $this->input_attrs['type'] ) : 'info';
        $temp = array_merge(
            $this->get_type_styles( $type ),
            $this->get_styles_from_input()
        );
        $styles = [];
        foreach ( $temp as $key => $value ) {
            $styles[] = $key.'='.$value;
        }
        $this->input_attrs['style'] = implode( ';' , $styles ) . ';';
        unset( $this->input_attrs['type'] );
    }
    /**
     * Returns input attributes styles as array.
     * @since 1.0.0
     * 
     * @return array
     */
    private function get_styles_from_input()
    {
        $styles = [];
        $temp = explode( ';', array_key_exists( 'style', $this->input_attrs ) && ! empty( $this->input_attrs['style'] ) ? trim( $this->input_attrs['style'] ) : '' );
        foreach ( $temp as $style ) {
            list( $key, $value ) = explode( '=', $style );
            if ( ! empty( $key ) && ! empty( $value ) ) {
                $styles[$key] = $value;
            }
        }
        return $styles;
    }
    /**
     * Returns the list of styles by type;
     * @since 1.0.1
     * 
     * @param string $type
     * 
     * @return array
     */
    private function get_type_styles( $type )
    {
        $styles = [
            'padding' => '7px',
        ];
        switch ( $type ) {
            case 'info':
                $styles['background'] = '#81D4FA';
                $styles['color'] = '#343434 !important';
                break;
            case 'success':
                $styles['background'] = '#C5E1A5';
                $styles['color'] = '#343434 !important';
                break;
            case 'warning':
                $styles['background'] = '#FFE082';
                $styles['color'] = '#581f00 !important';
                break;
            case 'danger':
            case 'error':
                $styles['background'] = '#FF5722';
                $styles['color'] = '#ffffff !important';
                break;
            default:
                $styles['background'] = '#ffffff';
                $styles['color'] = '#343434 !important';
                break;
        }
        return $styles;
    }
}