<?php
trait Form {
    /**
     * isRequiredPassed -
     * @param   array   $required
     *          array   $fields
     * @return  bool
    **/
    public static function isRequiredPassed( $required, $fields ) {
        foreach( $required as $item ) :
            if( !( isset( $fields[$item] ) && !empty( $fields[$item] ) ) )
                return FALSE;
        endforeach;

        return TRUE;
    }
}