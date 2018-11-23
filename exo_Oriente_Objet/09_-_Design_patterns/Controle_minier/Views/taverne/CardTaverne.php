<?php




/************************* HEAD  *************************************************************/
 include('D:\www\09_-_Design_patterns\TP\Controle_minier\head.php');?>
        <title>Carte de la Taverne | Control minier</title>
    </head>

    <body>
    
            <?php
            /************************* HEADER  *************************************************************/
             include('D:\www\09_-_Design_patterns\TP\Controle_minier\nav.php'); ?>
        <main>
            <h1> Bienvenu à la Taverne du <?php echo $taverne->get_nom(); ?> </h1>
            <div>
                <img src=".\assets\images\taverne.jpg" alt="CoolAdmin" >
            </div>
            <div class="table-responsive table--no-card m-b-40">
                <table class="table table-borderless table-striped table-earning">
                    <thead>   
                        <tr>
                            <th>Ville</th>
                            <th>Bières</th>
                            <th>Nombres de Chambres </th>
                            <th>Chambres Libres</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            echo '<tr>';
                            echo '<td> <a href="?c=Ville&ville='.$taverne->get_ville_fk().'"> '.$taverne->get_ville().'</td>';
                            echo '<td>'.$taverne->get_bieres().'</td>';
                            echo '<td>'.$taverne->get_chambres().'</td>';
                            echo '<td>'.$taverne->get_chambresLibres().'</td>';
                        ?>                         
                    </tbody>
                </table>
            <div>



        </main>
 

<?php 
/************************* FOOTER  *************************************************************/

include('D:\www\09_-_Design_patterns\TP\Controle_minier\footer.php');?>