<!DOCTYPE html>



    <body>
        <?php include("base.php"); 
        require 'admin/database.php';
            $db = Database::connect();
        
        $emp = $db->query("SELECT * FROM emplacement ORDER BY idemplacement");
        ?>
        <form method="POST" action="scriptAjoutemplacement.php" enctype="multipart/form-data">

            <div class="form-group">
                <br>
                <label for="nom">Nom de l'emplacement :</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" value="<?php if(isset($nom)) { echo $nom;}?>">
            </div>
            
            <br><br>
            
            <div class="form-group">
                <br>
                <label for="nom">Salle :</label>
                <input type="text" class="form-control" id="salle" name="salle" placeholder="Salle" value="<?php if(isset($salle)) { echo $salle;}?>">
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-success" name="ajout"><span class="glyphicon glyphicon-pencil"></span> Ajouter</button> 
                
                <a class="btn btn-primary" href="listeemplacement.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
            </div>

        </form>


    </body>

</html>