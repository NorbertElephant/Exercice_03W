<?php


/************************* HEAD  *************************************************************/
 include('D:\www\09_-_Design_patterns\TP\Controle_minier\head.php');?>
        <title>Fiche du Nain | Control minier</title>
    </head>

    <body>
    
            <?php
            /************************* HEADER  *************************************************************/
             include('D:\www\09_-_Design_patterns\TP\Controle_minier\nav.php'); ?>
        <main>
            <h1> Fiche du Nain : <?php echo $nain->get_nom();?> </h1>
            <?php 
                if (isset($Update)) {
                   echo' <div class="alert alert-success" role="alert">
                    La Modification du groupe du Nain '.$nain->get_nom().' a Bien réussi
                    </div>';
                } elseif(isset($Update) && $Update === false ) {
                    echo'<div class="alert alert-danger" role="alert">
                    La Modification du groupe du Nain '.$nain->get_nom().' a échoué
                    </div>';
                }
            ?>
            <div>
                <img src=".\assets\images\nain2.jpg" alt="CoolAdmin" >
            </div>
            <div class="table-responsive table--no-card m-b-40">
                <table class="table table-borderless table-striped table-earning">
                
                    <thead>   
                        <tr>
                            <th>Nom</th>
                            <th>Longueur Barbe</th>
                            <th>Originaire</th>
                            <?php if ($nain->get_nom_taverne() !== '') {
                              echo '<th>Taverne</th>';
                            } 
                            if ($nain->get_heure_travail()!== '') {
                             echo '<th>Travail</th>';
                            }
                             echo '<th>Groupe</th>';
                             echo '<th> </th>'
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            echo '<tr>';
                            echo '<td> <a href="?c=Nain&nain='.$nain->get_id().'">'.$nain->get_nom().'</a> </td>';
                            echo '<td>'.$nain->get_barbe().' mm. </td>';
                            echo '<td> <a href="?c=Ville&ville='.$nain->get_ville_fk().'"> '.$nain->get_nom_ville().'</a></td>';
                            if ($nain->get_nom_taverne() !== '') {
                                echo '<td><a href="?c=Taverne&taverne='.$nain->get_id_taverne().'">'.$nain->get_nom_taverne().'</td>';
                            }
                            if ($nain->get_heure_travail()!== '') {
                            echo '<td>'.$nain->get_heure_travail().' 
                                h<br> dans le tunnel qui va de <br> 
                                <a href="?c=Ville&ville='.$nain->get_villedepart_fk().'">'.$nain->get_villedepart().'</a>  à   <a href="?c=Ville&ville='.$nain->get_villearrivee_fk().'">'.$nain->get_villearrivee().'
                                 </a></td>';
                            }
                            if (SRequest::getInstance()->get('updateNain')) {
                                echo '<td> <form action=".?c=Nain&nain='.SRequest::getInstance()->get('nain').'" method="post">';
                                echo ' <select name="groupe" id=""> ';
                                if ($nain->get_groupe_fk() == '') {
                                    echo '<option value="0"> Aucun Groupe </option>';
                                    foreach ($group as $key => $value) {
                                        echo'<option value="'.$value->get_id().'">' .$value->get_id().'</option>';
                                    } 
                                } else {
                                    echo '<option value="0"> Aucun Groupe </option>';
                                    foreach ($group as $key => $value) {
                                        if ($nain->get_groupe_fk() == $value->get_id() ) {
                                            echo'<option value="'.$value->get_id().'" selected>' .$value->get_id().'</option>';
                                        } else {
                                            echo'<option value="'.$value->get_id().'">' .$value->get_id().'</option>';
                                        }
                                    }
                                    
                                }
                                echo '</select> </td>';
                            } else {
                                if ($nain->get_groupe_fk() == '') {
                                    echo '<td> Aucun Groupe  </td>';
                                } else {
                                    echo '<td><a href="?c=Groupe&groupe='.$nain->get_groupe_fk().'"> '.$nain->get_groupe_fk().'</a> </td>';
                                }
                                
                            }
                            if (SRequest::getInstance()->get('updateNain')) {
                                echo '<td> <input class="btn btn-warning" type="submit" name="Update" value="Mettre à Jour"> </td> ';
                            } else {
                                echo ' <td> <a href=".?c=Nain&nain='.SRequest::getInstance()->get('nain').'&updateNain='.SRequest::getInstance()->get('nain').'"
                            <i class="zmdi zmdi-edit"></i>
                        </a> </td> ';
                            }
                            
                            echo' </form> </tr>';
                           
            
                        ?>
                                                 
                    </tbody>
                </table>
            <div>


<?php 
/************************* FOOTER  *************************************************************/

include('D:\www\09_-_Design_patterns\TP\Controle_minier\footer.php');?>