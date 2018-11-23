<?php




/************************* HEAD  *************************************************************/
 include('D:\www\09_-_Design_patterns\TP\Controle_minier\head.php');?>
        <title>Listing des des Groupes | Control minier</title>
    </head>

    <body>
    
            <?php
            /************************* HEADER  *************************************************************/
             include('D:\www\09_-_Design_patterns\TP\Controle_minier\nav.php'); ?>
        <main>
            <h1> Listing des Groupes de Nain </h1>
            <div class="table-responsive table--no-card m-b-40">
                <table class="table table-borderless table-striped table-earning">
                    <thead>   
                        <tr>
                            <th>Numéro du Groupe</th>
                            <th>Nombres de Nains</th>
                            <th>Bistrot</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($groupes as  $value) {
                            echo '<tr>';
                            echo '<td> <a href="?c=Groupe&groupe='.$value->get_id().'">'.$value->get_id().'</a> </td>';
                            echo '<td>'.$value->get_nbreNains().'  </td>';
                            if ($value->get_taverne_fk() != '') {
                                echo '<td> <a href="?c=Taverne&taverne='.$value->get_taverne_fk().'"> '.$value->get_nom_taverne().'</a></td>';
                            } else {
                                echo '<td> Non alcoolique </td>';
                            }
                            
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