<?php
/**
 * Alert control.
 *
 * @author 10 Quality <info@10quality.com>
 * @package wpmvc-addon-customizer
 * @license MIT
 * @version 1.0.1
 */
?>
<div id="<?php echo esc_attr( $control->id ) ?>" class="customize-alert wpmvc" <?php $control->input_attrs() ?>>
    <?php if ( ! empty( $control->label ) ) : ?>
        <p class="heading customize-control-title"><b><?php echo $control->label ?></b></p>
    <?php endif ?>
    <?php if ( ! empty( $control->description ) ) : ?>
        <div class="description customize-control-description"><?php echo $control->description ?></div>
    <?php endif ?>
</div>