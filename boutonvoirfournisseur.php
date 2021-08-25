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
        
            $caracteristique = $db->query('SELECT idfournisseur, fournisseur_designation, fournisseur_code, fournisseur_codeclient, fournisseur_telephone, fournisseur_mail, fournisseur_ville, fournisseur_lien FROM fournisseur WHERE idfournisseur ="'.$id.'"');
        
        $infoscontact = $db->query('SELECT * FROM contact WHERE idfournisseur = "'.$id.'"');
                
        
        
        while($fournisseur = $caracteristique->fetch()) 
            {
            ?>        

            <div class="form-group">
                <label for="nom">Nom :</label>
                <h4><?php echo $fournisseur['fournisseur_designation'];?></h4>
        </div>
        
        <br>
            
            <div class="form-group">
                <label for="code">Code :</label>
                <h4><?php echo $fournisseur['fournisseur_code'];?></h4>
            </div>
        
        <br>
        
        <div class="form-group">
                <label for="code">Code client :</label>
                <h4><?php echo $fournisseur['fournisseur_codeclient'];?></h4>
            </div>
        
        <br>
        
            <div class="form-group">
                <label for="marque">Téléphone :</label>
                <h4><?php echo $fournisseur['fournisseur_telephone'];?></h4>
            </div>
        
        <br>
            
            
            <div class="form-group">
                <label for="secteur">Mail :</label>
                <h4><?php echo $fournisseur['fournisseur_mail'];?></h4>
            </div>
        
        <br>
            
            <div class="form-group">
                <label for="modele">Ville :</label>
                <h4><?php echo $fournisseur['fournisseur_ville'];?></h4>
            </div>
        
        <br>
            
            <div class="form-group">
                <label for="marque">Lien vers le fournisseur :</label>
                <h4><?php echo '<td><a href="'.$fournisseur['fournisseur_lien'].'" target="_blank"> '.$fournisseur['fournisseur_lien'].'</a>'; ?></h4><br>
            </div>

            <?php }?>
        
        
        <h1><strong>Liste des contacts</strong></h1>
        <br>
        <table class="table table-striped table-bordered avectri">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Fonction</th>
                    <th>Téléphone</th>
                    <th>Mail</th>
                    <?php if($_SESSION['droituser'] == 2)
                {?>
                    <th>Supprimer</th>
                    <?php } ?>
                </tr>
            </thead>

            <?php

            while($contact = $infoscontact->fetch()) 
            {

                echo '<tr>';

                echo '<td>'. $contact['contact_nom'] . '</td>';
                echo '<td>'. $contact['contact_fonction'] . '</td>';
                
                echo '<td>'. $contact['contact_numero'] . '</td>';
                
                echo '<td>'. $contact['contact_mail'] . '</td>';
                
                if($_SESSION['droituser'] == 2)
                {
                
                echo '<td><a class="btn btn-default" href="supprimercontact.php?id='.$contact['idcontact'].'" onclick="Supp(this.href); return(false);"><span class="glyphicon glyphicon-trash"></span> Supprimer</a>';
                
                }

                echo '</td>';
                echo '</tr>';
                echo '</td>';
                echo '</tr>';
                }
            
            ?>
        </table>
        
        
        
        <script>
                // Tri dynamique de tableau HTML
                function twInitTableau() {
                // Initialise chaque tableau de classe « avectri »
                [].forEach.call( document.getElementsByClassName("avectri"), function(oTableau) {
                var oEntete = oTableau.getElementsByTagName("tr")[0];
                var nI = 1;
  	             // Ajoute à chaque entête (th) la capture du clic
  	             // Un picto flèche, et deux variable data-*
  	             // - Le sens du tri (0 ou 1)
  	             // - Le numéro de la colonne
                [].forEach.call( oEntete.querySelectorAll("th"), function(oTh) {
                oTh.addEventListener("click", twTriTableau, false);
                oTh.setAttribute("data-pos", nI);
                if(oTh.getAttribute("data-tri")=="1") {
                    oTh.innerHTML += "<span class=\"flecheDesc\"></span>";
                } else {
                    oTh.setAttribute("data-tri", "0");
                    oTh.innerHTML += "<span class=\"flecheAsc\"></span>";
                }
                // Tri par défaut
                if (oTh.className=="selection") {
                    oTh.click();
                }
                nI++;
                });
                });
                }
  
                function twInit() {
                        twInitTableau();
                }
                function twPret(maFonction) {
                    if (document.readyState != "loading"){
                        maFonction();
                    } else {
                        document.addEventListener("DOMContentLoaded", maFonction);
                    }
                }
                twPret(twInit);

                function twTriTableau() {
                // Ajuste le tri
                var nBoolDir = this.getAttribute("data-tri");
                this.setAttribute("data-tri", (nBoolDir=="0") ? "1" : "0");
                // Supprime la classe « selection » de chaque colonne.
                [].forEach.call( this.parentNode.querySelectorAll("th"), function(oTh) {oTh.classList.remove("selection");});
                // Ajoute la classe « selection » à la colonne cliquée.
                this.className = "selection";
                // Ajuste la flèche
                this.querySelector("span").className = (nBoolDir=="0") ? "flecheAsc" : "flecheDesc";

                // Construit la matrice
                // Récupère le tableau (tbody)
                var oTbody = this.parentNode.parentNode.parentNode.getElementsByTagName("tbody")[0]; 
                var oLigne = oTbody.rows;
                var nNbrLigne = oLigne.length;
                var aColonne = new Array(), i, j, oCel;
                for(i = 0; i < nNbrLigne; i++) {
                    oCel = oLigne[i].cells;
                    aColonne[i] = new Array();
                    for(j = 0; j < oCel.length; j++){
                    aColonne[i][j] = oCel[j].innerHTML;
                }
            }

            // Trier la matrice (array)
            // Récupère le numéro de la colonne
            var nIndex = this.getAttribute("data-pos");
            // Récupère le type de tri (numérique ou par défaut « local »)
            var sFonctionTri = (this.getAttribute("data-type")=="num") ? "compareNombres" : "compareLocale";
            // Tri
            aColonne.sort(eval(sFonctionTri));
            // Tri numérique
            function compareNombres(a, b) {return a[nIndex-1] - b[nIndex-1];}
            // Tri local (pour support utf-8)
            function compareLocale(a, b) {return a[nIndex-1].localeCompare(b[nIndex-1]);}
            // Renverse la matrice dans le cas d’un tri descendant
            if (nBoolDir==0) aColonne.reverse();
    
            // Construit les colonne du nouveau tableau
                for(i = 0; i < nNbrLigne; i++){
                    aColonne[i] = "<td>"+aColonne[i].join("</td><td>")+"</td>";
                }

                // assigne les lignes au tableau
                oTbody.innerHTML = "<tr>"+aColonne.join("</tr><tr>")+"</tr>";
            }
            </script>
        
           <?php Database::disconnect();
        
          if($_SESSION['droituser'] == 2)
            {
        
        echo '<a class="btn btn-default" href="modifierfournisseur.php?id='.$id.'"><span class="glyphicon glyphicon-pencil"></span> Modifier les informations</a>';
        
        echo '<a class="btn btn-default" href="supprimerfournisseur.php?id='.$id.'" onclick="Supp(this.href); return(false);"><span class="glyphicon glyphicon-trash"></span> Supprimer fournisseur</a>';
         }
        
        ?>
        <br><br>
            <div class="form-actions"> 
                
                <a class="btn btn-primary" href="listefournisseur.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
            </div>


        <br>
        <?php
        include("footer.html");
        ?>


    </body>
</html>
