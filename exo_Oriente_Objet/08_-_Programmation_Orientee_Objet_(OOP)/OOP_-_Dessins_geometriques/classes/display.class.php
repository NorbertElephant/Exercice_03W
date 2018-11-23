<?php
/**
 * Ce fichier fait partie de l'exercice "OOP - Dessins géométriques"
 *
 * La classe Display permet de gérer la création et l'affichage des formes géométriques
 *
 * @package OOP - Dessins géométriques
 * @copyright 2018 Objectif 3W
 * @author Damien <d.tivelet[@]objectif3w.com>
 */
class Display {
    /**
     * --------------------------------------------------
     * Attributs
     * --------------------------------------------------
     */

    /**
     * $_width Largeur de la zone d'affichage
     * @var int
     */
    private $_width;
    /**
     * $_height Hauteur de la zone d'affichage
     * @var int
     */
    private $_height;
    /**
     * $_filename Nom du fichier à créer
     * @var string
     */
    private $_filename;
    /**
     * $_rgb Colorimétrie
     * @var array
     */
    private $_rgb;
    /**
     * $_resource Ressource image
     * @var ressource
     */
    public $_resource;



    /**
     * --------------------------------------------------
     * Setters
     * --------------------------------------------------
     */

    /**
     * setRGB Setter de l'attribut $_rgb
     *
     * @param array $rgb Tableau correspondant à la couleur avec les clés red, green, blue (par défaut :  array( 'red'=>255, 'green'=>255, 'blue'=>255 ))
     * @throws Exception
     * @return bool
     */
    public function setRGB( $rgb = array( 'red'=>255, 'green'=>255, 'blue'=>255 ) ) {
        if( is_array( $rgb ) && isset( $rgb['red'] ) && isset( $rgb['green'] ) && isset( $rgb['blue'] ) ) :
            $this->_rgb = $rgb;
            $this->init(); // On réinitialise la couleur de fond de l'image

            return true;
        endif;

        throw new Exception( 'Set correct RGB information using : array( \'red\'=>255, \'green\'=>255, \'blue\'=>255 )' );
        return false;
    }



    /**
     * --------------------------------------------------
     * Méthodes magiques
     * --------------------------------------------------
     */

    /**
     * __construct Constructeur de la classe
     *
     * @param integer $width Largeur de la zone d'affichage
     * @param integer $height Hauteur de la zone d'affichage
     * @param string $filename Nom du fichier image (par défaut : tmp.png)
     * @param array $rgb Colorimétrie (par défaut :  array( 'red'=>255, 'green'=>255, 'blue'=>255 ))
     * @throws
     * @return
     */
    public function __construct( $width, $height, $filename = 'tmp.png', $rgb = array( 'red'=>255, 'green'=>255, 'blue'=>255 ) ) {
        $this->_width = ctype_digit( $width ) ? $width : NULL;
        $this->_height = ctype_digit( $height ) ? $height : NULL;
        $this->_filename = $filename;
        if( !is_null( $this->_width ) && !is_null( $this->_height ) )
            $this->_resource = imagecreatetruecolor( $this->_width, $this->_height ); // On crée une nouvelle image en couleurs vraies (http://php.net/manual/fr/function.imagecreatetruecolor.php)

        $this->setRGB( $rgb );
    }

    /**
     * __destruct Destructeur de la classe
     *
     * @param
     * @throws
     * @return
     */
    public function __destruct() {
        if( !is_null( $this->_resource ) )
            imagedestroy( $this->_resource ); // On détruit l'image
    }

    /**
     * __toString Interpête l'affichage de l'instance
     *
     * @param
     * @throws
     * @return
    **/
    public function __toString() {
        return '<fieldset>
    <legend>Attributs de l\'image</legend>

    <table>
        <tr>
            <td>Largeur</td>
            <td>' . $this->_width . '</td>
        </tr>
        <tr>
            <td>Hauteur</td>
            <td>' . $this->_height . '</td>
        </tr>
        <tr>
            <td>Fichier</td>
            <td>' . $this->_filename . '</td>
        </tr>
        <tr>
            <td>Couleur de fond</td>
            <td>R: ' . ( isset( $this->_rgb['red'] ) ? $this->_rgb['red'] : '' ) . ' G: ' . ( isset( $this->_rgb['green'] ) ? $this->_rgb['green'] : '' ) . ' B: ' . ( isset( $this->_rgb['blue'] ) ? $this->_rgb['blue'] : '' ) . '</td>
        </tr>
    </table>
</fieldset>';
    }



    /**
     * --------------------------------------------------
     * Méthodes
     * --------------------------------------------------
     */

    /**
     * init Initialiser un dessin en forme de rectangle
     *
     * @param
     * @throws
     * @return
     */
    public function init() {
        if( !is_null( $this->_resource ) && is_array( $this->_rgb ) )
            $color = imagecolorallocate( $this->_resource, $this->_rgb['red'], $this->_rgb['green'], $this->_rgb['blue'] ); // On alloue une couleur pour une image (http://php.net/manual/fr/function.imagecolorallocate.php)

        if( !is_null( $this->_resource ) && is_numeric( $this->_width ) && is_numeric( $this->_height ) && isset( $color ) )
            imagefilledrectangle( $this->_resource, 0, 0, $this->_width, $this->_height, $color ); // On dessine un rectangle rempli
    }

    /**
     * createImage Créer le fichier image
     *
     * @param
     * @throws
     * @return
     */
    public function createImage() {
        if( !is_null( $this->_resource ) && !empty( $this->_filename ) )
            imagepng( $this->_resource, $this->_filename ); // On envoie une image PNG vers un fichier
    }

    /**
     * saveAs Enregistrer l'image sous un nouveau nom
     *
     * @param string $filename Nom du fichier
     * @throws
     * @return
     */
    public function saveAs( $filename ) {
        $this->_filename = $filename;
        imagepng( $this->_resource, $this->_filename );
    }

    /**
     * drawRectangle Dessiner un rectangle
     *
     * @param object $shape
     * @param array $rgb
     * @throws
     * @return
     */
    public function drawRectangle( $shape, $rgb ) {
        $color = imagecolorallocate( $this->_resource, $rgb['red'], $rgb['green'], $rgb['blue'] );
        $x1 = $shape->getX() - $shape->getWidth() / 2;
        $y1 = $shape->getY() - $shape->getHeight() / 2;
        $x2 = $shape->getX() + $shape->getWidth() / 2;
        $y2 = $shape->getY() + $shape->getHeight() / 2;
        imagefilledrectangle( $this->_resource, $x1, $y1, $x2, $y2, $color );
    }

    /**
     * drawSquare Dessiner un carré
     *
     * @param object $shape
     * @param array $rgb
     * @throws
     * @return
     */
    public function drawSquare( $shape, $rgb ) {
        $this->drawRectangle( $shape, $rgb );
    }

    /**
     * drawCircle Dessiner un circle
     *
     * @param object $shape
     * @param array $rgb
     * @throws
     * @return
     */
    public function drawCircle( $shape, $rgb ) {
        $color = imagecolorallocate( $this->_resource, $rgb['red'], $rgb['green'], $rgb['blue'] );
        imagefilledellipse( $this->_resource, $shape->getX(), $shape->getY(), $shape->getRadius() * 2, $shape->getRadius() * 2, $color );
    }

    /**
     * displayHTMLImage - Afficher l'image sous forme de balise HTML
     *
     * @param
     * @throws
     * @return
     */
    public function displayHTMLImage() {
        $this->createImage();
        echo '<img alt="" src="' . $this->_filename . '" />';
    }
}