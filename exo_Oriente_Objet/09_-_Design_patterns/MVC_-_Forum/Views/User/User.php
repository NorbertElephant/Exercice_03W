<?php
         if(isset($_SESSION[APP_TAG]['user'])){
            echo '  <div style=" float:right">  
                    <img src="assets/img/avatar.jpg" alt="">
                    <h3> Bonkour '.$user->get_prenom() .' ' .$user->get_nom().' </h3> 
                    <a href="?del" style=" float:right"> <button type="submit"> Déconnexion </button>  </a>
                    </div>';

        } else {
            echo '  <div style=" float:right"> 
                    <img src="assets/img/avatar.jpg" alt="">
                    <h3 style ="text-align:right"> se connecter </a></h3>';
            echo'   <form action="" method="post">';

            if(isset($login_empty)) {
                echo $login_empty;
            }
            echo'   <input type="text" name="login" placeholder="Veuillez saisir votre Tugudu" >
                    <button type="submit" style="display:block"> Se Connecter</button>
                    </form>';
            echo'   <h3 style ="text-align:right"><br> 
                    <p> Vous n\'avez pas de compte ? </p>
                    <a href="?c=user"> <button> créer un compte </button></a> 
                    </h3> </div>'; ; 
        }
?>