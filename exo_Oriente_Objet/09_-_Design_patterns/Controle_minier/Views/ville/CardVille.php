<?php

/************************* HEAD  *************************************************************/
 include('D:\www\09_-_Design_patterns\TP\Controle_minier\head.php');?>
        <title>Carte de la Ville | Control minier</title>
    </head>

    <body>
    
            <?php
            /************************* HEADER  *************************************************************/
             include('D:\www\09_-_Design_patterns\TP\Controle_minier\nav.php'); ?>
        <main>
            <h1> Bienvenu à la Ville de <?php echo $ville->get_nom(); ?>  </h1>
            <div>
                <img class="flex-center" src=".\assets\images\ville.jpg" alt="CoolAdmin" >
            </div>
            <div>
            <p>Sa superficie est de <?php echo $ville->get_superficie(); ?> Hectares sous la montagne... </p>
            <br>
            </div>
            <div>
            <h2>Quelques Infos sur  <?php echo $ville->get_nom(); ?>  : </h2>
            </div>
            <div class=" row col-lg-12" style="padding-top:100px">
                <div class="col-lg-6">
                    <h3 class="title-3 m-b-30">Nains Originaires de la Ville</h3>
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
                    <h3 class="title-3 m-b-30">Tavernes de la Ville</h3>
                    <div >
                        <table class="table table-top-campaign">
                            <thead>
                                <tr>
                                <th> Nom </th>
                                <th style="text-align:right"> Bières Dispo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($tavernes as $value) {
                                        echo '<tr>';
                                        echo '<td> <a href="?c=Tavernes&taverne='.$value->get_id().'">'. $value->get_nom().'</td>';
                                        echo '<td>'. $value->get_bieres().'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class=".col-md-4 .ml-auto">
                    <h3 class="title-3 m-b-30">Tunnel de la Ville</h3>
                    <div >
                        <table class="table table-top-campaign">
                            <thead>
                                <tr>
                                <th> Ville d'arrivée </th>
                                <th style="text-align:right"> Progression</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($tunnels as $value) {
                                        echo '<tr>';
                                        if ($value->get_villearrivee_fk() == $ville->get_id()) {
                                            echo '<td> <a href="?c=Ville&ville='.$value->get_villedepart_fk().'">'. $value->get_nom_villedepart().'</td>';
                                            if ($value->get_progres() == 100) {
                                                    echo '<td> Ouvert</td>';
                                            } else {
                                                echo '<td>'. $value->get_progres().'</td>';
                                            }
                                        } else {
                                            echo '<td> <a href="?c=Ville&ville='.$value->get_villearrivee_fk().'">'. $value->get_nom_villearrivee().'</td>';
                                            if ($value->get_progres() == 100) {
                                                    echo '<td> Ouvert</td>';
                                            } else {
                                                echo '<td>'. $value->get_progres().'</td>';
                                            }
                                        } 
                                        
                                         
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



        </main>
 

<?php 
/************************* FOOTER  *************************************************************/

include('D:\www\09_-_Design_patterns\TP\Controle_minier\footer.php');?>