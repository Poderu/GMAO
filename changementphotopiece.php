<!DOCTYPE html>

<html>
    <body>
        <?php 
        
        ini_set('display_errors','off');
        
        include("base.php"); 
        require 'admin/database.php';
            $db = Database::connect();
        
        $id=$_GET['id'];
        $dest = "Img/Profil/".$_FILES['photo']['name'];
        
        $photo = $db->query("SELECT idpiece, piece_image FROM piece WHERE idpiece ='".$id."'");
        
        $req = $db->prepare("UPDATE piece SET piece_image ='".$dest."' WHERE piece.idpiece = '".$id."'");
        
        
        while($profil = $photo->fetch())
        {
            
        ?>
        
        
        <br>
                <label for="nom">Photo actuelle :</label>
        
         <div class="photomodif">
            <?php 
             echo "<img src='".$profil['consommable_image']."'width = 300 heigth = 180/>"; ?>
        </div>

        <?php 
        }?>
        <br><br>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="photo">
            <input type="submit">
        </form>
    <?php
    if (isset($_FILES['photo']['tmp_name'])) {
        $retour = copy($_FILES['photo']['tmp_name'], $dest);
        if($retour) {
            echo '<p>La photo a bien été envoyée.</p>';
            echo '<img src="Img/Profil/' . $_FILES['photo']['name'] . '"width = 300 heigth = 180>';
            $req->execute();
            header('Location: boutonvoirpiece.php?id='.$id.'');
        }
    }
    ?>
        
        
        <br>
        <br>
        <?php echo '<td><a class="btn btn-primary" href="boutonvoirpiece.php?id='.$id.'"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>';?>
    </body>

</html>
