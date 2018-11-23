<?php

$abreviation = readline ('Civilité M / Mlle / M / Autre ? ');

switch( $abreviation ) {
    case "Mme":
        echo 'Bonjour Madame';    
    break;
    case "Mlle":
        echo 'Bonjour Mademoiselle';    
    break;
    case "M":
        echo 'Bonjour Monsieur';    
    break;
    default:
        echo 'Bonjour Transgenre';
        break;
}

?>