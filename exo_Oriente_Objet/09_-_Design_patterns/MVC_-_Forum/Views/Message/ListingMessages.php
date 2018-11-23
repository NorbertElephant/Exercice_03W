
<?php include('Views/Header.php'); ?>
        <title>Listing des Message de la conversation</title>
    </head>
    <body>
        <h1> Listing des Message de la conversation : <?php echo $request->get('id'); ?> </h1> 

        <section>

        <?php
        
            if($request->get('id') !== NULL) {
                 echo '<a href="index.php"> Revenir en arrière </a>
                <h2> Voici les messages de la conversation : </h2>  ';
                if(isset($message_create)){
                    echo $message_create;
                }
                if (count($messages) > 0) {

                  
            ?> 
            <form action=""  method="POST">
                <span> Tier par : <span> 
                <select name="Tri" id="">
                    <option value="date">Date</option>
                    <option value="id">ID message</option>
                    <option value="nom">Auteur</option>
                </select>
                <button type="submit"> Valider </button>
                <br><br>
            </form>

            <?php 
               ShowPage( $request->get('page'), $affichage_page, $request->get('id'), $nbr_page)
            ?>
                <table>
                    <thead>
                    <tr >
                        <td> Date du message</td>
                        <td> Heure du message </td>
                        <td> Nom Prénom </td>
                        <td> Message </td>
                    </tr>
                    </thead>>
                    <tbody>
                    <?php 
                    // var_dump($conversations);
                    if(isset($messages)){
                        foreach ($messages as $value) {
                            echo '<tr>';
                            echo '<td>'.$value->get_date().'</td>';
                            echo '<td>'.$value->get_time().'</td>';
                            echo '<td>'.$value->get_nom().'</td>';
                            echo '<td>'.$value->get_contenu().'</td>';
                            echo '</tr>';
                        } 
                    }
                ?>
                    </tbody>
                </table>
                <?php
                } else {
                    echo 'Cette conversation est vide pour le moment';
                }


                echo '<div>
                     <h3> Ecricre un message </h3>';
                if(isset($user) & $user != false) {
                    echo '  <form action="?c=message&id='.$request->get('id').'&page='.$request->get('page').'" method="POST">
                                 <textarea style="width:100%" name="contenu" placeholder="Veuillez ecrire le message ici" >
                                 </textarea> <br><br>
                                <input  style="float:right" type="submit" value="Envoyez" > 
                            </form>';
                } else {
                     echo 'Il faut être connecter pour pouvoir écrire un message =) ';
                }
                echo '</div>';

            }


 include('Views/footer.php'); ?>
