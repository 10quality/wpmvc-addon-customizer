/*!
 * Customizer size control.
 * @link https://codepen.io/amostajo/pen/mdJebyM
 * @author 10 Quality <info@10quality.com>
 * @package wpmvc-addon-customizer
 * @license MIT
 * @version 1.0.4
 */
( function( $ ) {
    /**
     * Size input plugin.
     * @since 1.0.4
     */
    $.fn.sizeinput = function()
    {
        var self = this;
        self.$el = $( this );
        self.elements = {};
        self.data_type = 'int';
        self.prev_value = undefined;
        self.restrict = true;
        self.methods = {
            init: function() {
                self.data_type = self.$el.data( 'type' ) || 'int';
                self.elements.$lock = self.$el.find( 'input[role="lock"]' );
                self.elements.$width = self.$el.find( 'input[role="width"]' );
                self.elements.$height = self.$el.find( 'input[role="height"]' );
                self.elements.$width.on( 'focus', self.methods.set_prev_val );
                self.elements.$height.on( 'focus', self.methods.set_prev_val );
                self.elements.$width.on( 'change', self.methods.on_width );
                self.elements.$height.on( 'change', self.methods.on_height );
            },
            parse_val: function( value ) {
                return self.data_type === 'float' ? parseFloat( value ) : parseInt( value );  
            },
            set_prev_val: function() {
                self.prev_value = $( this ).val();
                if ( self.prev_value === '' || self.prev_value === null || self.prev_value === undefined )
                    self.prev_value = 0;
                self.prev_value = self.methods.parse_val( self.prev_value )
            },
            on_width: function( event ) {
                if ( ! self.restrict || ! self.methods.is_locked() ) {
                    self.restrict = true; // used to prevent replication
                    return;
                }
                self.methods.restrict_proportions( $( this ), self.elements.$height );
            },
            on_height: function( event ) {
                if ( ! self.restrict || ! self.methods.is_locked() ) {
                    self.restrict = true; // used to prevent replication
                    return;
                }
                self.methods.restrict_proportions( $( this ), self.elements.$width );
            },
            is_locked: function() {
                return is_locked = self.elements.$lock.is(':checked');
            },
            restrict_proportions: function( $input, $target ) {
                var target_val = $target.val();
                if ( target_val === '' || target_val === null || target_val === undefined )
                    target_val = 0;
                var target_val = self.methods.parse_val( target_val );
                var input_val = $input.val();
                if ( input_val === '' || input_val === null || input_val === undefined )
                    input_val = 0;
                var input_val = self.methods.parse_val( input_val );
                target_val = target_val + ( input_val - self.prev_value );
                $target.val( target_val <=  0 ? '' : target_val );
                self.restrict = false; // Prevent replication
                self.prev_value = input_val;
                $target.change();
            },
        };
        self.methods.init();
    }
    /**
     * Size input init.
     * @since 1.0.2
     */
    $( document ).ready( function() {
        $( '*[role="size"]' ).each( function() {
            $( this ).sizeinput();
        } );
    } );
} )( jQuery );