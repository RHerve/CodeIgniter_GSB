	<h1>Récapitulatif des visites</h1>
	<div class="content-block">
		<div id="affichage_visiteur">
			<table class="table-rapports">
				<thead>
					<tr>
						<th>Nom et Prénom du praticien</th>
						<th>Date visite</th>
						<th>Remplaçant</th>
						<th>Coefficient</th>
						<th>Date</th>
						<th>Bilan</th>
						<th>Motif</th>
					</tr>
				</thead>
				<tbody>	
						<?php foreach($result as $data) {
							echo '<tr>';
		     				   echo '<td>'.$data->PRA_NOM.' '.$data->PRA_PRENOM.'</td>';
		     				   echo '<td>'.$data->dateVisite.'</td>';
		     				   echo '<td>'.$data->remplacant.'</td>';
		     				   echo '<td>'.$data->coef.'</td>';
		     				   echo '<td>'.$data->date.'</td>';
		     				   echo '<td>'.$data->bilan.'</td>';
		     				   echo '<td>'.$data->motif.'</td>';
		     				echo '</tr>';
		   				 }?>
				</tbody>
			</table>
		</div>
	</div>
	
 
	
