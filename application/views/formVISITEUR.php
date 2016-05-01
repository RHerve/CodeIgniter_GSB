    <script>
    $(document).ready(function(){
         $("#listeVisiteur").change(function(){
       		var visiteur = (document.getElementById('listeVisiteur').value);
            if(visiteur != ""){
          		$("#select_visiteur").remove();
	            $.ajax({
	                type:"POST",
	                url: "<?php echo site_url('controlleur_principal/visiteur_data');?>",
	                data:{visiteur: visiteur},
	                success: function (dataCheck) {
	                  
	                    $('#affichage_visiteur').html(dataCheck);
	                   
	                }
	            });
	        }
        });
    });
    </script>

	<h1> Visiteurs </h1>
	<div class="content-block">
	<select id="listeVisiteur" name="lstVisiteur" class="zone">
		<option id="select_visiteur" value="">Sélectionner visiteur</option>
		<?php
	     	foreach($result as $data) {
			    echo'<option value='.$data->VIS_MATRICULE.'>'.$data->VIS_NOM. " " .$data->Vis_PRENOM. '</option>';
			}
		?>
	</select>
	
	<div id="affichage_visiteur">
		
	</div>
	
</div>