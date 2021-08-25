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
        
            $caracteristique = $db->query('SELECT piece_designation, piece_code, piece_famille, piece_modele, piece_marque, piece_stock, emplacement_designation, emplacement_salle, piece_prix, piece_image, piece_alerte FROM piece 
            
            LEFT JOIN emplacement ON piece.idemplacement = emplacement.idemplacement

            
            WHERE idpiece ="'.$id.'"');
        
            $fourni = $db->query('SELECT fournisseur_designation FROM fournisseur, lien WHERE fournisseur.idfournisseur = lien.idfournisseur AND idpiece = "'.$id.'"');
                
        
        
        while($machine = $caracteristique->fetch()) 
            {
            ?>        

        <div class="photomachine">
            <?php 
             echo "<img src='".$machine['piece_image']."' height='352' width='470'/>"; ?>
        </div>
            <div class="form-groupe">
                <label for="nom">Nom :</label>
                <h4><?php echo $machine['piece_designation'];?></h4>
        </div>
        
        <br>        
            
            <div class="form-groupe">
                <label for="code">Code :</label>
                <h4><?php echo $machine['piece_code'];?></h4>
            </div>
        <br>
        
            <div class="form-groupe">
                <label for="marque">Emplacement :</label>
                <h4><?php echo $machine['emplacement_designation'].", ".$machine['emplacement_salle'];?></h4>
            </div>
        <br>
            
            <div class="form-groupe">
                <label for="ligne">Famille :</label>
                <h4><?php echo $machine['piece_famille'];?></h4>
            </div>
        
        <br>
        <?php echo '<form method="post" action="scriptModifStock.php?id=' .$id.'">'?>
            <div class="form-groupe">
            <label for="stock">Stock :</label>
        <div class="center">
            

    <p>
      </p><div class="input-group">
          <span class="input-group-btn">
              <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                <span class="glyphicon glyphicon-minus"></span>
              </button>
          </span>
          <input type="text" id="quant[2]" name="quant[2]" class="form-control input-number" value="<?php if(isset($count)){echo $count;}
                 echo $machine['piece_stock'];?>" min="0" max="100" width="150px">
          <span class="input-group-btn">
              <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                  <span class="glyphicon glyphicon-plus"></span>
              </button>
          </span>
      </div>
            <br>
           <button type="submit" class="btn btn-default" name="changerStock"><span class="glyphicon glyphicon-pencil"></span> Appliquer</button>
	<p></p>
</div>
        </div>
        
        <?php echo '</form>'; ?>
        
        
        <br><br>
        
        
        <div class="form-groupe">
                <label for="alerte">Palier alerte stock :</label>
                <h4><?php echo $machine['piece_alerte']?></h4>
            </div>
        <br>
        
         <div class="form-groupe">
                <label for="nom">Prix :</label>
                <h4><?php echo $machine['piece_prix']." €";?></h4>
        </div>
        
        <br>
            <div class="form-groupe">
                <label for="modele">Modele :</label>
                <h4><?php echo $machine['piece_modele'];?></h4>
            </div>
        <br>
            
            <div class="form-groupe">
                <label for="marque">Marque :</label>
                <h4><?php echo $machine['piece_marque'];?></h4>
            </div>
        <br>
        
        <div class="form-groupe">
                <label for="marque">Fournisseur :</label>
                
        <?php while($four = $fourni->fetch())
                 { ?>        
            <h4><?php echo '- '.$four['fournisseur_designation'];?></h4>
            <?php } ?>
            </div>
        
        
        <br>
        
        
        <?php
            echo '<a href="documentationpiece.php?id='.$id.'">Documentation pièce</a>';?>
        
            <?php }?>
        
         <?php
            $caracteristique = $db->query('SELECT machine.idmachine, machine_designation, machine_code, machine_image FROM machine 

            LEFT JOIN correspond ON machine.idmachine = correspond.idmachine

            
            WHERE idpiece = "'.$id.'"');
            

            ?>
        
        <h1><strong>Liste des équipements</strong></h1>
        <br>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Code</th>
                    <th>Détails</th>
                    
                    <?php if($_SESSION['droituser'] == 2)
            { ?>
                    
                    <th>Supprimer</th>
                    <?php } 
        
                    while($machine = $caracteristique->fetch()) 
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
                
                
                if($_SESSION['droituser'] == 2)
                {
                echo '<td><a class="btn btn-default" href="supprimerequipement.php?id='.$machine['idmachine'].'&amp;repeter =" onclick="Supp(this.href); return(false);"><span class="glyphicon glyphicon-trash"></span> Supprimer</a>';
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
        
            echo '<br><br><br><a class="btn btn-default" href="changementphotopiece.php?id='.$id.'"><span class="glyphicon glyphicon-pencil"></span> Changer la photo</a><br><br>'; 
        
            echo '<a class="btn btn-default" href="modifierpiece.php?id='.$id.'"><span class="glyphicon glyphicon-pencil"></span> Modifier les informations</a>';
        
            echo '<a class="btn btn-default" href="supprimerpiece.php?id='.$id.'&amp;repeter =" onclick="Supp(this.href); return(false);"><span class="glyphicon glyphicon-trash"></span> Supprimer la pièce</a><br><br>';
            }
        
        
        Database::disconnect();?>
        
            <div class="form-actions"> 
                
                <a class="btn btn-primary" href="listepiece.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
            </div>


        <br>
        <?php
        include("footer.html");
        ?>


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
