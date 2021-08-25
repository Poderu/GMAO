<!DOCTYPE>

<head>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    
</head>
<html>
    <body>
        <?php
        include("base.php");
        ?>
        <script src='//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>
  <script src="js/incrementing.js"></script>
  <script type="text/javascript" src="js/infobulle.js"></script>
        <br>
                
                <?php
                
                $id = $_GET['id'];

            require 'admin/database.php';
            $db = Database::connect();
        
            $caracteristique = $db->query('SELECT pilote_designation, pilote_fonction, pilote_prix, pilote_date, pilote_image FROM pilote 
            
            WHERE idpilote ="'.$id.'"');
            
        
            $equip = $db->query('SELECT machine.idmachine, machine_designation, machine_code, machine_image FROM machine, lienpilmach WHERE machine.idmachine = lienpilmach.idmachine AND idpilote = "'.$id.'"');
        
            $piec = $db->query('SELECT piece.idpiece, piece_designation, piece_code, piece_stock, piece_image FROM piece, lienpilpiece WHERE piece.idpiece = lienpilpiece.idpiece AND idpilote = "'.$id.'"');
        
            $cons = $db->query('SELECT consommable.idconsommable, consommable_designation, consommable_code, consommable_stock, consommable_image FROM consommable, lienpilconso WHERE consommable.idconsommable = lienpilconso.idconsommable AND idpilote = "'.$id.'"');
                
        
        
        while($pilote = $caracteristique->fetch()) 
            {
            
            $date = date_create($pilote['pilote_date']);
            $date = date_format($date, 'd/M/Y');
            ?>    
        
        <div class="photomachine">
            <?php 
             echo "<img src='".$pilote['pilote_image']."' alt='Pas de photo ' height='352' width='470'/>"; ?>
        </div>

            <div class="form-groupe">
                <label for="nom">Nom :</label>
                <h4><?php echo $pilote['pilote_designation'];?></h4>
        </div>
        
        <br>        
            
            <div class="form-groupe">
                <label for="code">Objectif :</label>
                <h4><?php echo str_replace("\n","<br/>",$pilote['pilote_fonction']);?></h4>
            </div>
        <br>
        
         <div class="form-groupe">
                <label for="nom">Prix :</label>
                <h4><?php echo $pilote['pilote_prix']." €";?></h4>
        </div>
        
        <br>
            
            <div class="form-groupe">
                <label for="marque">Mise en service :</label>
                <h4><?php echo $date;?></h4>
            </div>
        <br>
        
        <?php
            echo '<a href="documentationpilote.php?id='.$id.'">Documentation pilote</a>';?>
            <br>
        
        <h1><strong>Liste des équipements</strong></h1>
        <br>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Code</th>
                    <th>Détails</th>
                    
        <?php
                    while($machine = $equip->fetch()) 
            {?>
                
                 <style type="text/css">
            
                #test:hover
                {
                    background-image: url("<?php echo $machine['machine_image']; ?>");
                }
        </style>

                </tr>
            </thead>

           <?php 

                echo '<tr>';

                echo '<td>'. $machine['machine_designation'] . '</td>';
                echo '<td>'. $machine['machine_code'] . '</td>';
                
                echo '<td>' ?> <a class="btn btn-default" href="boutonvoirequipement.php?id=<?php echo $machine['idmachine'];?>" onMouseOver="infobulle(this, '<center><img src=<?php echo $machine['machine_image']; ?> width=300 height=250/></center>');"><span class="glyphicon glyphicon-eye-open"></span> Voir</a> <?php
                

                echo '</td>';
                echo '</tr>';
                echo '</td>';
                echo '</tr>';
                }
     ?>
        </table>  
        <br>
        
         <h1><strong>Liste des pièces</strong></h1>
        <br>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Code</th>
                    <th>Stock</th>
                    <th>Détails</th>
                </tr>
            </thead>
            <?php while($piece = $piec->fetch()) 
            {?>
                
                 <style type="text/css">
            
                #test:hover
                {
                    background-image: url("<?php echo $piece['piece_image']; ?>");
                }
        </style><?php

           
        
                echo '<tr>';

                echo '<td>'. $piece['piece_designation'] . '</td>';
                echo '<td>'. $piece['piece_code'] . '</td>';
                echo '<td>'. $piece['piece_stock'] . '</td>';
                
                echo '<td>' ?> <a class="btn btn-default" href="boutonvoirpiece.php?id=<?php echo $piece['idpiece'];?>" onMouseOver="infobulle(this, '<center><img src=<?php echo $piece['piece_image']; ?> width=300 height=250/></center>');"><span class="glyphicon glyphicon-eye-open"></span> Voir</a> <?php
                

                echo '</td>';
                echo '</tr>';
                echo '</td>';
                echo '</tr>';
                }
     ?>
        </table>
        
         <h1><strong>Liste des consommables</strong></h1>
        <br>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Code</th>
                    <th>Stock</th>
                    <th>Détails</th>
                </tr>
            </thead>
            <?php while($conso = $cons->fetch()) 
            {?>
                <style type="text/css">
            
                #test:hover
                {
                    background-image: url("<?php echo $conso['consommable_image']; ?>");
                }
        </style><?php

           
        
                echo '<tr>';

                echo '<td>'. $conso['consommable_designation'] . '</td>';
                echo '<td>'. $conso['consommable_code'] . '</td>';
                echo '<td>'. $conso['consommable_stock'] . '</td>';
                
                echo '<td>' ?> <a class="btn btn-default" href="boutonvoirconso.php?id=<?php echo $conso['idconsommable'];?>" onMouseOver="infobulle(this, '<center><img src=<?php echo $conso['consommable_image']; ?> width=300 height=250/></center>');"><span class="glyphicon glyphicon-eye-open"></span> Voir</a> <?php

                echo '</td>';
                echo '</tr>';
                echo '</td>';
                echo '</tr>';
                }
     ?>
        </table>
        
        
        
            <?php }?>
        
         <?php
            $caracteristique = $db->query('SELECT machine.idmachine, machine_designation, machine_code FROM machine 

            LEFT JOIN correspond ON machine.idmachine = correspond.idmachine

            
            WHERE idpiece = "'.$id.'"');
        
        
            if($_SESSION['droituser'] == 2)
            {
               
                 echo '<br><br><td><a class="btn btn-default" href="changementphotopilote.php?id='.$id.'"><span class="glyphicon glyphicon-pencil"></span> Changer la photo</a>';
        
            echo '<br><br><a class="btn btn-default" href="modifierpilote.php?id='.$id.'"><span class="glyphicon glyphicon-pencil"></span> Modifier les informations</a>';
        
            echo '<a class="btn btn-default" href="supprimerpilote.php?id='.$id.'" onclick="Supp(this.href); return(false);"><span class="glyphicon glyphicon-trash"></span> Supprimer le pilote</a><br><br>';
            }
        
        
        Database::disconnect();?>
        
            <div class="form-actions"> 
                
                <a class="btn btn-primary" href="listepilote.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
            </div>


    </body>
</html>



<script> $('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });</script>
