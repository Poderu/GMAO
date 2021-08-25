<?php
session_start();
?>
<!DOCTYPE>
<html>
    <head>
        <title>GMAO LFCR-PT</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css\style.css">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript" src="js/app.js"></script>
    </head>
    <body>

        <div class="container">
            <div class="row" id="site">
                <div class="col-md-4">
                    <img id="LogoUPPA" src="Img/logo/logoUPPA.png">
                    
                    <?php if(!empty($_SESSION['iduser']))
                {?>
                <div class="social col-md-4">
                    <div class="right">
                    <h2><?php echo $_SESSION['nomuser']." ".$_SESSION['prenomuser'];?></h2>
                </div>
               
                    
                </div>
                </div>
                
                
                <div class="col-md-4">
                    <h1 class="text-logo">GMAO LFCR-PT </h1>
                </div>
            </div>
            <nav class="navbar navbar-inverse navbar-custom">
                <div class="container-fluid">
                    <ul class="nav navbar-nav">
                        <?php } ?>
                        <?php 


                        if(empty($_SESSION['iduser']))
                        {                        
                        header('Location: index.php');
    
                        }
                        else
                        {
                        ?>

                        <li><a href="Accueil.php">Accueil</a></li>
                        <li><a href="listepilote.php">Pilotes</a></li>
                        <li><a href="listeequipement.php">Equipements</a></li>
                        <li><a href="listepiece.php">Pieces</a></li>
                        <li><a href="listeconso.php">Consommables</a></li>
                                                
                        <li><a href="listefournisseur.php">Fournisseurs</a></li>
                        
                        <?php if($_SESSION['droituser'] == 2)
                        {?>
                        <li><a href="listeutilisateur.php">Utilisateurs</a></li>
                        <?php }?>
                        <li><a href="listeemplacement.php">Emplacements</a></li>

                        <li><a href="deconnexion.php"><span class="glyphicon glyphicon-log-out"></span> Deconnexion</a></li>
                            
                    </ul>

                        <?php }
                        ?>
                </div>
            </nav>