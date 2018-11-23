<?php 
session_start(); 

$_SESSION['login_password'] = $_SESSION['login_password']. $_POST['login']. " et " . $_POST['password']. ", ";



?> 

<head> 
    <title> Exercice Login </title> 
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />    
</head>

<body> 
    <form action="login.php" method="post"  >
        <?php 
            if($_POST['login'] == 'Dupont' && $_POST['password'] == 'alibaba' ){ // condition si log sont bon 
                echo '<h2> login correct ! </h2> <br> <input type="submit" name="deco" value="Déconnexion"/> ';
            } else {
                header("location:login.php?message=1"); // renvoie sur la page login avec incrémentation 
            }
        ?> 
    </form> 
</body>