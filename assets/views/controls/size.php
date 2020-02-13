<?php
/**
 * Size control.
 * 
 * @link https://codepen.io/amostajo/pen/poJJoXa
 *
 * @author 10 Quality <info@10quality.com>
 * @package wpmvc-addon-customizer
 * @license MIT
 * @version 1.0.4
 */
?>
<div class="customize-size wpmvc">
    <div class="choose-label customize-control-title">
        <?php if ( ! empty( $control->label ) ) : ?>
            <strong class="customize-control-label"><b><?php echo $control->label ?></b></strong>
        <?php else : ?>
            <strong class="customize-control-label"><b><?php echo $control->id ?></b></strong>
        <?php endif ?>
    </div>
    <div class="size" data-type="<?php echo esc_attr( $data_type ) ?>" role="size">
        <label for="<?php echo esc_attr( $control->id ) ?>-lock" class="lock"
            title="<?php echo esc_attr( 'Restrict proportions and aspect ratio', 'wpmvc-addon-customizer' ) ?>">
            <input id="<?php echo esc_attr( $control->id ) ?>-lock"
                type="checkbox"
                name="<?php echo esc_attr( $control->id ) ?>[2]"
                value="lock"
                style="display:none"
                role="lock"
                <?php if ( $value[2] === 'lock' ) : ?>checked="checked"<?php endif ?>
            /><div class="icon"></div>
        </label>
        <label for="<?php echo esc_attr( $control->id ) ?>-width" class="size-width">
            <input id="<?php echo esc_attr( $control->id ) ?>-width"
                type="number"
                name="<?php echo esc_attr( $control->id ) ?>[0]"
                role="width"
                value="<?php esc_attr( $value[0] ) ?>"
                <?php $control->input_attrs() ?>
                <?php $control->link() ?>
            />
        </label>
        <div class="separator">x</div>
        <label for="<?php echo esc_attr( $control->id ) ?>-height" class="size-height">
            <input id="<?php echo esc_attr( $control->id ) ?>-height"
                type="number"
                name="<?php echo esc_attr( $control->id ) ?>[1]"
                role="height"
                value="<?php esc_attr( $value[1] ) ?>"
                <?php $control->input_attrs() ?>
                <?php $control->link() ?>
            />
        </label>
        <div class="unit"><?php echo esc_attr( $unit ) ?></div>
    </div>
    <?php if ( ! empty( $control->description ) ) : ?>
        <div class="description customize-control-description"><?php echo $control->description ?></div>
    <?php endif ?>
</div>