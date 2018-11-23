<?php
// METTRE AU PROPRE : Params / Setters / Getters / Returns / Visibilité
/**
 * ------------------------------------------------------------
 * CORE LAYOUT
 * (Requires : KernelException | KernelView)
 * ------------------------------------------------------------
**/
class KernelLayout {
    /**
     * --------------------------------------------------
     * PROPERTIES
     * --------------------------------------------------
    **/
    /**
     * Layout Entiers
     *
     * @var [type]
     */
    private $_layout;

    /**
     * View
     *
     * @var [type]
     */
    private $_view;
    /**
     * Chemin
     *
     * @var [type]
     */
    private $_path;

    /**
     * Metas de la pages
     *
     * @var [type]
     */
    private $_metas;

    /**
     * CSS de la pages 
     *
     * @var [type]
     */
    private $_stylesheets;

    /**
     * Script JS de la page
     *
     * @var [type]
     */
    private $_scripts;

    /**
     * Si elle est visible ou non
     *
     * @var [type]
     */
    private $_disabled;



    /**
     * --------------------------------------------------
     * MAGIC METHODS
     * --------------------------------------------------
    **/
    /**
     * __construct - Class constructor
     * @param   string      $path
     *          KernelView  $view
     * @return
    **/
    public function __construct( $path, KernelView $view ) {
        $this->_path = $path;
        $this->_view = $view;
        $this->_metas = array();
        $this->_stylesheets = array();
        $this->_scripts = array();
        $this->_disabled = !file_exists( $this->_path );
    }


    /**
     * --------------------------------------------------
     * GETTERS
     * --------------------------------------------------
    **/
     /**
     * Get --------------------------------------------------
     */ 
    public function get_layout(){ return $this->_layout; }

      /**
     * Get the value of _view
     */ 
    public function get_view(){  return $this->_view;  }
    
    /**
     * Get chemin
     *
     * @return  [type]
     */ 
    public function get_path(){ return $this->_path; }

    /**
     * Get metas de la pages
     *
     * @return  [type]
     */ 
    public function get_metas(){return $this->_metas; }

    /**
     * Get cSS de la pages
     *
     * @return  [type]
     */ 
    public function get_stylesheets(){return $this->_stylesheets; }

    /**
     * Get script JS de la page
     *
     * @return  [type]
     */ 
    public function get_scripts(){return $this->_scripts; }

    /**
     * Get si elle est visible ou non
     *
     * @return  [type]
     */ 
    public function get_disabled(){return $this->_disabled; }




    
    /**
     * --------------------------------------------------
     * SETTERS
     * --------------------------------------------------
    **/
    /**
     * setLayout -
     * @param   [string     $layout]
     * @return
    **/
    public function setLayout( $layout = NULL ) {
        $this->_layout = ( $layout!==NULL ? $layout : 'main' );
        if( $layout===FALSE)
            $this->_disabled = TRUE;
    }
    /**
     * Set view
     *
     * @param  [type]  $_view  View
     *
     * @return  self
     */ 
    public function set_view( $_view)
    {
        $this->_view = $_view;

        return $this;
    }

    /**
     * Set chemin
     *
     * @param  [type]  $_path  Chemin
     *
     * @return  self
     */ 
    public function set_path( $_path)
    {
        $this->_path = $_path;

        return $this;
    }

    

    /**
     * Set metas de la pages
     *
     * @param  [type]  $_metas  Metas de la pages
     *
     * @return  self
     */ 
    public function set_metas( $_metas)
    {
        $this->_metas = $_metas;

        return $this;
    }

    /**
     * Set cSS de la pages
     *
     * @param  [type]  $_stylesheets  CSS de la pages
     *
     * @return  self
     */ 
    public function set_stylesheets( $_stylesheets)
    {
        $this->_stylesheets = $_stylesheets;

        return $this;
    }

    /**
     * Set script JS de la page
     *
     * @param  [type]  $_scripts  Script JS de la page
     *
     * @return  self
     */ 
    public function set_scripts( $_scripts)
    {
        $this->_scripts = $_scripts;

        return $this;
    }
    
    /**
     * Set si elle est visible ou non
     *
     * @param  [type]  $_disabled  Si elle est visible ou non
     *
     * @return  self
     */ 
    public function set_disabled( $_disabled)
    {
        $this->_disabled = $_disabled;

        return $this;
    }



    /**
     * --------------------------------------------------
     * METHODS
     * --------------------------------------------------
    **/
    /**
     * wrap -
     * @param   [string     $html]
     * @return
    **/
    public function wrap( $html = '' ) {
        extract( $this->_view->getProperties() );

        if( !$this->_disabled )
            if( file_exists( $this->_path . $this->_layout . '.php' ) ) :
                ob_start();
                include( $this->_path . $this->_layout . '.php' );
                $html = ob_get_contents();
                ob_end_clean();
            else :
                throw new KernelException( 'Layout <strong>' . $this->_layout . '</strong> not found in <strong>' . $this->_path . '</strong>', 10 );
            endif;

        return $html;
    }

    /**
     * getThemeUri -
     * @param
     * @return
    **/
    public function getThemeUri() {
        return ASSETS_URL . '';
    }

    /**
     * printHeader - Displays header's tags
     * @param
     * @return
    **/
    public function printHeader() {
        print_r( '
<link rel="stylesheet" type="text/css" href="' . $this->getThemeUri() . 'fonts/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="' . $this->getThemeUri() . 'css/style.css">' );
    }

    /**
     * printFooter - Displays footer's tags
     * @param
     * @return
    **/
    public function printFooter() {
        print_r( '
        
        ' );
    }

    /**
     * printLogo - Displays logo
     * @param
     * @return
    **/
    public function printLogo() {
        print_r( '<img alt="" src="' . $this->getThemeUri() . 'images/logo.png" />' );
    }

    /**
     * printMenu - Displays menu
     * @param
     * @return
    **/
    public function printMenu() {
        print_r( '
<ul class="primary-menu" id="primary-menu">
    <li class="current-menu-item"><a href="." title="">Accueil</a></li>
    ' . ( isset( $menu_items ) ? $menu_items : '' ) . '
</ul>' );
    }

   

  




    
}