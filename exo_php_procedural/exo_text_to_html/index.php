<?php 

if(file_exists('C:\_xampp\htdocs\www\exo_text_to_html\fichier.html')) {
    /// afficher le fichier HTML afin de le modifier ou de le supprimer 
    $tabRessource = [];
    $ressource = fopen('C:\_xampp\htdocs\www\exo_text_to_html\fichier.html','r+');
 
}else { // Créer le fichier.html 
    $ressource = fopen('C:\_xampp\htdocs\www\exo_text_to_html\fichier.html','r+');
?> 
    <form method="POST" action=".">
        <input name="Content" type="Textarea" />
        <select>
            <option name="" value="h1"> Titre 1 </option>
            <option name="" value="h2"> Titre 2 </option>
            <option name="" value="h3"> Titre 3 </option>
            <option name="" value="h4"> Titre 4 </option>
            <option name="" value="p"> Paragraphe </option>
            <option name="" value="b"> Texte Gras </option>
            <option name="" value="i"> Texte Italique </option>
            <option name="" value="u"> Texte Souligné </option>
            <option name="" value=""> Citation </option>
            <option name="" value=""> Date </option>
            <option name="" value=""> Heure </option>
            <option name="" value=""> Image </option>

<?php
}