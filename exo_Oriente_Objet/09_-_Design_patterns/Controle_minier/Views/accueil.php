<?php




/************************* HEADER  *************************************************************/
 include('D:\www\09_-_Design_patterns\TP\Controle_minier\head.php');?>
        <title>Accueil | Control minier</title>
    </head>

    <body>
    <header>
        <?php include('D:\www\09_-_Design_patterns\TP\Controle_minier\nav.php'); ?>
        <h1> Accueil | Control minier </h1>
    </header>
    

    <main>
        <div style="display:flex;justify-content:center;">
            <img src="./assets/images/Accueil_Nain.jpg" alt="Image Accueil" >
        </div>
        <div class=" row col-lg-12">
            <div class="col-sm-3">
                <h2>  Nains </h2>
                <div class="table-responsive table--no-card m-b-40">
                    <table class="table table-borderless table-striped table-earning">
                        <thead>   
                            <tr>
                                <th>Nom</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach ($nains as  $value) {
                                echo '<tr>';
                                echo '<td> <a href="?c=Nain&nain='.$value->get_id().'">'.$value->get_nom().'</a> </td>';
                            }
                            ?>                         
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-3">
                <h2>  Groupes de Nain </h2>
                <div class="table-responsive table--no-card m-b-40">
                    <table class="table table-borderless table-striped table-earning">
                        <thead>   
                            <tr>
                                <th>Groupe</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach ($groupes as  $value) {
                                echo '<tr>';
                                echo '<td> <a href="?c=Groupe&groupe='.$value->get_id().'">'.$value->get_id().'</a> </td>';
                                echo '</tr>';
                            }
                            ?>                         
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-3">
            <h2>Villes </h2>
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
            </div>
        </div>
        <div  class="col-sm-3">
            <h2 >Tavernes </h2>
            <div class="table-responsive table--no-card m-b-40">
                <table class="table table-borderless table-striped table-earning">
                    <thead>   
                        <tr>
                            <th>Nom</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($tavernes as  $value) {
                            echo '<tr>';
                            echo '<td><a href="?c=Taverne&taverne='.$value->get_id().'">'.$value->get_nom().'</td>';
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