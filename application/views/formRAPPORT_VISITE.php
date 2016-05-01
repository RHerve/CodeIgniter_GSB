<script language="javascript">
		function selectionne(pValeur, pSelection,  pObjet, x) {
			//active l'objet pObjet du formulaire si la valeur sélectionnée (pSelection) est égale à la valeur attendue (pValeur)
			if (pSelection==pValeur) 
				{
					document.getElementById(x).disabled = false;
				}
			else { 
				document.getElementById(x).disabled = true;}


		}
	</script>

	<script>
		$(function() {
			$( "#dateVisite" ).datepicker({
			  dateFormat: "dd/mm/yy",
			  firstDay: 1,
			  dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
			  monthNames: [ "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Jullet", "Août", "Septembre", "Octobre", "Novembre", "Décembre" ]
			});
			$( "#datepicker" ).datepicker({
			  dateFormat: "dd/mm/yy",
			  firstDay: 1,
			  dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
			  monthNames: [ "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Jullet", "Août", "Septembre", "Octobre", "Novembre", "Décembre" ]
			});
		});
	</script>
	 <script language="javascript">
        function ajoutLigne( pNumero){//ajoute une ligne de produits/qté à la div "lignes"     
			//masque le bouton en cours
			document.getElementById("but"+pNumero).setAttribute("hidden","true");	
			pNumero++;										//incrémente le numéro de ligne
            var laDiv=document.getElementById("lignes");	//récupère l'objet DOM qui contient les données
			var titre = document.createElement("label") ;	//crée un label
			laDiv.appendChild(titre) ;						//l'ajoute à la DIV
			titre.setAttribute("class","titre") ;			//définit les propriétés
			titre.innerHTML= "   Produit : ";
			var liste = document.createElement("select");	//ajoute une liste pour proposer les produits
			laDiv.appendChild(liste) ;
			liste.setAttribute("name","PRA_ECH"+pNumero) ;
			liste.setAttribute("class","zone");
			//remplit la liste avec les valeurs de la première liste construite en PHP à partir de la base
			liste.innerHTML=formRAPPORT_VISITE.elements["PRA_ECH1"].innerHTML;
			var qte = document.createElement("input");
			laDiv.appendChild(qte);
			qte.setAttribute("name","PRA_QTE"+pNumero);
			qte.setAttribute("size","2"); 
			qte.setAttribute("class","zone");
			qte.setAttribute("type","text");
			var bouton = document.createElement("input");
			laDiv.appendChild(bouton);
			//ajoute une gestion évenementielle en faisant évoluer le numéro de la ligne
			bouton.setAttribute("onClick","ajoutLigne("+ pNumero +");");
			bouton.setAttribute("type","button");
			bouton.setAttribute("value","+");
			bouton.setAttribute("class","zone");	
			bouton.setAttribute("id","but"+ pNumero);				
        }
    </script>

    <script>
		$(document).ready(function(){

	        $("#submitPraticien").click(function(){
	        
	            var praticien = (document.getElementById('listePraticien').value);
	         
	            $.ajax({
	                type:"POST",
	                url: "<?php echo site_url('controlleur_principal/praticien_data');?>",
	                data:{praticien: praticien},
	                success: function (dataCheck) {
	                    $('#dialog-message').html(dataCheck);
	                       $( "#dialog-message" ).dialog({
					      	modal: true,
					      	width: 500,
					  		buttons: {
					    		Ok: function() {
						      		$( this ).dialog( "close" );
						    	}
					  		}
						});
	                    //window.location.reload();},
	                }
	            });
	        });
	    });
	</script>
	

	<?php echo validation_errors(); ?>

   	
		<h1> <?php if(isset($labelModif)) echo $labelModif . " "; ?>Rapport de visite </h1>

		<div class="content-block">
		<?php echo form_open('controlleur_principal/nouveauRapport'); ?>
		<div>
			<label class="titre">DATE VISITE :</label>
			<input name="DATEVISITE" type="text" id="dateVisite" <?php if(isset($dateVisite2)) echo 'value='.$dateVisite2;?> required />
			<br>
		</div>
		<div>
			<label class="titre">PRATICIEN :</label>
			<select id="listePraticien" name="PRATICIEN" class="titre">
				<?php
				if(isset($praticien2)) echo'<option value='.$praticien2.'>'.$nomPraticien.'</option>';
			    foreach($praticien as $data) {
				    echo'<option value='.$data->PRA_NUM.'>'.$data->PRA_NOM.'</option>';
				}
			?>
			</select>
			<a id="submitPraticien" href="#">?</a>

		</div>
		<div>
			<label class="titre">COEFFICIENT :</label>
			<select id="listeCoeff" name="COEFF" class="zone"  >
			<?php
			if(isset($coeff)) echo'<option value='.$coeff.'>'.$coeff.'</option>';
			for ($i=0; $i<=10; $i++)
			{
				echo '<option value="'.$i.'">'.$i.'</option>';
			}
			?>
			</select>

		</div>
		<div>

			<label class="titre">REMPLACANT :</label>
			<select id="listeRemplacant" name="REMPLACANT" class="zone"  >
			<?php
			if(isset($remplacant)) echo'<option value='.$remplacant.'>'.$remplacant.'</option>';
			for ($i=0; $i<=10; $i++)
			{
				echo '<option value="'.$i.'">'.$i.'</option>';
			}
			?>
			</select>

		</div>
		<div>

			<label class="titre">DATE :</label>
			<!--<input type="text" size="19" name="RAP_DATE" class="zone" />-->
			<input name="DATE" type="text" id="datepicker" <?php if(isset($date2)) echo 'value='.$date2;?> required/>

		</div>
		<div>

			<label class="titre">MOTIF :</label>
			<select  name="MOTIF" class="zone" onClick="selectionne('AUT',this.value,'RAP_MOTIFAUTRE', 'motif');">
			
			<?php if(isset($motif)) echo'<option value='.$motif.'>'.$motif.'</option>'; ?>
				<option value="Périodicité">Périodicité</option>
				<option value="Actualisation">Actualisation</option>
				<option value="Relance">Relance</option>
				<option value="Sollicitation praticien">Sollicitation praticien</option>
				<option value="AUT">Autre</option>
			</select>
			<?php if(isset($numRapport)) echo'<input type="hidden" name="existe" class="zone" value = ' .$numRapport.'/>' ?>
			
			
			
			 <input type="text" id="motif" name="MOTIF" class="zone" disabled="disabled" /> <br>

		</div>
		<div>

			<label class="titre">BILAN :</label>
			<textarea rows="5" cols="50" name="BILAN" class="zone"><?php if(isset($bilan)) echo $bilan;?></textarea>
			<br>
			<!-- 
			<label class="titre" ><h3> Eléments présentés </h3></label>
			<label class="titre" >PRODUIT 1 : </label><select name="PROD1" class="zone"></select>
			<label class="titre" >PRODUIT 2 : </label><select name="PROD2" class="zone"></select>
			<label class="titre">DOCUMENTATION OFFERTE :</label><input name="RAP_DOC" type="checkbox" class="zone" checked="false" />
			<br>

			<label class="titre"><h3>Echanitllons</h3></label>
			<div class="titre" id="lignes">
				<label class="titre" >Produit : </label>
				<select name="PRA_ECH1" class="zone">
					<option>Produits</option>
				</select>
				<input type="text" name="PRA_QTE1" size="2" class="zone"/>
				<input type="button" id="but1" value="+" onclick="ajoutLigne(1);" class="zone" />	
			</div>	
-->
		</div>
		<div>

			<label class="titre">SAISIE DEFINITIVE :</label>
			<input name="DEFINITIF" type="checkbox" class="zone" value="1" />
			<label class="titre"></label>
		</div>
			<div class="zone">
				<input type="reset" value="Annuler"></input>
				<input type="submit"></input>
			</div>
		
		</form>
		
	</div>
		
		<?php echo validation_errors(); ?>

   <?php echo form_open('controlleur_principal/modifRapport'); ?>
		
			<h1>Modifier un rapport</h1>
	<div class="content-block">

	<select id="listeRapport" name="rapport" class="titre" >
		<?php
       	foreach($resultListeRapport as $data) {
	        echo'<option  value='.$data->numRapport.'>'.$data->PRA_NOM." ".$data->dateVisite.'</option>';
	    }
	?>

	</select>
	<input id="selection_rapport" type="submit" value="Modifier" />

	<div id="dialog-message" title="Praticien">
	</div>
 
 </div>