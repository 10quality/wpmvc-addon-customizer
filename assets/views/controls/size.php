<?php
/**
 * Size control.
 * 
 * @link https://codepen.io/amostajo/pen/poJJoXa
 *
 * @author 10 Quality <info@10quality.com>
 * @package wpmvc-addon-customizer
 * @license MIT
 * @version 1.0.5
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
    <?php if ( ! empty( $control->description ) ) : ?>
        <div class="description customize-control-description"><?php echo $control->description ?></div>
    <?php endif ?>
    <div class="size" data-type="<?php echo esc_attr( $data_type ) ?>" role="size">
        <input type="hidden"
            name="<?php echo esc_attr( $control->id ) ?>"
            value="<?php echo esc_attr( $control->value() ) ?>"
            <?php $control->link() ?>
        />
        <label for="<?php echo esc_attr( $control->id ) ?>-lock" class="lock"
            title="<?php echo esc_attr( 'Restrict proportions', 'wpmvc-addon-customizer' ) ?>">
            <input id="<?php echo esc_attr( $control->id ) ?>-lock"
                type="checkbox"
                name="size-<?php echo esc_attr( $control->id ) ?>[2]"
                value="lock"
                style="display:none"
                role="lock"
                <?php if ( $value[2] === 'lock' ) : ?>checked="checked"<?php endif ?>
            /><div class="icon"></div>
        </label>
        <label for="<?php echo esc_attr( $control->id ) ?>-width" class="size-width">
            <input id="<?php echo esc_attr( $control->id ) ?>-width"
                type="number"
                name="size-<?php echo esc_attr( $control->id ) ?>[0]"
                role="width"
                value="<?php echo esc_attr( $value[0] ) ?>"
                <?php $control->input_attrs() ?>
            />
        </label>
        <div class="separator">x</div>
        <label for="<?php echo esc_attr( $control->id ) ?>-height" class="size-height">
            <input id="<?php echo esc_attr( $control->id ) ?>-height"
                type="number"
                name="size-<?php echo esc_attr( $control->id ) ?>[1]"
                role="height"
                value="<?php echo esc_attr( $value[1] ) ?>"
                <?php $control->input_attrs() ?>
            />
        </label>
        <div class="unit"><?php echo esc_attr( $unit ) ?></div>
    </div>
</div>