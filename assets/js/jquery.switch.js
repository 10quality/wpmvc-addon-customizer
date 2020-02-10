/*!
 * Customizer switch control.
 * @link https://codepen.io/amostajo/pen/poJJoXa
 * @author 10 Quality <info@10quality.com>
 * @package wpmvc-addon-customizer
 * @license MIT
 * @version 1.0.2
 */
( function( $ ) {
    /**
     * Switch/switcher plugin.
     * @since 1.0.2
     */
    $.fn.switcher = function() {
        var self = this;
        self.$el = $( this );
        self.$input = undefined;
        self.is_on = false;
        self.methods = {
            init: function() {
                self.$input = self.$el.find( 'input[type="checkbox"]' );
                self.is_on = self.$input.is( ':checked' );
                self.$el.on( 'click', self.methods.toggle );
                self.methods.render();
            },
            toggle: function( e ) {
                if ( e !== undefined )
                    e.preventDefault();
                self.is_on = ! self.is_on;
                self.methods.render();
                self.$input.change();
                self.$el.trigger( 'switch:toggle', [self.is_on, self] );
            },
            render: function() {
                if ( self.is_on ) {
                    self.$input.prop( 'checked', true );
                    self.$el.find( '.switch-val.on' ).addClass( 'active' );
                    self.$el.find( '.switch-val.off' ).removeClass( 'active' );
                    self.$el.trigger( 'switch:on', [self] );
                } else {
                    self.$input.prop( 'checked', false );
                    self.$el.find( '.switch-val.on' ).removeClass( 'active' );
                    self.$el.find( '.switch-val.off' ).addClass( 'active' );
                    self.$el.trigger( 'switch:off', [self] );
                }
            }
        };
        self.methods.init();
        return {
            toggle: function() {
                return self.methods.toggle();  
            },
        };
    };
    /**
     * Switch init.
     * @since 1.0.2
     */
    $( document ).ready( function() {
        $( '*[role="switch"]' ).each( function() {
            $( this ).switcher();
        } );
    } );
} )( jQuery );