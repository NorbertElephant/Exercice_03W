
<?php include('Views/Header.php'); ?>
        <title>Page de Creation de compte</title>
    </head>
    <body>
        <h1> Page d'inscription au Forum des Tugudu ! </h1>
        <section>
       <br> <br><a href="index.php"> Retourner à la page d'accueil </a>
        <?php 
            if($request->post('login') == NULL) {
            ?><div style="width: 50%; margin: auto;">
                <h2> Formulaire d'inscription : </h2>
                <form action="." method='POST'> 
                    <span>Login* : </span>
                    <input type="text" name="login" id="" placeholder='Veuillez saisir votre Login'>
                    <br>
                    <span>Prénom : </span>
                    <input type="text" name="prenom" id=""placeholder='Veuillez saisir votre prenom'>
                    <br>
                    <span>Nom : </span>
                    <input type="text" name="nom" id=""placeholder='Veuillez saisir votre Nom'>
                    <br>
                    <span>Votre Date de Naissance* : </span>
                    <input type="date" name="date" id="">
                    <br>
                    <input type="submit" value="Créer"> 
                    <span style="color:rgba(0,0,0,0.2"> * Sont des champs obligatoires <span>  
                </form>
            </div>
            <?php } else {
                if(isset($create_account)){
                    echo $create_account; 
                }
            } ?>

<?php include('Views/Footer.php'); ?>