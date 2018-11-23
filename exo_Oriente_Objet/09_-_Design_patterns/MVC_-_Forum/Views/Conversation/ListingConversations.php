

<?php include('Views/Header.php'); ?>
<title>BDD Forum</title>
</head>
    <body>
        <h1> Exercice BDD sur un Forum </h1>
    <section>
        <table>
            <thead >
            <tr>
                <td>ID de la conversation </td>
                <td>Date de la conversation</td>
                <td>Heure de la conversation</td>
                <td>Nombres de messages</td>
                <td><?php ?></td>
            </tr>
            </thead>
            <tbody>
            <?php 
            // var_dump($conversations);
            if(isset($conversations)){
                foreach ($conversations as $key => $value) {                     
                    if($value->get_termine()==0){ 
                        echo'<tr class="opened">'; 
                    }else{ 
                        echo'<tr class="closed">';
                    }
                    echo '<td>'.$value->get_id().'</td>';
                    echo '<td>'.$value->get_date().'</td>';
                    echo '<td>'.$value->get_time().'</td>';
                    echo '<td>'.$value->get_numbers().'</td>';
                    echo '<td>
                    <a href=".?c=message&id='.$value->get_id().'&page=1"> Afficher les messages </a>
                        </td>';
                    echo '</tr>';
                } 
            }

        ?>
            </tbody>
        </table>

<?php include('Views/Footer.php'); ?>