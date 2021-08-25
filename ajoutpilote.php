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
        
        if(!empty($_POST['nom']))
        {
            $nom = htmlspecialchars($_POST['nom']);
            $but = htmlspecialchars($_POST['but']);
            $prix = htmlspecialchars($_POST['prix']);
            $date = $_POST['date'];
                  
            $nomlength = strlen($nom);
            $butlength = strlen($but);
            
            if($nomlength <= 50)
            {
                if($butlength <= 250)
                {
                    $requete = 'INSERT INTO pilote (pilote_designation, pilote_fonction, pilote_prix, pilote_date)VALUES("'.$nom.'"';
                    
                    
                     if(!empty($but))
                    {
                        $requete .= ', "'.$but.'"';
                    }else
                    {
                        $requete .= ', NULL';
                    }

                    if(!empty($prix))
                    {
                        $requete .= ', "'.$prix.'"';
                    }else
                    {
                        $requete .=', NULL';
                    }                             

                    if(!empty($date))
                    {
                        $requete .= ', "'.$date.'")';
                    }else
                    {
                        $requete .= ', NULL)';
                    }
                    
                    echo $requete;
                    
                    $exe = $db->query($requete);
                    
                    if(isset($_POST['item_unit']))
                    {
                        
                     for($count = 0; $count < count($_POST['item_unit']); $count++)
                    {
                         
                        $equipe = $_POST['item_unit'];
                         $maxi = $db->query('SELECT MAX(idpilote) AS max_id FROM pilote');
                         $max = $maxi->fetch();
                        
                        $requete2 = 'INSERT INTO lienpilmach (idmachine, idpilote) VALUES (:machine, :pilote)';
                         $etat = $db->prepare($requete2);
                         $etat->execute(array(
                             ':machine' =>$equipe[$count],
                             ':pilote' =>$max[0]));
                         
                     }
                    }
                    
                    if(isset($_POST['pieces']))
                    {
                        
                     for($count = 0; $count < count($_POST['pieces']); $count++)
                    {
                         
                        $equipe = $_POST['pieces'];
                         $maxi = $db->query('SELECT MAX(idpilote) AS max_id FROM pilote');
                         $max = $maxi->fetch();
                        
                        $requete2 = 'INSERT INTO lienpilpiece (idpilote, idpiece) VALUES (:pilote, :piece)';
                         $etat = $db->prepare($requete2);
                         $etat->execute(array(
                             ':pilote' =>$max[0],
                             ':piece' =>$equipe[$count]));
                         
                     }
                    }
                    
                        if(isset($_POST['consommables']))
                    {
                        
                     for($count = 0; $count < count($_POST['consommables']); $count++)
                    {
                         
                        $equipe = $_POST['consommables'];
                         $maxi = $db->query('SELECT MAX(idpilote) AS max_id FROM pilote');
                         $max = $maxi->fetch();
                        
                        $requete2 = 'INSERT INTO lienpilconso (idpilote, idconsommable) VALUES (:pilote, :conso)';
                         $etat = $db->prepare($requete2);
                         $etat->execute(array(
                             ':pilote' =>$max[0],
                             ':conso' =>$equipe[$count]));
                         
                     }
                    }
                        
                    $erreur = "Votre équipement a bien été créé";
                    header('Location: listepilote.php');
                    
                }else
                {
                    $erreur = "L'objectif ne doit pas dépasser 250 caractères";
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
                <br><br> <prouge>* Champs obligatoire</prouge>
                <br><br>
                <label for="nom">Nom <prouge>*</prouge> :</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" value="<?php if(isset($nom)) { echo $nom;}?>">
            </div>
            
            <br><br>
            
            <div class="form-group">
                <label for="but">Fonction :</label><br>
                <TEXTAREA name="but" rows=10 cols=40 placeholder="Entrer l'objectif du pilote"></TEXTAREA>                
            </div>
            
            <br><br>
            
             <div class="form-group">
                <label for="prix">Prix :</label>
                <input type="text" class="form-control" id="prix" name="prix" placeholder="Prix" value="<?php if(isset($prix)) { echo $prix;}?>">
        </div>
            
            <br><br>
            
            <div class="form-group">
                <label for="date">Date de mise en service :</label>
                <input type="date" class="form-control" id="date" name="date" value="<?php if(isset($modele)) { echo $modele;}?>">
            </div>
            
            <br><br>
            
            
         <?php   
            
            function fill_unit_select_box($db)
{ 
 $output = '';
 $query = "SELECT * FROM machine ORDER BY machine_code";
 $statement = $db->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["idmachine"].'">'.$row["machine_code"].' | '.$row["machine_designation"].'</option>';
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
                          <label for="deroulequip">Equipement associé :</label>

                    <div class="table-repsonsive">
                     <span id="error"></span>
                     <table class="table table-bordered" id="item_table" >
                      <tr>
                       <th><select name="item_unit[]" class="form-control item_unit"><option value="">Equipement</option><?php echo fill_unit_select_box($db); ?></select></th>
                       <th width = "50"><button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button></th>
                      </tr>
                        </table>
                      </div>
                  </div>
            </div>
            
            <br>
            
            <?php
            
            
            function fill_unit_select_boxe($db)
{ 
 $output = '';
 $query = "SELECT * FROM piece ORDER BY piece_code";
 $statement = $db->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
 $output .= '<option value="'.$row["idpiece"].'">'.$row["piece_code"].' | '.$row["piece_designation"].'</option>';
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
                          <label for="deroulequip">Pièce associée :</label>

                    <div class="table-repsonsive">
                     <span id="error"></span>
                     <table class="table table-bordered" id="fourni_table" >
                      <tr>
                       <th><select name="pieces[]" class="form-control item_unit"><option value="">Piece</option><?php echo fill_unit_select_boxe($db); ?></select></th>
                       <th><button type="button" name="adde" class="btn btn-success btn-sm adde"><span class="glyphicon glyphicon-plus"></span></button></th>
                      </tr>
                        </table>
                      </div>
                  </div>
            </div> 
            
            
            
            <?php
            
            
            function fill_unit_select_boxee($db)
{ 
 $output = '';
 $query = "SELECT * FROM consommable ORDER BY consommable_code";
 $statement = $db->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
 $output .= '<option value="'.$row["idconsommable"].'">'.$row["consommable_code"].' | '.$row["consommable_designation"].'</option>';
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
                          <label for="deroulequip">Consommable associé :</label>

                    <div class="table-repsonsive">
                     <span id="error"></span>
                     <table class="table table-bordered" id="conso_table" >
                      <tr>
                       <th><select name="consommables[]" class="form-control item_unit"><option value="">Consommable</option><?php echo fill_unit_select_boxee($db); ?></select></th>
                       <th width = "50"><button type="button" name="addee" class="btn btn-success btn-sm addee"><span class="glyphicon glyphicon-plus"></span></button></th>
                      </tr>
                        </table>
                      </div>
                  </div>
            </div> 

            
            
            <br><prouge> <?php echo $erreur; ?></prouge><br><br>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-success" name="ajout"><span class="glyphicon glyphicon-pencil"></span> Ajouter</button> 
                
                <a class="btn btn-primary" href="listepilote.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
            </div>            
            

        </form>


    </body>


</html>


<script>
$(document).ready(function(){
 
 $(document).on('click', '.add', function(){
  var html = '';
  html += '<tr>';
  html += '<td><select name="item_unit[]" class="form-control item_unit"><option value="">Equipement</option><?php echo fill_unit_select_box($db); ?></select></td>';
  html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
  $('#item_table').append(html);
 });
 
 $(document).on('click', '.remove', function(){
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
      $('#item_table').find("tr:gt(0)").remove();
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


<script>
$(document).ready(function(){
 
 $(document).on('click', '.adde', function(){
  var html = '';
  html += '<tr>';
  html += '<td><select name="pieces[]" class="form-control item_unit"><option value="">Piece</option><?php echo fill_unit_select_boxe($db); ?></select></td>';
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

<script>
$(document).ready(function(){
 
 $(document).on('click', '.addee', function(){
  var html = '';
  html += '<tr>';
  html += '<td><select name="consommables[]" class="form-control item_unit"><option value="">Consommable</option><?php echo fill_unit_select_boxee($db); ?></select></td>';
  html += '<td><button type="button" name="removeee" class="btn btn-danger btn-sm removee"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
  $('#conso_table').append(html);
 });
 
 $(document).on('click', '.removeee', function(){
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
      $('#conso_table').find("tr:gt(0)").remove();
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


