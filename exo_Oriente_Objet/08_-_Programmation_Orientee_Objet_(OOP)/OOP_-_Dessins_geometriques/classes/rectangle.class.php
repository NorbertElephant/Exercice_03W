<?php
/**
 * Ce fichier fait partie de l'exercice "OOP - Dessins géométriques"
 *
 * La classe Rectangle permet de gérer un rectangle
 *
 * @package OOP - Dessins géométriques
 * @copyright 2018 Objectif 3W
 * @author Damien <d.tivelet[@]objectif3w.com>
 */
class Rectangle extends Shape  {
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
     * --------------------------------------------------
     * Méthodes magiques
     * --------------------------------------------------
     */

    /**
     * __construct Constructeur de la classe
     *
     * @param integer $width Largeur du rectangle
     * @param integer $height Hauteur du rectangle
     * @param array $coordinates Coordonnées du rectangle (par défaut : array( 'x'=>0, 'y'=>0 ))
     * @throws
     * @return
     */
    public function __construct( $width , $height, $coordinates = array( 'x'=>0, 'y'=>0 ) ) {
        Parent::__construct($coordinates);
        $this->setWidth( $width ); // On force la largeur à être supérieure à zéro
        $this->setHeight( $height ); // On force la hauteur à être supérieure à zéro
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
    <legend>' . get_class( $this ) . '</legend>

    <table>
        <tr>
            <td>Largeur</td>
            <td>' . $this->getWidth() . '</td>
        </tr>
        <tr>
            <td>Hauteur</td>
            <td>' . $this->getHeight() . '</td>
        </tr>
        <tr>
            <td>Aire</td>
            <td>' . $this->area() . '</td>
        </tr>
        <tr>
            <td>Périmètre</td>
            <td>' . $this->perimeter() . '</td>
        </tr>
    </table>
</fieldset>';
    }

/**
     * --------------------------------------------------
     * fucntions
     * --------------------------------------------------
     */
     public function area(){
        $area = $this->_width * $this->_height;

         return $area;
     }


     public function perimeter(){
        $perimeter = 2* ($this->_width + $this->_height);

        return   $perimeter;
     }

    /**
     * --------------------------------------------------
     * Setters
     * --------------------------------------------------
     */

    /**
     * setWidth Setter de l'attribut $_width
     *
     * @param int $val Largeur du rectangle
     * @throws
     * @return
     */
    public function setWidth( $val ) {
        $this->_width = abs( $val );
    }

    /**
     * setHeight Setter de l'attribut $_height
     *
     * @param int $val Hauteur du rectangle
     * @throws
     * @return
     */
    public function setHeight( $val ) {
        $this->_height = abs( $val );
    }



    /**
     * --------------------------------------------------
     * Getters
     * --------------------------------------------------
     */

    /**
     * getWidth Getter de l'attribut $_width
     *
     * @param
     * @throws
     * @return int La largeur du rectangle
     */
    public function getWidth() {
        return $this->_width;
    }

    /**
     * getHeight Getter de l'attribut $_height
     *
     * @param
     * @throws
     * @return int La hauteur du rectangle
     */
    public function getHeight() {
        return $this->_height;
    }



    
}