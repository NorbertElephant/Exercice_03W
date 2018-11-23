/**
 * FilterWIND.js - v1.0 - 2017.06.01
 * A fast, small and dependency free filter script
 * (c) W.I.N.D. Agency.com - https://www.wind-agency.com
**/
(function() {
    this.FilterWIND = function( selector, options = {} ) {
        /**
         * --------------------------------------------------
         * GLOBAL ELEMENT REFERENCES
         * --------------------------------------------------
        **/
        this.container = {
            selector:   selector,
            node:       /^(#|\.)\w+/.test( selector ) ? document.querySelector( selector ) : {}
        };

        /**
         * --------------------------------------------------
         * OPTION DEFAULTS
         * --------------------------------------------------
        **/
        var defaults = {
            controls:  {
                display:    'list-item',
                selector:   '.filter-controls .filter-item',
                target:     '[data-filter]',
                reset:      '.filter-reset'
            }
        };
        // Create options by extending defaults with the passed in arugments
        if( options && typeof options==='object' ) {
            this.options = extendDefaults( defaults, options );
        }



        /**
         * --------------------------------------------------
         * METHODS
         * --------------------------------------------------
        **/
        /**
         * extendDefaults - Extends defaults with user options
         * @param
         * @return
        **/
        function extendDefaults( source, properties ) {
            for( var property in properties ) {
                if( properties.hasOwnProperty( property ) ) {
                    source[property] = properties[property];
                }
            }

            return source;
        }

        for( var item of document.querySelectorAll( this.options.controls.selector + ' ' + this.options.controls.target ) ) {
            var instance = this;
            item.addEventListener( 'click', function ( e ) {
                instance.filter( e );
                //e.preventDefault();
            } );
        }

        document.querySelector( this.options.controls.selector + ' ' + this.options.controls.reset ).addEventListener( 'click', function ( e ) {
            for( var item of document.querySelectorAll( this.options.controls.selector + ' ' + this.options.controls.target ) ) {
                item.checked = true;
            }
            e.preventDefault();
        } );

        return this;
    }

    /**
     * filter - Filters container depending on controls events
     * @param   event   e
     * @return
    **/
    FilterWIND.prototype.filter = function ( e ) {
        if( typeof e==='undefined' || typeof e!=='object' ) return;

        // console.log( e );
        // console.log( this );

        var filter = e.target.getAttribute( this.options.controls.target.replace( /(\[|\])/g, '' ) ).split( ':' );
        // console.log( filter );

        for( var item of this.container.node.children ) {
            if( item.getAttribute( 'data-' + filter[0] )!==null ) {
                if( item.getAttribute( 'data-' + filter[0] )==filter[1] ) {
                    if( e.target.checked )
                        this.fadeIn( item ); // item.style.display = this.options.controls.display;
                    else
                        this.fadeOut( item ); // item.style.display = 'none';
                }
            }
        }
    };





    FilterWIND.prototype.hasClass = function ( el, className ) {
        if( el.classList )
            return el.classList.contains( className );
        else
            return !!el.className.match( new RegExp( '(\\s|^)' + className + '(\\s|$)' ) );
    }

    FilterWIND.prototype.addClass = function ( el, className ) {
        if( el.classList )
            el.classList.add( className );
        else
            if( !hasClass( el, className ) )
                el.className += ' ' + className;
    }

    FilterWIND.prototype.removeClass = function ( el, className ) {
        if( el.classList )
            el.classList.remove( className );
        else
            if( hasClass( el, className ) ) {
                var reg = new RegExp( '(\\s|^)' + className + '(\\s|$)' );
                el.className = el.className.replace( reg, ' ' );
            }
    }

    // fade out
    FilterWIND.prototype.fadeOut = function ( el ) {
        el.style.opacity = 1;

        (function fade() {
            if( ( el.style.opacity -= .1 )<0 ) {
                el.style.display = 'none';
            } else {
                requestAnimationFrame( fade );
            }
        })();
    }

    // fade in
    FilterWIND.prototype.fadeIn = function ( el, display ) {
        el.style.opacity = 0;
        el.style.display = display || this.options.controls.display;

        (function fade() {
            var val = parseFloat( el.style.opacity );
            if( !( ( val += .1 )>1 ) ) {
                el.style.opacity = val;
                requestAnimationFrame( fade );
            }
        })();
    }
})();