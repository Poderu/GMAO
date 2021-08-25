<!DOCTYPE html>

<?php include("base.php"); 
        require 'admin/database.php';
            $db = Database::connect(); 
$id = $_GET['id'];




if(!empty($_FILES))
{
    $nom = htmlspecialchars($_POST['nom']);
    $date = date("Y-m-d");
    
    $file_nameex = $_FILES['doc']['name'];
    $file_extension = strrchr($file_nameex, ".");
    $file_tmp_name = $_FILES['doc']['tmp_name'];
    $file_dest = 'Doc/'.$file_nameex;
      
    if($_FILES['doc']['error'] == 0)
    {
    if(move_uploaded_file($file_tmp_name, $file_dest))
    {
        $req = $db->prepare('INSERT INTO document(document_nom, document_document, idpiece, idmachine, idpilote, idconsommable, document_date) VALUES(?,?, NULL, NULL, NULL, ?, ?)');
        $req->execute(array($file_nameex, $file_dest, $id, $date));
        
        header('Location: documentationconso.php?id='.$id.'');
        
    }else{echo "dommage";}
    }else{echo "faute de zero";}
}
?>
    <body>
        
        <form method="POST" action="" enctype="multipart/form-data">
            
              <div class="form-group">
            <label for="doc">Fichier :</label><br />
             <input type="file" name="doc" id="doc" /><br />
            </div>
            
            <br>
            

                
        
                
            
            <div class="form-actions">
                <button type="submit" class="btn btn-success" name="ajout"><span class="glyphicon glyphicon-pencil"></span> Ajouter</button> 
                
                <a class="btn btn-primary" href="documentationconso.php?id=<?php echo $id; ?>"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
            </div>

        </form>


    </body>

</html>
