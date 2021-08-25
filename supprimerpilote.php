<?php
session_start();

include 'admin/database.php';
$db = Database::connect();

$id = $_GET['id'];


$requete = $db->query('DELETE FROM pilote WHERE idpilote = "'.$id.'"');

$requete3 = $db->query('DELETE FROM lienpilmach WHERE idconsommable = "'.$id.'"');

$requete4 = $db->query('DELETE FROM lienpilpiece WHERE idconsommable = "'.$id.'"');

$requete5 = $db->query('DELETE FROM lienpilconso WHERE idconsommable = "'.$id.'"');

$db = Database::disconnect();

 header('Location: listepilote.php');
?>
