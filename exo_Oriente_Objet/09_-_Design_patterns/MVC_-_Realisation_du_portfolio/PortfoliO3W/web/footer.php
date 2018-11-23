        </main>

        <footer role="contentinfo">
            <?php /* ?>
            <p class="text-upper"><?php echo $baseline; ?></p>
            <address>
                <p><?php echo $street . '<br>' . $additional . '<br>' . $zipcode . ' ' . $city; ?></p>
                <p><?php echo $phone; ?></p>
            </address>
            <?php */ ?>
            <p><small>&copy;<?php echo date( 'Y' ) . ( defined( 'AUTHOR_NAME' ) ? ' ' . AUTHOR_NAME : '' ) . ' - ' . mb_strtolower( _( 'All rights reserved' ) ); ?></small></p>
        </footer>

        <script type="text/javascript">
            /*<![CDATA[*/
            window.addEventListener( 'load', function ( e ) {
                for( var svg of document.querySelectorAll( 'img.svg' ) ) {
                    if( svg.getAttribute( 'data-svg' )!='' && svg.getAttribute( 'data-svg' )!==null )
                        svg.src = svg.getAttribute( 'data-svg' );
                }
            } );
            /*]]>*/
        </script>
    </body>
</html>