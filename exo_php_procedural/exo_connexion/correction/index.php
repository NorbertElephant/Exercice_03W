<?php
session_start();

if( isset( $_GET['_err'] ) ) {
    switch( $_GET['_err'] ) {
        case 'empty':
            echo "Veuillez saisir les champs !";
            break;
        case 'notfound':
            echo "Mauvais identifiant/mot de passe !";
            break;
        case 'logout':
            echo "Vous êtes bien déconnecté";
            break;
        case 'capability':
            echo "Vous devez être connecté pour accéder à cette zone";
            break;
    }
}

if( !isset( $_SESSION['admin']['user'] ) ) {
?>
<form action="admin.php" method="post">
    <input type="text" name="login" placeholder="Identifiant">
    <input type="password" name="pwd" placeholder="Mot de passe">
    <input type="submit" value="Se connecter">
</form>
<?php
} else {
    // echo "Vous êtes déjà connecté";
    // echo '<a href="admin.php">Administration</a>';
    header('Location:admin.php');
    exit;
}