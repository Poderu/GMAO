<!DOCTYPE>
<html>
    <body>
        <?php
        include("base.php");
        ?>
        <br>
                
                <?php
                
                $id = $_GET['id'];

            require 'admin/database.php';
            $db = Database::connect();
        
            $caracteristique = $db->query('SELECT idintervention, intervention_date, intervention_description, machine_designation, machine_code, utilisateur_nom, utilisateur_prenom FROM intervention

            LEFT JOIN machine ON intervention.idmachine = machine.idmachine
            LEFT JOIN utilisateur ON intervention.idutilisateur = utilisateur.idutilisateur

            WHERE idintervention ="'.$id.'"');
        
                
                
        
        
        while($inter = $caracteristique->fetch()) 
            {
            $date = new DateTime($inter['intervention_date']);
            $date = $date->format('d/M/Y');
            ?>        

            <div class="form-group">
                <label for="nom">Date :</label>
                <h4><?php echo $date;?></h4>
        </div>
        
        <br>
        
        <div class="form-group">
                <label for="marque">Machine ou pièce concernés :</label>
                <h4><?php if(!empty($inter['machine_designation']) && !empty($inter['machine_code'])){
            
            echo "-".$inter['machine_designation']."(".$inter['machine_code'].")";
            ?><br><br> <?php } ?>
                <?php 
            
            if(!empty($inter['piece_designation']) && !empty($inter['piece_code']))
            {
            
            echo "-".$inter['piece_designation']."(".$inter['piece_code'].")";
            }?></h4>
            </div>
        
        <br>
            
            <div class="form-group">
                <label for="ligne">Intervention réalisée par :</label>
                <h4><?php echo $inter['utilisateur_prenom']." ".$inter['utilisateur_nom'];?></h4>
            </div>
        
        <br>

            
            
            <div class="form-group">
                <label for="code">Description de l'intervention :</label><br>
        </div>
        <div class="texte">
                <h5><?php echo str_replace("\n","<br/>",$inter['intervention_description']);?></h5>
            </div>
        
        <br>
        <?php }?>
        
            
        
           <?php Database::disconnect();
        
        if($_SESSION['droituser'] == 2)
        {        
        echo '<a class="btn btn-default" href="modifierinter.php?id='.$id.'"><span class="glyphicon glyphicon-pencil"></span> Modifier les informations</a>';
        
        echo '<a class="btn btn-default" href="supprimerinter.php?id='.$id.'" onclick="Supp(this.href); return(false);"><span class="glyphicon glyphicon-trash"></span> Supprimer intervention</a>';
        
        }
        ?>
        <br><br>
            <div class="form-actions"> 
                
            </div>


        <br>
        <?php
        include("footer.html");
        ?>


    </body>
</html>
