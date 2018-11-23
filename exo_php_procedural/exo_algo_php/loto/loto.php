<?php

require ('functions-simpleloto.php');

///////// Algo principal ///////////////////////////////////

$nombresDuClients =NuméroDuClient();

echo "Vos nombres sont ". implode(', ',$nombresDuClients ) ."\r\n" ;

$TabLoto = ResultatLoto();

echo "Les nombres du Tirage sont ". implode(', ',$TabLoto )."\r\n";

ComparaisonLoto($nombresDuClients,$TabLoto);


?> 