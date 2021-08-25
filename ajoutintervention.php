<!DOCTYPE html>



    <body>
        <?php include("base.php"); 
        require 'admin/database.php';
            $db = Database::connect();
        $id = $_GET['id'];
        
        $equip = $db->query("SELECT idmachine, machine_designation, machine_code FROM machine ORDER BY machine_code");
        
        $piece = $db->query("SELECT idpiece, piece_designation, piece_code FROM piece ORDER BY piece_code");
        
        
         if(!empty($_POST['date']) AND !empty($_POST['description']))
            
         {
            $date = htmlspecialchars($_POST['date']);
            $description = htmlspecialchars($_POST['description']);
             
             
             $descriptionlength = strlen($description);
                 if($descriptionlength <= 600)
            
                 {
                    $requete = 'INSERT INTO intervention (intervention_date, idmachine, intervention_description, idutilisateur)VALUES("'.$date.'", "'.$id.'", "'.$description.'", "'.$_SESSION['iduser'].'")';
             
                    $exe = $db->query($requete);
                    
                    $erreur = "Votre équipement a bien été créé";
                    header('Location: interequipement.php?id='.$id.'');
                     
                 }else{
                     
                     $erreur = "La description ne doit pas faire plus de 600 caractéres ";
                 }
        }else
        {
            $erreur = "Tous les champs obligatoires doivent être remplis";
        }
        
        
        ?>

        <form method="POST" action="" enctype="multipart/form-data">

            <div class="form-group">
         <br><prouge>* Champs obligatoire</prouge><br>

        <form method="POST" action="" enctype="multipart/form-data">

            <div class="form-group">
                <br>
                <label for="date">Date de l'intervention <prouge>*</prouge> :</label>
                <input type="date" class="form-control" id="date" name="date" value="<?php if(isset($date)) { echo $date;}?>">
            </div>
            
            <br><br>
            
         
            
            <div class="form-group">
                <label for="description">Description de l'intervention :</label><br>
                <TEXTAREA name="description" rows=10 cols=40 placeholder="Entrer votre description"></TEXTAREA>                
            </div>
            
            <br><prouge><?php echo $erreur; ?></prouge><br><br>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-success" name="ajout"><span class="glyphicon glyphicon-pencil"></span> Ajouter</button> 
                
                <a class="btn btn-primary" href="interequipement.php?id=<?php echo $id; ?></a>"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
            </div>

        </form>


    </body>

</html>
