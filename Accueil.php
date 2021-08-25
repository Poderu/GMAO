<!DOCTYPE>
<html>
    <body>
        <?php
        include("base.php");
        
        require 'admin/database.php';
            $db = Database::connect();
        
        $equippanne = $db->query("SELECT idmachine, machine_designation, machine_code FROM machine WHERE machine_statut = 2");
        
        $piece = $db->query("SELECT idpiece, piece_designation, piece_code, piece_stock FROM piece WHERE piece_stock < piece_alerte");
        
        $revision = $db->query("SELECT idmachine, machine_designation, machine_code, machine_prochainControle FROM machine WHERE DATEDIFF(machine_prochainControle, DATE(NOW())) < 30 AND DATEDIFF(machine_prochainControle, DATE(NOW())) >=15");
        
        $proch = $db->query("SELECT idmachine, machine_designation, machine_code, machine_prochainControle FROM machine WHERE DATEDIFF(machine_prochainControle, DATE(NOW())) <15");
        

        ?>
        

                <div class="form_groupe">

                    <div class="col-md-6">
                            
                        <br><h3> Alertes équipement en panne</h3><br>
                        
                        <?php while($alertepanne = $equippanne->fetch())
                        {?>
                            <div class="alert alert-danger" role="alert">
                                <h5>La machine <?php echo $alertepanne['machine_designation']."(".$alertepanne['machine_code'].")";?> est en panne</h5>
                        </div>
                        <?php } ?>
                        
                        <br><h3>Alertes stocks</h3><br>
                        
                        <?php while($alertstock = $piece->fetch())
                        { ?>
                        <div class="alert alert-danger" role="alert">
                                <h5>La piece <?php echo $alertstock['piece_designation']."(".$alertstock['piece_code'].")";?> est en petite quantité (<?php echo $alertstock['piece_stock'] ?> pieces restantes)</h5>
                        </div>
    
                        <?php } ?>
                        
                        
                        <br><h3>Alertes contrôles</h3><br>
                        
                        <?php while($controle = $revision->fetch())
                        { 
                        
                        $date = new DateTime($controle['machine_prochainControle']);
                        $date = $date->format('d/M/Y');
                        ?>
                        
                        <div class="alert alert-warning" role="alert">
                                <h5>La machine <?php echo $controle['machine_designation']."(".$controle['machine_code'].")";?> à besoin d'un controle pour le <?php echo $date?></h5>
                        </div>                       
                        
                        
    
                        <?php } ?>
                        
                        <?php while($proche = $proch->fetch())
                        {
                        
                        $date = new DateTime($proche['machine_prochainControle']);
                        $date = $date->format('d/M/Y');
                        ?>
                        
                        <div class="alert alert-danger" role="alert">
                                <h5>La machine <?php echo $proche['machine_designation']."(".$proche['machine_code'].")";?> à besoin d'un controle pour le <?php echo $date?></h5>
                        </div>                       
                        
                        
    
                        <?php } ?>
                        
                    </div>
                    </div>

        <br>



    </body>
</html>
