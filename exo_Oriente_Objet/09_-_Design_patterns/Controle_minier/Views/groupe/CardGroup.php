<?php

/************************* HEAD  *************************************************************/
 include('D:\www\09_-_Design_patterns\TP\Controle_minier\head.php');?>
        <title>Fiche du Groupe  | Control minier</title>
    </head>

    <body>
    
            <?php
            /************************* HEADER  *************************************************************/
             include('D:\www\09_-_Design_patterns\TP\Controle_minier\nav.php'); ?>
        <main>
            <h1> Fiche du Groupe  : <?php echo $groupe->get_id();?>  </h1>
            <div>
                <img style="align-item:center" src=".\assets\images\groupenain.jpg" alt="CoolAdmin" >
            </div>
            <div class=" row col-lg-12" style="padding-top:100px">
                <div class="col-lg-6">
                    <h3 class="title-3 m-b-30">Nains du Groupe </h3>
                    <div >
                        <table class="table table-top-campaign">
                            <thead>
                                <tr>
                                <th> Nom </th>
                                <th style="text-align:right"> Longueur de sa Barbe</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($nains as $value) {
                                        echo '<tr>';
                                        echo '<td> <a href="?c=Nain&nain='.$value->get_id().'">'. $value->get_nom().'</td>';
                                        echo '<td>'. $value->get_barbe().' mm.</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h3 class="title-3 m-b-30">Bistrot</h3>
                    <div >
                        <table class="table table-top-campaign">
                            <thead>
                                <tr>
                                <th> Nom </th>
                                <th > Bières Dispo</th>
                                <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                echo '<tr>';
                                echo '<td> <a href="?c=Tavernes&taverne='.$taverne->get_id().'">'. $taverne->get_nom().'</td>';
                                echo '<td>'. $taverne->get_bieres().'</td>';
                                if (SRequest::getInstance()->get('updateGroupe')) {
                                    echo '<td> <input class="btn btn-warning" type="submit" name="Update" value="Mettre à Jour le Bistrot"> </td> ';
                                } else {
                                    echo ' <td> <a href=".?c=Groupe&groupe='.SRequest::getInstance()->get('groupe').'&updateGroupe='.SRequest::getInstance()->get('groupe').'"
                                <i class="zmdi zmdi-edit"></i>
                            </a> </td> ';
                                }
                                echo '</tr>';
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class=".col-lg-6 ">
                    <h3 class="title-3 m-b-30">Travail</h3>
                    <div >
                        <table class="table table-top-campaign">
                            <thead>
                                <tr>
                                <th> Heure de Travail </th>
                                <th> Travail</th>
                                <th> Départ du Tunnel </th>
                                <th> Fin du Tunnel </th>
                                <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    echo '<tr>';
                                    echo '<td>'. $groupe->get_debuttravail().' à '. $groupe->get_fintravail().' </td>';
                                    if ($tunnel->get_progres() == 100) {
                                        $travail = 'Entretiennent';
                                    } else {
                                        $travail = 'Creusent fini a '.$tunnel->get_progres();
                                    }
                                    echo '<td> '.$travail.' </td>' ;
                                    echo '<td> <a href="?c=Ville&ville='.$tunnel->get_villedepart_fk().'"> '.$tunnel->get_nom_villedepart().'</a> </td> ';
                                    echo '<td> <a href="?c=Ville&ville='.$tunnel->get_villearrivee_fk().'"> '.$tunnel->get_nom_villearrivee().' </a>  </td>';
                                    if (SRequest::getInstance()->get('updateGroupe')) {
                                        echo '<td> <input class="btn btn-warning" type="submit" name="Update" value="Mettre à Jour Travail"> </td> ';
                                    } else {
                                        echo ' <td> <a href=".?c=Groupe&groupe='.SRequest::getInstance()->get('groupe').'&updateGoupe='.SRequest::getInstance()->get('groupe').'"
                                    <i class="zmdi zmdi-edit"></i>
                                </a> </td> ';
                                    echo '</tr>';

                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>



        </main>
 

<?php 
/************************* FOOTER  *************************************************************/

include('D:\www\09_-_Design_patterns\TP\Controle_minier\footer.php');?>