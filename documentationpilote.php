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
    </head>
    <body>
        <?php
        include("base.php");
        $id = $_GET['id'];
        ?>
        
        <h1><strong>Liste des documents</strong>
            
            <a class="btn btn-success btn-lg" href="ajoutdocumentpilote.php?id=<?php echo $id;?>"><span class="glyphicon glyphicon-plus"></span> Ajouter un document</a></h1>        
        
        <form action="resultatrecherchedoc.php?id=<?php echo $id; ?>" id="searchthis" method="POST">
            <input id="requete" name="requete"  type="text" placeholder="Mot clé"/>
              <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-eye-open"></span> Chercher</button>
            
        </form>    
        
        <table class="table table-striped table-bordered avectri">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Date d'ajout</th>
                    <th>Téléchargement</th>
                    <th>Lecture en ligne</th>
                    
                    <?php if($_SESSION['droituser'] == 2)
                { ?>
                    <th>Supprimer</th>
                    <?php } ?>
                </tr>
            </thead>

            <?php
            require 'admin/database.php';
            $db = Database::connect();
            $caracteristique = $db->query('SELECT iddocument, document_nom, document_document, document_date FROM document WHERE idpilote = "'.$id.'"');

            while($doc = $caracteristique->fetch()) 
            {

                echo '<tr>';

                if($_SESSION['droituser'] == 2)
            {

                echo '<td>'. $doc['document_nom'] . '<a class="btn btn-default" href="renomerdoc.php?id='.$doc['iddocument'].'"><span class="glyphicon glyphicon-pencil"></span></a></td>';
                
            }else{ echo '<td>'. $doc['document_nom'] .'</td>';}
                
                $date = new DateTime($doc['document_date']);
                $date = $date->format('d/M/Y');
                
                echo '<td>'. $date . '</td>';

                echo '<td><a href="'.$doc['document_document'].'"
                download="'.$doc['document_nom'].'"> Telecharger</a>';
                
                echo '<td><a class="btn btn-default" href="'.$doc['document_document'].'"><span class="glyphicon glyphicon-eye-open"></span> Lecture</a>';
                
                if($_SESSION['droituser'] == 2)
                {                 
                echo '<td><a class="btn btn-default" href="supprimerdocument.php?id='.$doc['iddocument'].'&amp;repeter =" onclick="Supp(this.href); return(false);"><span class="glyphicon glyphicon-trash"></span> Supprimer</a>';
                    
                }

                echo '</td>';
                echo '</tr>';
                echo '</td>';
                echo '</tr>';
                }

            Database::disconnect();
            ?>
            
            
            
            
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
        </table>
        
        <?php echo '<td><a class="btn btn-primary" href="boutonvoirpilote.php?id='.$id.'"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>';?>
        
        <?php
        include("footer.html");
        ?>
    </body>
    
    
    

</html>
