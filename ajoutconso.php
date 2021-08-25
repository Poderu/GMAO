<!DOCTYPE html>

    <body>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
        <?php include("base.php"); 
        
        
        require 'admin/database.php';
            $db = Database::connect();
        
        
      
        $equip = $db->query("SELECT idfournisseur, fournisseur_designation, fournisseur_code FROM fournisseur ORDER BY fournisseur_code");
        
        $empla = $db->query("SELECT idemplacement, emplacement_designation, emplacement_salle FROM emplacement ORDER BY emplacement_designation");
        
        if(!empty($_POST['nom']) AND !empty($_POST['code']))
        {
            $nom = htmlspecialchars($_POST['nom']);
            $code = htmlspecialchars($_POST['code']);
            $famille = htmlspecialchars($_POST['famille']);
            $stock = $_POST['stock'];
            $emplacement = $_POST['deroulemplacement'];
            $prix = htmlspecialchars($_POST['prix']);
            $modele = htmlspecialchars($_POST['modele']);
            $marque = htmlspecialchars($_POST['marque']);
            $alerte = $_POST['alerte'];
                  
            $nomlength = strlen($nom);
            $codelength = strlen($code);
            
            if($nomlength <= 50)
            {
                if($codelength <= 50)
                {
                    $requete = 'INSERT INTO consommable (consommable_code, consommable_designation, consommable_famille, consommable_modele, consommable_marque, consommable_stock, idemplacement, consommable_alerte, consommable_prix)VALUES("'.$code.'", 
                    "'.$nom.'", "'.$famille.'", "'.$modele.'", "'.$marque.'"';
                    
                    
                     if(!empty($stock))
                    {
                        $requete .= ', "'.$stock.'"';
                    }else
                    {
                        $requete .= ', NULL';
                    }

                    if(!empty($emplacement))
                    {
                        $requete .= ', "'.$emplacement.'"';
                    }else
                    {
                        $requete .=', NULL';
                    }                             

                    if(!empty($alerte))
                    {
                        $requete .= ', "'.$alerte.'"';
                    }else
                    {
                        $requete .= ', NULL';
                    }
                    
                    if(!empty($prix)
                    {
                        $requete .= ', "'.$prix.'")';
                    }else{
                        $requete .= ', NULL)';
                    }
                    
                    $exe = $db->query($requete);
                    
                    if(isset($_POST['item_unit']))
                    {
                        
                     for($count = 0; $count < count($_POST['item_unit']); $count++)
                    {
                         
                        $equipe = $_POST['item_unit'];
                         $maxi = $db->query('SELECT MAX(idpiece) AS max_id FROM piece');
                         $max = $maxi->fetch();
                        
                        $requete2 = 'INSERT INTO correspond (idmachine, idpiece) VALUES (:machine, :piece)';
                         $etat = $db->prepare($requete2);
                         $etat->execute(array(
                             ':machine' =>$equipe[$count],
                             ':piece' =>$max[0]));
                         
                     }
                    }
                    
                    if(isset($_POST['fournisseurs']))
                    {
                        
                     for($count = 0; $count < count($_POST['fournisseurs']); $count++)
                    {
                         
                        $equipe = $_POST['fournisseurs'];
                         $maxi = $db->query('SELECT MAX(idconsommable) AS max_id FROM consommable');
                         $max = $maxi->fetch();
                        
                        $requete2 = 'INSERT INTO lienconso (idfournisseur, idconsommable) VALUES (:fournisseur, :consommable)';
                         $etat = $db->prepare($requete2);
                         $etat->execute(array(
                             ':fournisseur' =>$equipe[$count],
                             ':consommable' =>$max[0]));
                         
                     }
                    }
                    echo $requete;
                    
                    $erreur = "Votre équipement a bien été créé";
                    header('Location: listeconso.php');
                    
                }else
                {
                    $erreur = "Le code ne doit pas dépasser 50 caractères";
                }
            }else
            {
                $erreur = "Le nom ne doit pas dépasser 50 caractères";
            }
            
        }else
        {
            $erreur = "Tous les champs obligatoires doivent être remplis";
        }
        
        
        ?>

        <form method="POST" action="" enctype="multipart/form-data">
            
           

            <div class="form-group">
                <br><br> <prouge>* Champs obligatoires</prouge>
                <br><br>
                <label for="nom">Nom <prouge>*</prouge> :</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" value="<?php if(isset($nom)) { echo $nom;}?>">
            </div>
            
            <br><br>
            
            <div class="form-group">
                <label for="code">Code <prouge>*</prouge> :</label>
                <input type="text" class="form-control" id="code" name="code" placeholder="Code" value="<?php if(isset($code)) { echo $code;}?>">
            </div>
            
            <br><br>
            
            <div class="form-group">
                <label for="famille">Famille :</label>
                <input type="text" class="form-control" id="famille" name="famille" placeholder="Famille" value="<?php if(isset($famille)) { echo $famille;}?>">
            </div>
            
            <br><br>
            
            <div class="form-group">
                <label for="code">Stock :</label>
                <input type="text" class="form-control" id="stock" name="stock" placeholder="Stock" value="<?php if(isset($stock)) { echo $stock;}?>">
            </div>
            
            <br><br>
            
             <div class="form-group">
                <label for="nom">Prix :</label>
                <input type="text" class="form-control" id="prix" name="prix" placeholder="Prix" value="<?php if(isset($prix)) { echo $prix;}?>">
        </div>
            
            <br><br>
            
            <div class="form-group">
                <label for="modele">Modele :</label>
                <input type="text" class="form-control" id="modele" name="modele" placeholder="Modele" value="<?php if(isset($modele)) { echo $modele;}?>">
            </div>
            
            <br><br>
            
            <div class="form-group">
                <label for="marque">Marque :</label>
                <input type="text" class="form-control" id="marque" name="marque" placeholder="Marque" value="<?php if(isset($marque)) { echo $marque;}?>">
            </div>
            
            <br>
            
            <div class="form-group">
                <label for="deroulemplacement">Emplacement :</label>
                <select name="deroulemplacement"><option></option>
                
                <?php while($emp = $empla->fetch())
                        { ?>
    
                <option value="<?php echo $emp['idemplacement'];?>"><?php echo $emp['emplacement_designation']." | ".$emp['emplacement_salle'];?></option>
                
                <?php } ?>
                
                </select>
            </div>
            
            <br>
            <?php
            
            
            function fill_unit_select_boxe($db)
{ 
 $output = '';
 $query = "SELECT * FROM fournisseur ORDER BY fournisseur_designation";
 $statement = $db->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["idfournisseur"].'">'.$row["fournisseur_designation"].'</option>';
 }
 return $output;
}

?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
           
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            
            <div id="fields">
                
                   <br />
                      <div class="form-group">
                          <label for="deroulequip">Fournisseur :</label>

                    <div class="table-repsonsive">
                     <span id="error"></span>
                     <table width="250" class="table table-bordered" id="fourni_table" >
                      <tr>
                       <th width = "200"><select name="fournisseurs[]" class="form-control item_unit"><option value=""></option><?php echo fill_unit_select_boxe($db); ?></select></th>
                       <th width = "50"><button type="button" name="adde" class="btn btn-success btn-sm adde"><span class="glyphicon glyphicon-plus"></span></button></th>
                      </tr>
                        </table>
                      </div>
                  </div>
            </div> 
            
            
            <br>
            
            <div class="form-group">
                <label for="alerte">Palier alerte stock :</label>
                <input type="text" class="form-control" id="alerte" name="alerte" placeholder="Alerte" value="<?php if(isset($alerte)) { echo $alerte;}?>">
            </div>
            
            <br><prouge> <?php echo $erreur; ?></prouge><br><br>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-success" name="ajout"><span class="glyphicon glyphicon-pencil"></span> Ajouter</button> 
                
                <a class="btn btn-primary" href="listeconso.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
            </div>            
            

        </form>


    </body>


</html>

<script>
$(document).ready(function(){
 
 $(document).on('click', '.adde', function(){
  var html = '';
  html += '<tr>';
  html += '<td><select name="fournisseurs[]" class="form-control item_unit"><option value="">fournisseur</option><?php echo fill_unit_select_boxe($db); ?></select></td>';
  html += '<td><button type="button" name="removee" class="btn btn-danger btn-sm removee"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
  $('#fourni_table').append(html);
 });
 
 $(document).on('click', '.removee', function(){
  $(this).closest('tr').remove();
 });
 
 $('#insert_form').on('submit', function(event){
  event.preventDefault();
  var error = '';
  $('.item_name').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Enter Item Name at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });
  
  $('.item_quantity').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Enter Item Quantity at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });
  
  $('.item_unit').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Select Unit at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });
  var form_data = $(this).serialize();
  if(error == '')
  {
   $.ajax({
    url:"insert.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     if(data == 'ok')
     {
      $('#fourni_table').find("tr:gt(0)").remove();
      $('#error').html('<div class="alert alert-success">Item Details Saved</div>');
     }
    }
   });
  }
  else
  {
   $('#error').html('<div class="alert alert-danger">'+error+'</div>');
  }
 });
 
});
</script>

