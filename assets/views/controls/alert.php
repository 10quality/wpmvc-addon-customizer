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
        <div class="heading customize-control-title"><b><?php echo $control->label ?></b></div>
    <?php endif ?>
    <?php if ( ! empty( $control->description ) ) : ?>
        <div class="description customize-control-description" style="<?php echo esc_attr( $control->input_attrs['description-style'] ) ?>"
            ><?php echo $control->description ?></div>
    <?php endif ?>
</div>