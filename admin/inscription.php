<?php
require 'database.php';
$db = Database::connect();
if(isset($_POST['forminscription']))
{ 

    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1($_POST['mdp2']);

    if(!empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
    {


        $nomlength = strlen($nom);
        $prenomlength = strlen($prenom);
        if($nomlength <= 50)
        {
            if($prenomlength <=50)
            {
                if($mail == $mail2) 
                {
                    if(filter_var($mail, FILTER_VALIDATE_EMAIL)) 
                    {
                        $reqmail = $db->prepare("SELECT * FROM utilisateur WHERE mail = ?");
                        $reqmail->execute(array($mail));
                        $mailexist = $reqmail->rowCount();
                        if($mailexist == 0)
                        {


                            if ($mdp == $mdp2)
                            {
                                $insertmbr = $db->prepare("INSERT INTO utilisateur(nom, prenom, mail, hash) VALUES( ?, ?, ?, ?)");
                                $insertmbr->execute(array("$nom", "$prenom", "$mail", "$mdp"));
                                $GLOBALS['erreur'] = "Votre compte a été créer";  

                            }
                            else
                            {
                                $GLOBALS['erreur'] = "le mot de passe de confirmation ne correspond pas";
                            }
                        }  
                        else
                        {
                            $GLOBALS['erreur'] = "Ce mail existe déja";
                        }
                    }
                    else
                    {
                        $GLOBALS['erreur'] = "le mail de confirmation ne correspond pas";
                    }
                }
                else
                {
                    $GLOBALS['erreur'] = "Votre adresse mail n'est pas valide!";
                }
            }
            else
            {
                $GLOBALS['erreur'] = "Votre prenom ne doit pas dépasser 50 charactères";
            }
        }
        else
        {
            $GLOBALS['erreur'] = "Votre nom ne doit pas dépasser 50 charactères";
        }
    }
    else
    {
        $GLOBALS['erreur'] = "Tous les champs doivent être complétés";
    }

}     
if(isset($GLOBALS['erreur']))
{
    echo '<font color="red">'. $GLOBALS['erreur'] ."</font>";
    Database::disconnect();
}
?>