<?php

include 'admin/database.php';
$db = Database::connect();

$id = $_GET['id'];


$requete = $db->query('DELETE FROM utilisateur WHERE idutilisateur = "'.$id.'"');

$db = Database::disconnect();


?>

<script> javascript:history.go(-1)</script>
