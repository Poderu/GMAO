
<?php
    ini_set('display_errors','off');
?>
<!DOCTYPE>
<html>
    
    
    <?php
    
        include("index.php");
    
        require 'admin/database.php';
            $db = Database::connect();
    
    if(isset($_POST['connexion']))
    {
        $idconnect = htmlspecialchars($_POST['idconnect']);
        $mdpconnect = sha1($_POST['mdpconnect']);
        if(!empty($idconnect) AND !empty($mdpconnect))
        {
            $requser = $db->prepare("SELECT * FROM utilisateur WHERE utilisateur_identifiant = ? AND utilisateur_mdp = ?");
            $requser->execute(array($idconnect, $mdpconnect));
            $userexist = $requser->rowCount();
            if($userexist == 1)
            {
                $userinfo = $requser->fetch();
                $_SESSION['iduser'] = $userinfo['idutilisateur'];
                $_SESSION['droituser'] = $userinfo['iddroit'];
                $_SESSION['nomuser'] = $userinfo['utilisateur_nom'];
                $_SESSION['prenomuser'] = $userinfo['utilisateur_prenom'];
                header("Location: Accueil.php");
                
            }
            else
            {
                $erreur = "Mauvais identifiant ou mot de passe";
            }
        }
        else
        {
            $erreur = "Tous les champs doivent être remplis";
        }
    }
    ?>
    
    <body>
        <div align="center">
            <h2>Connexion</h2>
            
            <form method="post" action="">

                <br><br>                
                <div class="form-group">
                <br>
                <label for="idconnect">Identifiant :</label>
                <input type="text" class="form-control" id="idconnect" name="idconnect" placeholder="Identifiant" value="<?php if(isset($id)) { echo $id;}?>">
            </div>
                
                <br><br>
                
                <div class="form-group">
                <br>
                <label for="mdpconnect">Mot de passe :</label>
                <input type="password" class="form-control" id="mdpconnect" name="mdpconnect" placeholder="Mot de passe" value="<?php if(isset($nom)) { echo $nom;}?>">
            </div>
                
                 <div class="form-actions">
                <button type="submit" class="btn btn-primary" name="connexion"><span class="glyphicon glyphicon-log-in"></span> Connexion</button> 
                
                <a class="btn btn-default" href="listeequipement.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
            </div>
                
            </form>
        <?php 
        if(isset($erreur))
        {
            echo '<font color="red">' .$erreur;
        } ?>
            
        </div>
        
    </body>
</html>