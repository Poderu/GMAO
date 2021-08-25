<?php
session_start();

include 'admin/database.php';
$db = Database::connect();

$id = $_GET['id'];


$requete = $db->query('DELETE FROM machine WHERE idmachine = '.$id.'');

$requete2 = $db->query('DELETE FROM lienmach WHERE idmachine = "'.$id.'"');

$requete3 = $db->query('DELETE FROM correspond WHERE idmachine = "'.$id.'"');

$db = Database::disconnect();

header('Location: listeequipement.php');

?>
