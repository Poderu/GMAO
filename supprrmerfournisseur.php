<?php
session_start();

include 'admin/database.php';
$db = Database::connect();

$id = $_GET['id'];


$requete = $db->query('DELETE FROM fournisseur WHERE idfournisseur = "'.$id.'"');

$db = Database::disconnect();


?>

<script> javascript:history.go(-1)</script>
