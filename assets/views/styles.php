<?php
/**
 * Customizer rendering.
 *
 * @author 10 Quality <info@10quality.com>
 * @package wpmvc-addon-customizer
 * @license MIT
 * @version 1.0.0
 */
?><style type="text/css">
<?php foreach ( $settings as $id => $css ) : ?>
    <?php $value = wpmvc_addon_customizer_get_value(
        $config,
        $id,
        array_key_exists( 'default', $css ) ? $css['default'] : ''
    ) ?>
    <?php if ( $value === false ) : ?>
        <?php continue; ?>
    <?php endif ?>
    <?php if ( array_key_exists( 'breakpoint', $css ) && $css['breakpoint'] ) : ?>
    @media screen and ( max-width: <?= $value ?>px ) {
    <?php endif ?>
    <?php foreach ( $css['selectors'] as $selector => $styles ) : ?>
        <?= esc_attr( $selector ) ?> {
            <?php foreach ( $styles as $style ) : ?>
                <?php wpmvc_addon_customizer_print_style( $config, $id, $style, $value ) ?>
            <?php endforeach ?>
        }
    <?php endforeach ?>
    <?php if ( array_key_exists( 'breakpoint', $css ) && $css['breakpoint'] ) : ?>
    }
    <?php endif ?>
<?php endforeach ?>
</style><!-- WPMVC Add-On customizer -->