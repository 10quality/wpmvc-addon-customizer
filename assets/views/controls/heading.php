<?php
/**
 * Heading control.
 *
 * @author 10 Quality <info@10quality.com>
 * @package wpmvc-addon-customizer
 * @license MIT
 * @version 1.0.1
 */
?>
<?php if ( ! empty( $control->label ) ) : ?>
    <<?php echo $label_tag ?> class="heading customize-control-title"><?php echo $control->label ?></<?php echo $label_tag ?>>
<?php endif ?>
<?php if ( ! empty( $control->description ) ) : ?>
    <div class="description customize-control-description"><?php echo $control->description ?></div>
<?php endif ?>