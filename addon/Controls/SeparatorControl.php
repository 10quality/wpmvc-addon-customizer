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
class SeparatorControl extends WP_Customize_Control
{
    /**
     * Control type.
     * @since 1.0.1
     * 
     * @var string
     */
    const TYPE = 'separator';
    /**
     * Render the control in the customizer.
     * @since 1.0.1
     */
    public function render_content()
    {
        CustomizerAddon::view( 'controls.separator', ['control' => &$this] );
    }
}