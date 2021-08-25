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
        ?>
        

        <h1><strong>Liste des pièces et équipements</strong>
            
        <br>
        <table class="table table-striped table-bordered avectri">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Code</th>
                    <th>Détails</th>
                </tr>
            </thead>

            <?php


            $caracteristique = $db->query('SELECT piece.idpiece, piece_designation, piece_code FROM piece,lien WHERE piece.idpiece = lien.idpiece AND idfournisseur = "'.$id.'"');
            
            $carac2 = $db->query('SELECT machine.idmachine, machine_designation, machine_code FROM machine, lienmach WHERE machine.idmachine = lienmach.idmachine AND idfournisseur = "'.$id.'"');

            while($machine = $caracteristique->fetch()) 
            {

                echo '<tr>';

                echo '<td>'. $machine['piece_designation'] . '</td>';
                echo '<td>'. $machine['piece_code'] . '</td>';
                
                echo '<td><a class="btn btn-default" href="boutonvoirpiece.php?id='.$machine['idpiece'].'"><span class="glyphicon glyphicon-eye-open"></span> Voir</a>';

                echo '</td>';
                echo '</tr>';
                echo '</td>';
                echo '</tr>';
                }
            
            
            while($machine2 = $carac2->fetch()) 
            {

                echo '<tr>';

                echo '<td>'. $machine2['machine_designation'] . '</td>';
                echo '<td>'. $machine2['machine_code'] . '</td>';
                
                echo '<td><a class="btn btn-default" href="boutonvoirequipement.php?id='.$machine2['idmachine'].'"><span class="glyphicon glyphicon-eye-open"></span> Voir</a>';

                echo '</td>';
                echo '</tr>';
                echo '</td>';
                echo '</tr>';
                }
     ?>
        </table>
        
        <br><br>
            <div class="form-actions"> 
                
                <a class="btn btn-primary" href="listefournisseur.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
            </div>


        <br>
