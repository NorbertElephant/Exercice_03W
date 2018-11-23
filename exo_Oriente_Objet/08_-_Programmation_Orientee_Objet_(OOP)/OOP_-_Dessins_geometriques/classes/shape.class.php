<?php
/**
 * Ce fichier fait partie de l'exercice "OOP - Dessins géométriques"
 *
 * La classe Shape permet de gérer une forme géométrique
 *
 * @package OOP - Dessins géométriques
 * @copyright 2018 Objectif 3W
 * @author Damien <d.tivelet[@]objectif3w.com>
 */

 Abstract class Shape {
    /**
     * --------------------------------------------------
     * Attributs
     * --------------------------------------------------
     */

    /**
     * $_x Abscisse
     * @var int
     */
    private $_x;
    /**
     * $_y Ordonnée
     * @var int
     */
    private $_y;


/**
     * --------------------------------------------------
     * Méthodes magiques
     * --------------------------------------------------
     */

    /**
     * __construct Constructeur de la classe
     *
     * @param array $coordinates Coordonnées de la forme dans la zone d'affichage
     * @throws
     * @return
     */
    public function __construct( $coordinates = array( 'x'=>0, 'y'=>0 ) ) {
        $this->_x = isset( $coordinates['x']) && is_numeric( $coordinates['x'] ) ? $coordinates['x'] : 0;
        $this->_y = isset( $coordinates['y']) && is_numeric( $coordinates['y'] ) ? $coordinates['y'] : 0;
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
        <legend>' . get_class() . '</legend>

        <table>
            <tr>
                <td>Abscisse</td>
                <td>' . $this->getX() . '</td>
            </tr>
            <tr>
                <td>Ordonnée</td>
                <td>' . $this->getY() . '</td>
            </tr>
        </table>
    </fieldset>';
    }

    
    /**
     * --------------------------------------------------
     * Abstract
     * --------------------------------------------------
     */
    Abstract public function area();


    Abstract public function perimeter();

    /**
     * --------------------------------------------------
     * Getters
     * --------------------------------------------------
     */

    /**
     * getX Getter de l'attribut $_x
     *
     * @param
     * @throws
     * @return int L'abscisse de la forme géométrique dans la zone d'affichage
     */
    public function getX() {
        return !is_null( $this->_x ) ? $this->_x : 0;
    }

    /**
     * getY Getter de l'attribut $_y
     *
     * @param
     * @throws
     * @return int L'ordonnée de la forme géométrique dans la zone d'affichage
     */
    public function getY() {
        return !is_null( $this->_y ) ? $this->_y : 0;
    }

    
}