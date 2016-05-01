    
    <script>
    $(document).ready(function(){
        $("#listeMedicament").change(function(){
            var medicament = $('#listeMedicament option:selected' ).val();
            if(medicament != ""){
          		$("#select_medicament").remove();

	            $.ajax({
	                type:"POST",
	                url: "<?php echo site_url('controlleur_principal/medicament_data');?>",
	                data:{medicaments: medicament},
	                success: function (dataCheck) {
	                    //alert(dataCheck);
	                    $('#affichage_medicaments').html(dataCheck);
	                    //window.location.reload();},
	                }
	            });
	        }
        });
    });
    </script>

    <h1> Pharmacopee </h1>
    <div class="content-block">
    <select id="listeMedicament">
    	<option id="select_medicament" value="">Sélectionner médicament</option>
    <?php
        foreach($result as $data) {
            echo'<option >'.$data->MED_DEPOTLEGAL.'</option>';
        }
    ?>

    </select>
    
    <div id="affichage_medicaments">
        
    </div>
    </div>
        