<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Bootstrap template</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php 
    require('tombola.php');
    // session_destroy();

    define('COUTGRILLE',2);
    define('GAIN1',100);
    define('GAIN2',50);
    define('GAIN3',20);
    $Monnaie= 500;

    if(!isset($_SESSION['Tombola']['Monnaie'])){
        $_SESSION['Tombola']['Monnaie'] = $Monnaie;
    }


    ?> 

    <h1> Mini jeu de Tombola </h1> 

    <?php
        if(!isset($_SESSION['Tombola']['NumDuClient'])  ) {

            if(!isset($_POST['NombresTickets'])){

                echo "Vous avez " . $_SESSION['Tombola']['Monnaie']. "€ dans votre porte-monnaie <br>" ;

            
                echo ' <form method="POST" > 
                    Combien de tickets vous voulez acheter  ?  
                        <input name="NombresTickets" type="Text" >
                        <button type="submit" class="btn btn-primary">Acheter</button>
                        <button name="over" type="submit" class="btn btn-primary">Partir</button>
                    </form> ';
            
                
            }

            if(isset($_POST['over'])) {
                echo 'Merci de votre Participation ';
                }
        }
            
            if(isset($_POST['NombresTickets']) && ctype_digit($_POST['NombresTickets'])) { 

                if($_POST['NombresTickets'] == '0'){
                    echo 'Nan mais BILLY si tu es ici et que tu n\'achètes pas de ticket , CASSE TOI !' ;
                    echo '<form method="POST" "> 
                    <input name="reset" type="submit" value="Retourner">
                    </form>';
                }

                if($_POST['NombresTickets'] <100 && $_POST['NombresTickets'] !== '0' ) {
                    // Fonction de la Tombola est la ! 
                    LotoComplet($_POST['NombresTickets'],$_SESSION['Tombola']['Monnaie']);

                    echo' 
                    <form method="POST" "> 
                         <button name="reset" type="submit" class="btn btn-primary">Rejouer</button>
                        <button name="over" type="submit" class="btn btn-primary">Partir</button>
                    </form> ';
                } elseif ($_POST['NombresTickets'] > 100) {
                    echo  '<br> Il n\'y a que 100 tickets de disponible. ';
                    echo '<form method="POST" "> 
                    <button name="reset" type="submit" class="btn btn-primary">Retourner</button>
                    </form>';
                }
            } elseif (isset($_POST['NombresTickets'])) {
                        echo 'Entrer un nombre entier ...on ne peut pas acheter des morceaux de ticket ou des lettres de tickets !';
                        echo '<form method="POST" "> 
                        <button name="reset" type="submit" class="btn btn-primary">Retourner</button>
                        </form>';
                    }
    ?> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>