<?php
require_once('./ini.php');
require_once('./lib/common.php');

if(SRequest::getInstance()->get('del')!==null) {
    SRequest::getInstance()->unset('session','streetfighter');
    header('Location:index.php');
    exit;
}


try {
    $personnageManager = new PersonnageManager( SPDO::getInstance( DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO() );
  
  
    if(!empty(SRequest::getInstance()->post('name')) &&  SRequest::getInstance()->post('name') !== null ){
        // var_dump(SRequest::getInstance()->post('name'));
        if($personnageManager->Is_exist(SRequest::getInstance()->post('name')) === false ){
            $create_personnage = $personnageManager->AddPersonnage(SRequest::getInstance()->post('name'));
        } else {
            $error = '<div class="alert alert-danger" role="alert">
                    Ce nom de personnage existe déjà, veuillez en saisir un autre
                    </div>';
        }
        
    }
   
    $Listing_personnage = $personnageManager->ReadAll();

}catch (PDOException $e) {
    // header('Location:404.php');
    // exit;
}



?><!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Fontfaces CSS-->
        <link href="./assets/css/font-face.css" rel="stylesheet" media="all">
        <link href="./assets/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
        <link href="./assets/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
        <link href="./assets/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

        <!-- Bootstrap CSS-->
        <link href="./assets/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

        <!-- Vendor CSS-->
        <link href="./assets/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
        <link href="./assets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
        <link href="./assets/vendor/wow/animate.css" rel="stylesheet" media="all">
        <link href="./assets/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
        <link href="./assets/vendor/slick/slick.css" rel="stylesheet" media="all">
        <link href="./assets/vendor/select2/select2.min.css" rel="stylesheet" media="all">
        <link href="./assets/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

        <!-- Main CSS-->
        <link href="./assets/css/theme.css" rel="stylesheet" media="all">



        <title>Street Fighter O3W</title>




    </head>

    <body>
        <header> 
        </header>

        <main>
        <h1 style="text-align:center;"> Jeu Street Fighter O3W </h1>
        <br>
        <div class="card-header">
            Formulaire de création de Combattants 
        </div>
        <div class="card-body card-block">
            <form action="" method="post" class="form-inline">
                <div class="form-group">
                    <label for="exampleInputName2" class="pr-1  form-control-label">Nom du Combattant : </label>
                    <input type="text" name="name" id="exampleInputName2" placeholder="Ryu, Ken ?? "  class="form-control">
                </div>
        </div>
        <div class="card-footer">
            <input type="submit" class="btn btn-primary btn-sm" value="Créer">
            </form>
        </div>
        <?php 
            if(isset($error)){
                echo $error;
            }
          if(isset($create_personnage)) {
                
              echo $create_personnage;
          }  
          
          if (count($Listing_personnage) >= 2) {
            ?>
            <h3> Sélectionnez votre combattant et partez en COMBAT ! </h3>
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>
                            <label class="au-radio">
                                <span class="au-checkmark"></span>
                            </label>
                        </th>
                        <th>Nom</th>
                        <th>Point de Vie </th>
                    </tr>
                </thead>
                <tbody>
                    <form action="combat.php">
                    <?php $personnageManager->ShowTr($Listing_personnage);  ?>
                </tbody>
            </table>
            <br> 
            <br>
            <input type="submit" class="btn btn-outline-danger btn-lg " value="Partir au Combat">
            </form> 
            

        <?php
          }
        ?>

        </main>


        <footer>
        </footer>
        


    </body>



     <!-- Jquery JS-->
     <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
        <script src="vendor/bootstrap-4.1/popper.min.js"></script>
        <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
        <script src="vendor/slick/slick.min.js">
        </script>
        <script src="vendor/wow/wow.min.js"></script>
        <script src="vendor/animsition/animsition.min.js"></script>
        <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
        </script>
        <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
        <script src="vendor/counter-up/jquery.counterup.min.js">
        </script>
        <script src="vendor/circle-progress/circle-progress.min.js"></script>
        <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="vendor/chartjs/Chart.bundle.min.js"></script>
        <script src="vendor/select2/select2.min.js">
        </script>

    <!-- Main JS-->
        <script src="js/main.js"></script>
</html>