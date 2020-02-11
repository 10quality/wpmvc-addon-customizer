<?php
/**
 * Choose control.
 * 
 * @link https://codepen.io/amostajo/pen/mdJJpBO
 *
 * @author 10 Quality <info@10quality.com>
 * @package wpmvc-addon-customizer
 * @license MIT
 * @version 1.0.3
 */
?>
<div id="<?php echo esc_attr( $control->id ) ?>" class="customize-choose wpmvc">
    <div class="choose-label customize-control-title">
        <?php if ( ! empty( $control->label ) ) : ?>
            <strong class="customize-control-label"><b><?php echo $control->label ?></b></strong>
        <?php else : ?>
            <strong class="customize-control-label"><b><?php echo $control->id ?></b></strong>
        <?php endif ?>
    </div>
    <div class="choose" <?php $control->input_attrs() ?>>
        <?php foreach ( $control->choices as $key => $options ) : ?>
            <label for="choose-<?php echo esc_attr( $key ) ?>">
                <input id="choose-<?php echo esc_attr( $key ) ?>"
                    type="radio"
                    name="<?php echo esc_attr( $control->id ) ?>"
                    value="<?php echo esc_attr( $key ) ?>"
                    style="display:none"
                    <?php $control->link() ?>
                    <?php if ( $control->value() === $key ) : ?>checked="checked"<?php endif ?>
                />
                <div class="choose-option">
                    <?php if ( $options['type'] === 'url' ) : ?>
                        <img src="<?php echo esc_url( $options['value'] ) ?>" alt="<?php echo esc_attr( $key ) ?>"/>
                    <?php elseif ( $options['type'] === 'dashicon' ) : ?>
                        <span class="dashicons <?php echo esc_attr( $options['value'] ) ?>"></span>
                    <?php elseif ( $options['type'] === 'fa' ) : ?>
                        <span class="fa <?php echo esc_attr( $options['value'] ) ?>"></span>
                    <?php else : ?>
                        <span class="option-text"><?php echo esc_attr( $options['value'] ) ?></span>
                    <?php endif ?>
                </div>
            </label>
        <?php endif ?>
    </div>
    <?php if ( ! empty( $control->description ) ) : ?>
        <div class="description customize-control-description"><?php echo $control->description ?></div>
    <?php endif ?>
</div>