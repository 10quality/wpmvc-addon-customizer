<?php

use WPMVC\Addons\PHPUnit\TestCase;
use WPMVC\Addons\Customizer\CustomizerAddon;

/**
 * Test addon class.
 * 
 * @author 10 Quality <info@10quality.com>
 * @package wpmvc-addon-customizer
 * @license MIT
 * @version 1.0.8
 */
class CustomizerAddonTest extends TestCase
{
    /**
     * Tear down.
     * @since 1.0.8
     */
    public function tearDown(): void
    {
        wpmvc_addon_phpunit_reset();
    }
    /**
     * Test init.
     * @since 1.0.8
     * @group addon
     */
    public function testInit()
    {
        // Prepare
        $bridge = $this->getBridgeMock();
        $addon = new CustomizerAddon($bridge);
        // Run
        $addon->init();
        // Assert
        $this->assertAddedAction( 'admin_enqueue_scripts' );
        $this->assertAddedAction( 'customize_register' );
        $this->assertAddedAction( 'wp_head' );
        $this->assertAddedFilter( 'wpmvc_addon_customizer_controls' );
        $this->assertAddedFilter( 'init' );
    }
    /**
     * Test init.
     * @since 1.0.8
     * @group addon
     */
    public function testCustomizerControls()
    {
        // Prepare
        $bridge = $this->getBridgeMock();
        $addon = new CustomizerAddon($bridge);
        // Run
        $controls = $addon->customizer_controls( [] );
        // Assert
        $this->assertNotEmpty( $controls );
        $this->assertCount( 6, $controls );
    }
}