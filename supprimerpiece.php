<?php
session_start();

include 'admin/database.php';
$db = Database::connect();

$id = $_GET['id'];


$requete = $db->query('DELETE FROM piece WHERE idpiece = "'.$id.'"');

$requete2 = $db->query('DELETE FROM piece WHERE idpiece = "'.$id.'"');

$requete3 = $db->query('DELETE FROM correspond WHERE idpiece = "'.$id.'"');

$db = Database::disconnect();

 header('Location: listepiece.php');
?>
