<?php
/**
 * Ce fichier fait partie de l'exercice "OOP - Dessins géométriques"
 *
 * La classe Circle permet de gérer un cercle
 *
 * @package OOP - Dessins géométriques
 * @copyright 2018 Objectif 3W
 * @author Damien <d.tivelet[@]objectif3w.com>
 */
class Circle extends Shape {
 /**
     * --------------------------------------------------
     * Attributs
     * --------------------------------------------------
     */

    /**
     * $_radius Rayon du cercle
     * @var int
     */
    private $_radius;
    
    /**
     * __construct Constructeur de la classe
     *
     * @param integer $radius le Rayon du Cercle
     * @param array $coordinates Coordonnées du rectangle (par défaut : array( 'x'=>0, 'y'=>0 ))
     * @throws
     * @return
     */
    public function __construct( $radius, $coordinates = array( 'x'=>0, 'y'=>0 ) ) {
        Parent::__construct($coordinates);
        $this->setRadius( $radius ); // On force le rayon à être supérieure à zéro
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
            <td>Rayon</td>
            <td>' . $this->getRadius() . '</td>
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
        $area = pi() * pow($this->_radius,2);

         return $area;
     }


     public function perimeter(){
        $perimeter = 2 * pi() * $this->_radius ;


        return   $perimeter;
     }



    /**
     * --------------------------------------------------
     * Setters
     * --------------------------------------------------
     */

        /**
     * setRadius Setter de l'attribut $_radius
     *
     * @param int $valRayon du Cercle
     * @throws
     * @return
     */
    public function setRadius( $val ) {
        $this->_radius = abs( $val );
    }


    /**
     * --------------------------------------------------
     * Getters
     * --------------------------------------------------
     */

    /**
     * getRadius Getter de l'attribut $_radius
     *
     * @param
     * @throws
     * @return int Le Rayon du Cercle
     */
    public function getRadius() {
        return $this->_radius;
    }

}