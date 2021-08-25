<?php session_start(); ?>
<?php
//session_start();
require 'database.php';
$db = Database::connect();
    if(isset($_POST['form']))
    
    {
    $mailconnect = htmlspecialchars($_POST['mail']);
    $mdpconnect = sha1($_POST['mdp']);
        
    if(!empty($mailconnect) AND !empty($mdpconnect))
    {
        $requser = $db->prepare("SELECT * FROM utilisateur WHERE mail = ? AND hash = ?");
        $requser->execute(array($mailconnect, $mdpconnect));
        $userexist = $requser->rowCount();
        if($userexist == 1)
        {
            $userinfo = $requser->fetch();
            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['nom'] = $userinfo['nom'];
            $_SESSION['prenom'] = $userinfo['prenom'];
            $_SESSION['mail'] = $userinfo['mail'];
            $_SESSION['role'] = $userinfo['role'];
            $GLOBALS['erreur'] = '<script> alert("vous êtes bien connecté")</script>';
            //header("Location: index.php?id=".$_SESSION['id']);
        }
        else
        {
            $GLOBALS['erreur'] = '<script> alert("mauvais mail ou mot de passe")</script>';
        }
    }
    else
    {
          $GLOBALS['erreur'] = '<script> alert("Il faut remplir tous les champs!")</script>';
    }
    }
Database::disconnect();
    
?>