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
            <h1 > Listing des Tavernes </h1>
            <div class="table-responsive table--no-card m-b-40">
                <table class="table table-borderless table-striped table-earning">
                    <thead>   
                        <tr>
                            <th>Nom</th>
                            <th>Ville</th>
                            <th>Bières</th>
                            <th>Nombres de Chambres </th>
                            <th>Chambres Libres</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($tavernes as  $value) {
                            echo '<tr>';
                            echo '<td><a href="?c=Taverne&taverne='.$value->get_id().'">'.$value->get_nom().'</td>';
                            echo '<td> <a href="?c=Ville&ville='.$value->get_ville_fk().'"> '.$value->get_ville().'</td>';
                            echo '<td>'.$value->get_bieres().'</td>';
                            echo '<td>'.$value->get_chambres().'</td>';
                            echo '<td>'.$value->get_chambresLibres().'</td>';
                            
                        }
                        ?>                         
                    </tbody>
                </table>
            <div>



        </main>
 

<?php 
/************************* FOOTER  *************************************************************/

include('D:\www\09_-_Design_patterns\TP\Controle_minier\footer.php');?>