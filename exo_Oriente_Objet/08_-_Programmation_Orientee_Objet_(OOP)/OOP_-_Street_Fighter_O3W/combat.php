<?php
require_once('./ini.php');
require_once('./lib/common.php');


try {
    $personnageManager = new PersonnageManager( SPDO::getInstance( DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO() );
    
    // var_dump( SRequest::getInstance());

    if(!empty(SRequest::getInstance()->get('combattant')) &&  SRequest::getInstance()->get('combattant') !== null ){
        $personnage = $personnageManager->SelectPersonnage(SRequest::getInstance()->get('combattant'));
        // var_dump($personnage);
    }

    if(!empty(SRequest::getInstance()->post('attaque')) &&  SRequest::getInstance()->post('attaque') !== null ){
      

        $defenseur = $personnageManager->SelectPersonnage(SRequest::getInstance()->post('attaque'));

        if($personnage->frapper($defenseur) === true) {

            $degats = $defenseur->degats();

            $defenseur->set_hp($defenseur->recevoir_degat($degats));
                if($defenseur->get_hp() > 0) {
                    $personnageManager->UpdateHp($defenseur);
                    $_SESSION['streetfighter']['histo'][] = '<p> Vous avez infligés '.$degats.'  points de dégats a '.$defenseur->get_name().' , il lui reste '. $defenseur->get_hp() .' point de vie  </p>';
                } else {
                    $personnageManager->Unset($defenseur);
                    $_SESSION['streetfighter']['histo'][] = '<p class="alert alert-danger" role="alert" > Vous avez tué '.$defenseur->get_name().' , en lui infligeant '. $degats.'</p>' ;
                }
        } else {
            echo '<div class="alert alert-danger" role="alert">
                    Vous ne pouvez pas vous frapper vous même !
                    </div>';
        }
    }

    $Listing_personnage = $personnageManager->ReadAll();

    if (count($Listing_personnage) < 2) {
        SRequest::getInstance()->unset('session','streetfighter');
        header('Location:index.php');
        exit;
    }

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
             <a href="index.php?del" class="btn btn-info">Changer de Personnage</a>
        </header>

        <main>
        <h1 style="text-align:center; padding-bottom:100px;"> Combat Street Fighter O3W </h1>
    
        <div class="row">
            <!-- Zone Votre Personnage -->
            <div class="col-md-4">
                <div class="card-header">
                    <strong>Votre</strong> personnage 
                </div>
                <div class="card-body card-block">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label class=" form-control-label">Nom : </label>
                            </div>
                            <div class="col-12 col-md-6">
                                <p class="form-control-static"><?php  echo $personnage->get_name(); ?></p>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label class=" form-control-label"> Point de Vie : </label>
                            </div>
                            <div class="col-12 col-md-6">
                                <p class="form-control-static"><?php  echo $personnage->get_hp(); ?></p>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label class=" form-control-label"> Qui attaquer : </label>
                            </div>
                            <div class="col col-md-6">
                                <select name="attaque" id="select" class="form-control">
                                      <?php 
                                      if(isset($defenseur)) {
                                        $personnageManager->ShowOpt($Listing_personnage,$personnage->get_id(),$defenseur->get_id());
                                      } else {
                                        $personnageManager->ShowOpt($Listing_personnage,$personnage->get_id());
                                      }
                                       ?>
                                </select>
                            </div>                      
                        </div>
                    
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> Frapper
                    </button>
                    </form>
                </div>
                </div>  
            </div>
             <!-- Zone historique  -->
            <div class="col-lg-4">
                    <h3> Historique de Combat </h3>
                    <?php if(isset( $_SESSION['streetfighter']['histo'])) { 
                        foreach ($_SESSION['streetfighter']['histo'] as  $value) {
                            echo $value;
                        }
                    } ?>
            </div>

            <!-- Zone Ennemie -->
            <div class="col-md-4">
            <div class="card-header">
                    Personnage <strong>Ennemie</strong>  
                </div>
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class=" form-control-label">Nom</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <p class="form-control-static"><?php if(isset($defenseur) ) echo $defenseur->get_name(); ?></p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class=" form-control-label"> Point de Vie</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <p class="form-control-static">
                                <?php 
                                if(isset($defenseur) ){
                                    if($defenseur->get_hp() > 0) {
                                        echo $defenseur->get_hp();
                                    } else { 
                                        echo 'MORT';
                                    }
                                }  
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
       
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