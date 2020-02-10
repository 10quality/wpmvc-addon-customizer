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
class HeadingControl extends WP_Customize_Control
{
    /**
     * Control type.
     * @since 1.0.1
     * 
     * @var string
     */
    const TYPE = 'heading';
    /**
     * Control's Type.
     * @since 1.0.2
     * 
     * @var string
     */
    public $type = self::TYPE;
    /**
     * Render the control in the customizer.
     * @since 1.0.1
     */
    public function render_content()
    {
        CustomizerAddon::view( 'controls.heading', [
            'control' => &$this,
            'label_tag' => array_key_exists( 'tag', $this->input_attrs ) && ! empty( $this->input_attrs['tag'] )
                ? trim( $this->input_attrs['tag'] )
                : 'h2'
        ] );
    }
}