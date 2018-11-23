<?php 

/**
 * Livre......... Permet d'avancer dans l'histoire
 *
 * @param int $choice ........... page a atteindre
 * @return void
 */

 function Livre($choice){

    include('./_db/story.php'); 

    // Afficher le Titre 

        echo '<h2 class="text-center"> Chapitre ' . $_SESSION['story']['Chapitre']  . '</h2> <br>' ; 
            
    $_SESSION['story']['Chapitre']++;

    
    // Afficher l'histoire 

       echo  $story[$choice]['text'];


    // Afficher Les Choix possibles

    $NbreChoix = count($story[$choice]["choice"]);

    for ($i = 0; $i <= $NbreChoix-1; $i++) {
        echo '<form method="POST" action=".">

                <div ><button name="choice" type="submit" class="btn btn-primary" value ='. $story[$choice]["choice"][$i]["goto"].' >
                        '. $story[$choice]["choice"][$i]["text"]. '
                </button> </div>
                <br> 
            </form> 
            ';

            $_SESSION['story']['TextChoice'] = $story[$choice]["choice"][$i]["text"];
    }
 }


/**
 * FinPartie................. Différents cas de fin de partie
 *
 * @param string $Fin.......... Différents  types de fin de partie
 * @return void
 */
function FinPartie($Fin) {
    switch ($Fin) {
        case 'Tomber dans les pommes':?>
            <div><img class="img-thumbnail" src='images/tomber.jpg' alt='tomber'/> </div>
            <?php echo 'Vous êtes tomber dans les pommes... <br>
            <a href="?deconnect">Recommencer une partie</a>';
            break;

        case 'Prendre le raccourci scénaristique inexpliquable':?>
            <div><img class="img-thumbnail" src='images/ninja.jpg' alt='MortDongeon'/> </div>
            <?php echo 'Ninja ! comme par magie tu recommences dans ta cellule :o <br>';
            Livre(0);
            break;
        
        case 'Continuer': ?>
            <div><img class="img-thumbnail" src='images/Mourir.jpg' alt='MortDongeon'/> </div>
            <?php echo 'Vous êtes mort comme une sombre merde... <br>
            <a href="?deconnect">Recommencer une partie</a>';
            break;

       case 'Recommencer': ?>
            <div><img class="img-thumbnail" src='images/Mourir.jpg' alt='MortDongeon'/> </div>
            <?php echo 'Vous êtes mort comme une sombre merde... <br>
            <a href="?deconnect">Recommencer une partie</a>';
                break;

        case 'Pleurer': ?>
             <div><img class="img-thumbnail" src='images/pleure.jpg' alt='MortDongeon'/> </div>
            <?php echo 'Vous avez tellement pleurer que vous vous êtes asséché et mort dans d\'atroce souffrance... <br>
            <a href="?deconnect">Recommencer une partie</a>';
            break;

        case 'Faire une nouvelle partie': ?>
            <div><img class="img-thumbnail" src='images/Fin.jpg' alt='MortDongeon'/></div>
            <?php echo 'Vous êtes fort chanceux ! Voulez vous retenter votre chance dans le Gungeon ?  <br>
            Gloire et Richesse vous attends ! <br>
                <a href="?deconnect">Recommencer une partie</a>';
            break;

        default:
        echo '<h2> Fin de Partie </h2> <br> vous avez essayé de tricher ! :/  <br> C\'est pas bien ! <br> 
        <a href="?deconnect">Recommencer une partie</a>';
            break;
    }
}


?> 