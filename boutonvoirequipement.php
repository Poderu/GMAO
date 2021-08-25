<!DOCTYPE>
<html>
    
    
    <head>
        
        <script type="text/javascript">
            function Supp(link){
                if(confirm('Confirmer la suppression ?')){
                    document.location.href = link;
                }
            }
        </script>
        <script type="text/javascript" src="js/infobulle.js"></script>
    </head>
    <body>
        <?php
        include("base.php");
        ?>
        <br>
                
                <?php
                
                $id = $_GET['id'];

            require 'admin/database.php';
            $db = Database::connect();
        
            $caracteristique = $db->query('SELECT idmachine, machine_designation, machine_code, machine_codefourn, machine_modele, emplacement_designation, emplacement_salle, machine_marque, machine_image, machine_arrive, machine_periode, machine_dernierControle, machine_prochainControle, machine_statut, machine_prix 
            
            FROM machine 
            
            LEFT JOIN emplacement ON machine.idemplacement = emplacement.idemplacement

            WHERE idmachine ="'.$id.'"');
        
            $carac = $db->query('SELECT fournisseur_designation FROM fournisseur, lienmach WHERE fournisseur.idfournisseur = lienmach.idfournisseur AND idmachine = "'.$id.'"');
        
        
        while($machine = $caracteristique->fetch()) 
            {                
            
            
             if($machine['machine_statut'] == 0)
                {
                    $etat = "Libre";
                }elseif($machine['machine_statut'] == 1)
                {
                    $etat = "occupé";
                }elseif($machine['machine_statut'] == 2)
                {
                    $etat = "En panne";
                }
            
            if($machine['machine_arrive'] != NULL){
                $date = new DateTime($machine['machine_arrive']);
                $date = $date->format('d/M/Y');
            }else{
                $date = "Pas de date renseignée";
            }
            
            if($machine['machine_dernierControle'] != NULL)
            {
                
                $dateder = new DateTime($machine['machine_dernierControle']);
                $dateder = $dateder->format('d/M/Y');
            }else{
                $dateder = "Pas de date renseignée";
            }
            
            if($machine['machine_prochainControle'] != NULL)
            {
                $dateprochain = new DateTime($machine['machine_prochainControle']);
                $dateprochain = $dateprochain->format('d/M/Y');
            }else{
                $dateprochain = "Pas de date renseignée";
            }
            
        ?>        

        <div class="photomachine">
            <?php 
             echo "<img src='".$machine['machine_image']."' alt='Pas de photo ' height='352' width='470'/>"; ?>
        </div>
        
        <?php if($_SESSION['droituser'] == 2)
            { ?>
        
        <?php echo '<form method="POST" action="scriptchangerstatut.php?id=' .$machine['idmachine'].'" enctype="multipart/form-data">'?>
            <div class="form-gauche">
                 <label for="secteur">Statut :</label>
                <h4><?php echo $etat ;?></h4>
                <br>
                
                
                <label for="deroulstatut">Changer le statut</label>
                <h4><select name="deroulstatut" ><option></option>
                    
                    
                    <option value = 0>Libre</option>
                    
                    <option value = 1>Occupé</option>
                    
                    <option value = 2>En Panne</option>
                    
                    </select></h4>
            
                <button type="submit" class="btn btn-default" name="changerStatut"><span class="glyphicon glyphicon-refresh"></span> changer staut</button> 
                
                <br><br>
            
            
        <?php '</form>'?>
                
                
                
                </div>
        
        <?php } ?>
        
            <div class="form-groupe">
                <label for="nom">Nom :</label>
                <h4><?php echo $machine['machine_designation'];?></h4>
        </div>
        
        <br>
            
            <div class="form-groupe">
                <label for="code">Code labo :</label>
                <h4><?php echo $machine['machine_code'];?></h4>
            </div>  
        
        <br>   
        
         <div class="form-groupe">
                <label for="code">Code fournisseur :</label>
                <h4><?php echo $machine['machine_codefourn'];?></h4>
            </div>  
        
        <br> 
                    
            <div class="form-groupe">
                <label for="modele">Modele :</label>
                <h4><?php echo $machine['machine_modele'];?></h4>
            </div>
        
        <br>
            
            <div class="form-groupe">
                <label for="marque">Marque :</label>
                <h4><?php echo $machine['machine_marque'];?></h4>
            </div>
        
        <br>
        <div class="form-groupe">
                <label for="marque">Emplacement :</label>
                <h4><?php echo $machine['emplacement_designation'].", ".$machine['emplacement_salle'];?></h4>
            </div>
        <br>
        
            <div class="form-groupe">
                <label for="marque">Fournisseur :</label>
                
                <?php while($cara = $carac->fetch())
             { ?>
                <h4><?php echo '- '.$cara['fournisseur_designation'];?></h4>
                <?php } ?>
            </div>
        
        <br>
        
        <div class="form-groupe">
                <label for="nom">Prix :</label>
                <h4><?php echo $machine['machine_prix']." €";?></h4>
        </div>
        
        <br>
        
            <div class="form-groupe">
                <label for="marque">Date d'arrivée :</label>
                
            <h4><?php echo $date;?></h4>
            </div>
        
        <br>
        
            <div class="form-groupe">
                <label for="marque">Dernier contrôle :</label>
                
            <h4><?php echo $dateder;?></h4>
            
                <h4><?php echo ""; ?></h4>
            </div>
        
        <br>
        
            <div class="form-groupe">
                <label for="marque">Prochain contrôle :</label>

            <h4><?php echo $dateprochain;?></h4>
            </div>
        
        <br>
        
            <div class="form-groupe">
                <label for="marque">Périodicité des contrôles :</label>
                <?php 
            if(!empty($machine['machine_periode']))
            { ?>
            <h4><?php echo $machine['machine_periode']." mois";?></h4>
            <?php }
            else
                { ?>
                <h4><?php echo ""; ?></h4>
               <?php } ?>
                
            </div>
        
        <br><br>
        
            <?php
            echo '<a href="documentationequipement.php?id='.$id.'">Documentation équipement</a><br><br>';
        
        
         echo '<a href="interequipement.php?id='.$id.'">Historique des interventions</a>';?>
            <?php }?>
        
         <?php
            $caracteristique = $db->query('SELECT piece.idpiece, piece_designation, piece_code, piece_stock, piece_image, emplacement_designation FROM piece

                LEFT JOIN emplacement ON piece.idemplacement = emplacement.idemplacement

                LEFT JOIN correspond ON piece.idpiece = correspond.idpiece

                WHERE correspond.idmachine = "'.$id.'"');
            

           ?> 
        
        <h1><strong>Liste des pièces</strong></h1>
        <br>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Code</th>
                    <th>Stock</th>
                    <th>Emplacement</th>
                    <th>Détails</th>
                    <?php if($_SESSION['droituser'] == 2)
            { ?>
                    <th>Supprimer</th>
                    <?php } ?>
                </tr>
            </thead>
            <?php while($piece = $caracteristique->fetch()) 
            {?>
                <style>
                #test:hover
                {
                    background-image: url("<?php echo $piece['piece_image']; ?>");
                }
                
            </style><?php

           
        
                echo '<tr>';

                echo '<td>'. $piece['piece_designation'] . '</td>';
                echo '<td>'. $piece['piece_code'] . '</td>';
                echo '<td>'. $piece['piece_stock'] . '</td>';
                echo '<td>'. $piece['emplacement_designation'] . '</td>';
                
                echo '<td>' ?> <a class="btn btn-default" id="test" href="boutonvoirpiece.php?id=<?php echo $piece['idpiece'];?>" onMouseOver="infobulle(this, '<center><img src=<?php echo $piece['piece_image']; ?> width=300 height=250/></center>');"><span class="glyphicon glyphicon-eye-open"></span> Voir</a> <?php
                
                if($_SESSION['droituser'] == 2)
                {
                echo '<td><a class="btn btn-default" href="supprimerpiece.php?id='.$piece['idpiece'].'&amp;repeter =" onclick="Supp(this.href); return(false);"><span class="glyphicon glyphicon-trash"></span> Supprimer</a>';
                }

                echo '</td>';
                echo '</tr>';
                echo '</td>';
                echo '</tr>';
                }
     ?>
        </table>
        
        
        <?php
        
        if($_SESSION['droituser'] == 2)
        {
        
        echo '<br><br><td><a class="btn btn-default" href="changementphoto.php?id='.$id.'"><span class="glyphicon glyphicon-pencil"></span> Changer la photo</a><br><br>'; 
        
        echo '<a class="btn btn-default" href="modifierequipement.php?id='.$id.'"><span class="glyphicon glyphicon-pencil"></span> Modifier les informations</a>';
        
        echo '<a class="btn btn-default" href="supprimerequipement.php?id='.$id.'" onclick="Supp(this.href); return(false);"><span class="glyphicon glyphicon-trash"></span> Supprimer équipement</a>';
        }
                
                ?>
        
        <?php Database::disconnect();?>
        
            <div class="form-actions"> 
                <br>
                <a class="btn btn-primary" href="listeequipement.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
            </div>


        <br>
        <?php
        include("footer.html");
        ?>


    </body>
</html>
