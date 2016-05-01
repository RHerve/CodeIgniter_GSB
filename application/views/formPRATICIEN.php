    <script>
    $(document).ready(function(){
        $("#listePraticien").change(function(){
        
            var praticien = (document.getElementById('listePraticien').value);
          	if(praticien != ""){
          		$("#select_praticien").remove();

	            $.ajax({
	                type:"POST",
	                url: "<?php echo site_url('controlleur_principal/praticien_data');?>",
	                data:{praticien: praticien},
	                success: function (dataCheck) {
	                    //alert(dataCheck);
	                    $('#affichage_praticien').html(dataCheck);
	                    //window.location.reload();},
	                }
	            });
	        }
        });
    });
    </script>

	<h1> Praticiens </h1>
    <div class="content-block">
	<select id="listePraticien" name="lstPrat" class="titre" >
		<option id="select_praticien" value="">Sélectionner praticien</option>
		<?php
       	foreach($result as $data) {
	        echo'<option  value='.$data->PRA_NUM.'>'.$data->PRA_NOM.'</option>';
	    }
	?>

	</select>

	<div id="affichage_praticien">
		
	</div>
	</div>
 