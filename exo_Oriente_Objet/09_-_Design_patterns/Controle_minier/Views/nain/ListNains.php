<?php




/************************* HEAD  *************************************************************/
 include('D:\www\09_-_Design_patterns\TP\Controle_minier\head.php');?>
        <title>Listing des Nains | Control minier</title>
    </head>

    <body>
    
            <?php
            /************************* HEADER  *************************************************************/
             include('D:\www\09_-_Design_patterns\TP\Controle_minier\nav.php'); ?>
        <main>
            <h1> Listing des Nains </h1>
            <div class="table-responsive table--no-card m-b-40">
                <table class="table table-borderless table-striped table-earning">
                    <thead>   
                        <tr>
                            <th>Nom</th>
                            <th>Longueur Barbe</th>
                            <th>Originaire</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($nains as  $value) {
                            echo '<tr>';
                            echo '<td> <a href="?c=Nain&nain='.$value->get_id().'">'.$value->get_nom().'</a> </td>';
                            echo '<td>'.$value->get_barbe().' mm. </td>';
                            echo '<td> <a href="?c=Ville&ville='.$value->get_ville_fk().'"> '.$value->get_nom_ville().'</a></td>';
                            echo '</tr>';
                            
                        }
                        ?>                         
                    </tbody>
                </table>
            <div>



        </main>
 

<?php 
/************************* FOOTER  *************************************************************/

include('D:\www\09_-_Design_patterns\TP\Controle_minier\footer.php');?>