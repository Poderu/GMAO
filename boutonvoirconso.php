<!DOCTYPE>

<head>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    
</head>
<html>
    <body>
        <?php
        include("base.php");
        ?>
        <script src='//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>
  <script src="js/incrementing.js"></script>
        <br>
                
                <?php
                
                $id = $_GET['id'];

            require 'admin/database.php';
            $db = Database::connect();
        
            $caracteristique = $db->query('SELECT consommable_designation, consommable_code, consommable_famille, consommable_modele, consommable_marque, consommable_stock, emplacement_designation, emplacement_salle, consommable_prix, consommable_image, consommable_alerte FROM consommable 
            
            LEFT JOIN emplacement ON consommable.idemplacement = emplacement.idemplacement

            
            WHERE idconsommable ="'.$id.'"');
        
            $fourni = $db->query('SELECT fournisseur_designation FROM fournisseur, lienconso WHERE fournisseur.idfournisseur = lienconso.idfournisseur AND idconsommable = "'.$id.'"');
                
        
        
        while($machine = $caracteristique->fetch()) 
            {
            ?>        

        <div class="photomachine">
            <?php 
             echo "<img src='".$machine['consommable_image']."' height='352' width='470'/>"; ?>
        </div>
            <div class="form-groupe">
                <label for="nom">Nom :</label>
                <h4><?php echo $machine['consommable_designation'];?></h4>
        </div>
        
        <br>        
            
            <div class="form-groupe">
                <label for="code">Code :</label>
                <h4><?php echo $machine['consommable_code'];?></h4>
            </div>
        <br>
        
            <div class="form-groupe">
                <label for="marque">Emplacement :</label>
                <h4><?php echo $machine['emplacement_designation'].", ".$machine['emplacement_salle'];?></h4>
            </div>
        <br>
            
            <div class="form-groupe">
                <label for="ligne">Famille :</label>
                <h4><?php echo $machine['consommable_famille'];?></h4>
            </div>
        
        <br>
        
        <br>
        
        
        <div class="form-groupe">
                <label for="alerte">Palier alerte stock :</label>
                <h4><?php echo $machine['consommable_alerte']?></h4>
            </div>
        <br>
        
         <div class="form-groupe">
                <label for="nom">Prix :</label>
                <h4><?php echo $machine['consommable_prix']." €";?></h4>
        </div>
        
        <br>
        
         <div class="form-groupe">
                <label for="marque">Fournisseur :</label>
                
        <?php while($four = $fourni->fetch())
                 { ?>        
            <h4><?php echo '- '.$four['fournisseur_designation'];?></h4>
            <?php } ?>
            </div>
        
        
        <br>
        
        <?php echo '<form method="post" action="scriptModifStock.php?id=' .$id.'">'?>
            <div class="form-group">
            <label for="stock">Stock :</label>
        <div class="center">
            

    <p>
      </p><div class="input-group">
          <span class="input-group-btn">
              <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                <span class="glyphicon glyphicon-minus"></span>
              </button>
          </span>
          <input type="text" id="quant[2]" name="quant[2]" class="form-control input-number" value="<?php if(isset($count)){echo $count;}
                 echo $machine['consommable_stock'];?>" min="0" max="100" width="150px">
          <span class="input-group-btn">
              <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                  <span class="glyphicon glyphicon-plus"></span>
              </button>
          </span>
      </div>
            <br>
           <button type="submit" class="btn btn-default" name="changerStock"><span class="glyphicon glyphicon-pencil"></span> Appliquer</button>
	<p></p>
</div>
        </div>
        
        <?php echo '</form>'; ?>
        
        
        
        
        <br><br>
            <div class="form-groupe">
                <label for="modele">Modele :</label>
                <h4><?php echo $machine['consommable_modele'];?></h4>
            </div>
        <br>
            
            <div class="form-groupe">
                <label for="marque">Marque :</label>
                <h4><?php echo $machine['consommable_marque'];?></h4>
            </div>
        <br>
        
       
        
        
        <?php
            echo '<a href="documentationconso.php?id='.$id.'">Documentation consommable</a>';?>
        
            <?php }
        
            if($_SESSION['droituser'] == 2)
            {
        
            echo '<br><br><br><a class="btn btn-default" href="changementphotoconso.php?id='.$id.'"><span class="glyphicon glyphicon-pencil"></span> Changer la photo</a><br><br>'; 
        
            echo '<a class="btn btn-default" href="modifierconso.php?id='.$id.'"><span class="glyphicon glyphicon-pencil"></span> Modifier les informations</a>';
        
            echo '<a class="btn btn-default" href="supprimerconso.php?id='.$id.'" onclick="Supp(this.href); return(false);"><span class="glyphicon glyphicon-trash"></span> Supprimer le consommable</a><br><br>';
            }
        
        
        Database::disconnect();?>
        
            <div class="form-actions"> 
                
                <a class="btn btn-primary" href="listeconso.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
            </div>


        <br>
        <?php
        include("footer.html");
        ?>


    </body>
</html>
