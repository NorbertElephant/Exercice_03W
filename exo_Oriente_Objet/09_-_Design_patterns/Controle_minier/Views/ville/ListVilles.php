<?php


/************************* HEAD  *************************************************************/
 include('D:\www\09_-_Design_patterns\TP\Controle_minier\head.php');?>
        <title>Listing des Villes | Control minier</title>
    </head>

    <body>
    
            <?php
            /************************* HEADER  *************************************************************/
             include('D:\www\09_-_Design_patterns\TP\Controle_minier\nav.php'); ?>
        <main>
            <h1 > Listing des Villes </h1>
            <div class="table-responsive table--no-card m-b-40">
                <table class="table table-borderless table-striped table-earning">
                    <thead>   
                        <tr>
                            <th>Nom</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($villes as  $value) {
                            echo '<tr>';
                            echo '<td><a href="?c=Ville&ville='.$value->get_id().'">'.$value->get_nom().'</td>';   
                        }
                        ?>                         
                    </tbody>
                </table>
            <div>



        </main>
 

<?php 
/************************* FOOTER  *************************************************************/

include('D:\www\09_-_Design_patterns\TP\Controle_minier\footer.php');?>