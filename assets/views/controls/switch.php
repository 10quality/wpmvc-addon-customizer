<?php
/**
 * Switch control.
 * 
 * @link https://codepen.io/amostajo/pen/poJJoXa
 *
 * @author 10 Quality <info@10quality.com>
 * @package wpmvc-addon-customizer
 * @license MIT
 * @version 1.0.2
 */
?>
<div class="customize-switch wpmvc" <?php $control->input_attrs() ?>>
    <label for="<?php echo esc_attr( $control->id ) ?>" role="switch" class="switch control">
        <input id="<?php echo esc_attr( $control->id ) ?>" type="checkbox"
            name="<?php echo esc_attr( $control->id ) ?>"
            value="yes"
            <?php if ( $control->value() === 'yes' : ?>checked<?php endif ?>
            <?php $control->link() ?>
            style="display:none"
        />
        <div class="switch-label">
            <?php if ( ! empty( $control->label ) ) : ?>
                <strong class="customize-control-label"><b><?php echo $control->label ?></b></strong>
            <?php else : ?>
                <strong class="customize-control-label"><b><?php echo $control->id ?></b></strong>
            <?php endif ?>
        </div>
        <div class="controller">
            <div class="switch-val on"><?php _e( 'On', 'wpmvc-addon-customizer' ) ?></div>
            <div class="switch-val off"><?php _e( 'Off', 'wpmvc-addon-customizer' ) ?></div>
        </div>
    </label>
    <?php if ( ! empty( $control->description ) ) : ?>
        <div class="description customize-control-description"><?php echo $control->description ?></div>
    <?php endif ?>
</div>