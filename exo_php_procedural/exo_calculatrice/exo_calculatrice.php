<?php

if(isset($_POST['Nombre1'])&& isset($_POST['Nombre2'])&& isset($_POST['operation'])) {
    /// remplacer les ',' par des '.' pour le calcul
    $nombre1 = str_replace(",", ".", $_POST['Nombre1']);
    $nombre2 = str_replace( ",", ".",$_POST['Nombre2']);

    if(is_numeric($nombre1) && is_numeric($nombre2)) {
        //// Différents cas pour chaque opérations
        switch ($_POST["operation"]) {
            case '+':
                $resultat = $nombre1 + $nombre2;
                $signe = ' + ' ;
                break;
                

            case '-':
                $resultat = $nombre1 - $nombre2;
                $signe = ' - ' ;
                break;
                
            case '*':
                $resultat = $nombre1 * $nombre2;
                $signe = ' x ' ;
                break;
            case '/':
                if($_nombre2 == 0 ){
                    $resultat = 'Il est impossible de Diviser par 0 ! ';
                }else {
                    $resultat = $nombre1 / $nombre2;
                $signe = ' / ' ;
                }
            break;
        }

    } else { /// s'il rentre des lettres 
        $resultat = "Il faut des nombres pas des lettres billy ! tu sais les trucs comme 1,2,3..... ";
    }
} else { // Si rien de rentrer 
    $resultat = "Il faut rentrer des valeurs. ";
}

?>

<!-- Visuel HTML --> 

<form method ="POST"  >
<input name="Nombre1" type="number" value ="<?php if(isset($_POST['Nombre1'])){echo $nombre1;} ?> ">
    
<select name="operation"> 
    <option <?php if (isset($signe) && $signe == ' + ') echo 'selected'; ?> > + </option>
    <option<?php if (isset($signe) && $signe == ' - ') echo 'selected'; ?>  > - </option>
    <option<?php if (isset($signe) && $signe == ' x ') echo 'selected'; ?>  > x </option>
    <option<?php if (isset($signe) && $signe == ' / ') echo 'selected'; ?>  > / </option>
</select>
<input name="Nombre2" type="number" value ="<?php if(isset($_POST['Nombre2'])){echo $nombre2;} ?> ">
    
<input type="submit"value="=">

<?php echo $resultat; ?>


</form>


