<!DOCTYPE html>

    <body>
        <?php include("base.php"); 
        
        
        require 'admin/database.php';
            $db = Database::connect();
        $erreur = '';
        $equip = $db->query("SELECT idfournisseur, fournisseur_designation, fournisseur_code FROM fournisseur ORDER BY fournisseur_code");
        
        
        if(!empty($_POST['nom']) AND !empty($_POST['code']))
        {
            $nom = htmlspecialchars($_POST['nom']);
            $code = htmlspecialchars($_POST['code']);
            $client = htmlspecialchars($_POST['client']);
            $tel = htmlspecialchars($_POST['telephone']);
            $fax = htmlspecialchars($_POST['fax']);
            $mail = htmlspecialchars($_POST['mail']);
            $ville = htmlspecialchars($_POST['ville']);
            $lien = htmlspecialchars($_POST['lien']);
            
            
            $nomlength = strlen($nom);
            $codelength = strlen($code);
            
            if($nomlength <= 50)
            {
                if($codelength <= 50)
                {
                    $requete = 'INSERT INTO fournisseur (fournisseur_code, fournisseur_designation, fournisseur_codeclient, fournisseur_telephone, fournisseur_fax, fournisseur_mail, fournisseur_ville, fournisseur_lien)VALUES("'.$code.'", 
                    "'.$nom.'"';
                    
                    if(!empty($codeclient))
                    {
                        $requete .= ', "'.$client.'"';
                    }else
                    {
                        $requete .=', NULL';
                    }

                    if(!empty($tel))
                    {
                        $requete .= ', "'.$tel.'"';
                    }else
                    {
                        $requete .=', NULL';
                    }

                    if(!empty($fax))
                    {
                        $requete .= ', "'.$fax.'"';
                    }else
                    {
                        $requete .= ', NULL';
                    }

                    if(!empty($mail))
                    {
                        $requete .= ', "'.$mail.'"';
                    }else
                    {
                        $requete .= ', NULL';
                    }

                    if(!empty($ville))
                    {
                        $requete .= ', "'.$ville.'"';
                    }else
                    {
                        $requete .= ', NULL';
                    }
                    
                    if(!empty($lien))
                    {
                        $requete .= ', "'.$lien.'")';
                    }else{
                        $requete .= ', NULL)';
                    }
                    
                    $exe = $db->query($requete);
                    
                
                     
                    if(isset($_POST['noms']))
                    {
                        
                     for($count = 0; $count < count($_POST['noms']); $count++)
                    {
                        
                         $maxi = $db->query('SELECT MAX(idfournisseur) AS max_id FROM fournisseur');
                         $max = $maxi->fetch();
                        
                        $requete2 = 'INSERT INTO contact (contact_nom, contact_fonction, contact_numero, idfournisseur, contact_mail) VALUES (:noms, :fonctions, :numeros, :fournisseur, :mails)';
                         $etat = $db->prepare($requete2);
                         $etat->execute(array(
                             ':noms' =>$_POST['noms'][$count],
                             ':fonctions' =>$_POST['fonctions'][$count],
                             ':numeros' =>$_POST['numeros'][$count],
                             ':fournisseur' =>$max[0],
                             ':mails' =>$_POST['mails'][$count]
                             
                         ));
                         
                     }
                    }
                    
                    $erreur = "Votre équipement a bien été créé";
                    header('Location: listefournisseur.php');
                    
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
                <br> <prouge>* Champs obligatoire</prouge>
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
                <label for="client">Code client :</label>
                <input type="text" class="form-control" id="client" name="client" placeholder="Code client" value="<?php if(isset($client)) { echo $client;}?>">
            </div>
            
            <br><br>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
           
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
             
                 <div id="fields">
                
                  
                   <br />
                      <div class="form-groupe">
                          <label for="deroulequip">Contacts :</label>

                    <div class="table-repsonsive">
                     <span id="error"></span>
                     <div class="table-repsonsive">
                         <span id="error"></span>
                         <table class="table table-bordered" id="item_table">
                          <tr>
                           <th>Nom</th>
                           <th>Fonction</th>
                           <th>Numéro</th>
                           <th width=30%>Mail</th>
                           <th width=5%><button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button></th>
                          </tr>
                         </table>
                      </div>
                  </div>
                </div>
            </div>
            
            <br>
            <div class="form-group">
                <label for="telephone">Téléphone :</label>
                <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Telephone" value="<?php if(isset($tel)) { echo $tel;}?>">
            </div>
            
            <br><br>
            
            <div class="form-group">
                <label for="fax">Fax :</label>
                <input type="text" class="form-control" id="fax" name="fax" placeholder="Secteur" value="<?php if(isset($fax)) { echo $fax;}?>">
            </div>
            
            <br><br>
            
            <div class="form-group">
                <label for="modele">Mail :</label>
                <input type="text" class="form-control" id="mail" name="mail" placeholder="Mail" value="<?php if(isset($mail)) { echo $mail;}?>">
            </div>
            
            <br><br>
            
            <div class="form-group">
                <label for="ville">Ville :</label>
                <input type="text" class="form-control" id="ville" name="ville" placeholder="Ville" value="<?php if(isset($marque)) { echo $marque;}?>">
            </div>
            
            <br><br>
            
            <div class="form-group">
                <label for="marque">Lien :</label>
                <input type="text" class="form-control" id="lien" name="lien" placeholder="Lien" value="<?php if(isset($lien)) { echo $lien;}?>">
            </div>
            <br>
            <prouge><?php echo $erreur; ?></prouge>
            <br><br>
            <div class="form-actions">
                <button type="submit" class="btn btn-success" name="ajout"><span class="glyphicon glyphicon-pencil"></span> Ajouter</button> 
                
                <a class="btn btn-primary" href="listefournisseur.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
            </div>

        </form>


    </body>

</html>


<script>
$(document).ready(function(){
 
 $(document).on('click', '.add', function(){
  var html = '';
  html += '<tr>';
  html += '<td><input type="text" name="noms[]" class="form-control noms" /></td>';
  html += '<td><input type="text" name="fonctions[]" class="form-control fonctions" /></td>';
  html += '<td><input type="text" name="numeros[]" class="form-control numeros" /></td>';
    html += '<td><input type="text" name="mails[]" class="form-control mails" /></td>';
  html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
  $('#item_table').append(html);
 });
 
 $(document).on('click', '.remove', function(){
  $(this).closest('tr').remove();
 });
 
 $('#insert_form').on('submit', function(event){
  event.preventDefault();
  var error = '';
  $('.noms').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Enter Item Name at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });
  
  $('.fonctions').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Enter Item Quantity at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });
  
  $('.numeros').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Select Unit at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });
     $('.mails').each(function(){
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
