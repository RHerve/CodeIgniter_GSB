<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class controlleur_principal extends CI_Controller {
	public function __construct(){ 
		// LANCEMENT DE LA SESSION 
		if(!session_start()){
			session_start();
		}
		//initialisation du constructeur
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('url');
	}
	
	public function index(){
		
		$data['title'] = 'Connexion GSB';
	    $this->load->view('templates/header_deco', $data);
	    $this->load->view('connection');
	    $this->load->view('templates/footer');

		
	}
 // LANCEMENT CONNEXION IDENTIFICATION DE LA SESSION
	public function connexion(){
		
		$login = $this->input->post('login');
		$pass = $this->input->post('mdp');
		
		$pass = $this->dateFrancaisVersAnglais($pass);
		$this->load->model('classConnexion');
		$this->load->model('model');
		
		if($this->classConnexion->connexion($login,$pass)){

			$_SESSION['login'] = $login;

			//répupération ID du visiteur		
			$listId = $this->model->getVisiteur_id($login,$pass);
		
			foreach ($listId as $key) {
				$_SESSION['idV'] = $key->VIS_MATRICULE;
			}
			$this->nomVisiteur();
		    $this->rapport();
		    
		
		}else{
			//'Login ou mot de passe incorrect';
			
	  		//$this->session->set_flashdata('message', 'Login ou mot de passe incorrect');

			//$message = $this->session->flashdata('message');
			redirect($this->index);
			//$this->load->view('connection', $data);
		}
	}
// RECUPERATION VISITEUR
	public function nomVisiteur(){
		$this->load->model('model');
		$data = array();

		$data['nomV'] = $this->model->getVisiteur_nom($_SESSION['idV']);
		//$this->load->view('templates/header', $data);
	}
	
	public function rapport(){
		
		if(!isset($_SESSION['login'])){
			redirect($this->index);
		}

		$this->load->model('model');
		$data = array();


		//$this->nomVisiteur();
		$data['nomV'] = $this->model->getVisiteur_nom($_SESSION['idV']);

        $data['title'] = 'formulaire RAPPORT_VISITE';
	   
	    $data['contents'] = 'formRAPPORT_VISITE';

	    $data['praticien'] = $this->model->getPraticien();
	 
		$data['resultListeRapport'] = $this->model->getAllRapport();
	
		
	    $this->load->view('template', $data);
	}

	public function verifConnexion(){
		if(!isset($_SESSION['login'])){
			redirect($this->index);
		}
	}
// PAGE CONSULTATION
	public function consultation(){
		$this->verifConnexion();

		$this->load->model('model');

		$data['nomV'] = $this->model->getVisiteur_nom($_SESSION['idV']);

	   	$data['title'] = 'Consultation';

	    $data['contents'] = 'tableVISITES';

		 $data['result'] = $this->model->getVisites_data($_SESSION['idV']);
	 
	    $this->load->view('template', $data);
	}
	// PAGE VISITEUR
	public function visiteur(){

		if(!isset($_SESSION['login'])){
			redirect($this->index);
		}

		$this->load->model('model');
		$data['nomV'] = $this->model->getVisiteur_nom($_SESSION['idV']);
		$data['title'] = 'formulaire VISITEUR';
	    
	    $data['contents'] = 'formVISITEUR';
	 
	    $data['result'] = $this->model->getVisiteur();

	    $this->load->view('template', $data);
		
	}
// RECUPERATION DONN2ES
	public function visiteur_data(){

		if(!isset($_SESSION['login'])){
			redirect($this->index);
		}

		$this->load->model('model');
		
		$visiteur = $this->input->post('visiteur');

		$row = $this->model->getVisiteur_data($visiteur);
		

		echo $html = '
		<table>
			<tr>
				<td>NOM :</td>
				<td>'.$row[0]->VIS_NOM.'</td>
			</tr>

			<tr>
				<td>PRENOM :</td>
				<td>'.$row[0]->Vis_PRENOM.'</td>
			</tr>

			<tr>
				<td>ADRESSE :</td>
				<td>'.$row[0]->VIS_ADRESSE.'</td>
			</tr>

			<tr>
				<td>CP :</td>
				<td>'.$row[0]->VIS_CP.'</td>
			</tr>

			<tr>
				<td>VILLE :</td>
				<td>'.$row[0]->VIS_VILLE.'</td>
			</tr>

			<tr>
				<td>SECTEUR :</td>
				<td>'.$row[0]->SEC_CODE.'</td>
			</tr>
			<tr>
				<td>LABO :</td>
				<td>'.$row[0]->LAB_NOM.'</td>
			</tr>
		</table>';	

	}

	// PAGE PRATICIENS
	public function praticien(){

		if(!isset($_SESSION['login'])){
			redirect($this->index);
		}

		$this->load->model('model');
		$data['nomV'] = $this->model->getVisiteur_nom($_SESSION['idV']);
		$data['title'] = 'formulaire PRATICIEN';

	    $data['contents'] = 'formPRATICIEN';

	    $data['result'] = $this->model->getPraticien();

	    $this->load->view('template', $data);
	}


// RECUP DONNEES PRATICIENS
	public function praticien_data(){

		if(!isset($_SESSION['login'])){
			redirect($this->index);
		}

		$this->load->model('model');
		
		$praticien = $this->input->post('praticien');

		$row = $this->model->getPraticien_data($praticien);
		echo $html = '
		<table>
			<tr>
				<td>NUMERO :</td>
				<td>'.$row[0]->PRA_NUM.'</td>
			</tr>

			<tr>
				<td>NOM :</td>
				<td>'.$row[0]->PRA_NOM.'</td>
			</tr>

			<tr>
				<td>PRENOM :</td>
				<td>'.$row[0]->PRA_PRENOM.'</td>
			</tr>
			
			<tr>
				<td>ADRESSE :</td>
				<td>'.$row[0]->PRA_ADRESSE.'</td>
			</tr>

			<tr>
				<td>CP :</td>
				<td>'.$row[0]->PRA_CP.'</td>
			</tr>

			<tr>
				<td>COEFF. NOTORIETE :</td>
				<td>'.$row[0]->PRA_COEFNOTORIETE.'</td>
			</tr>

			<tr>
				<td>TYPE :</td>
				<td>'.$row[0]->LIBELLE.'</td>
			</tr>
			
		</table>	';	

	}
	// PAGE MEDICAMENTS
	public function medicament(){

		if(!isset($_SESSION['login'])){
			redirect($this->index);
		}

		$this->load->model('model');
		$data['nomV'] = $this->model->getVisiteur_nom($_SESSION['idV']);
		$data['title'] = 'formulaire MEDICAMENT';
	   
	    $data['contents'] = 'formMEDICAMENT';
		
       	$data['result'] = $this->model->getMedicament();

	    $this->load->view('template', $data);

	}
// RECUPERATIONS DES DONNEE DES MEDICAMENTS
	public function medicament_data(){

		if(!isset($_SESSION['login'])){
			redirect($this->index);
		}

		$this->load->model('model');
		
		$medicament = $this->input->post('medicaments');
		$row = $this->model->getMedicament_data($medicament);
		
		echo $html = '
		<table> 
			<tr>
				<td>Code</td>
				<td>'.$row[0]->MED_DEPOTLEGAL.'</td>
			</tr>
			<tr>
				<td>Nom Commercial</td>
				<td>'.$row[0]->MED_NOMCOMMERCIAL.'</td>
			</tr>
			<tr>
				<td>Famille</td>
				<td>'.$row[0]->LIBELLE.'</td>
			</tr>
			<tr>
				<td>Composition</td>
				<td>'.$row[0]->MED_COMPOSITION.'</td>
			</tr>
			<tr>
				<td>Effets indésirables</td>
				<td>'.$row[0]->MED_EFFETS.'</td>
			</tr>
			<tr>
				<td>Contre indications</td>
				<td>'.$row[0]->MED_CONTREINDIC.'</td>
			</tr>
			<tr>
				<td>Prix échantillons</td>
				<td>'.$row[0]->MED_PRIXECHANTILLON.'</td>
			</tr>
		</table>';
	}

// DECONNEXION SESSION
	public function deconnexion(){
		session_destroy();
		redirect($this->index);
	}
 
 // MODIFICATION DES RAPPORT AVEC RECUP DES VALEURS
  public function modifRapport(){
	  
			if(!isset($_SESSION['login'])){
			redirect($this->index);
		}

		$this->load->model('model');
		$data['nomV'] = $this->model->getVisiteur_nom($_SESSION['idV']);
        $data['title'] = 'formulaire RAPPORT_VISITE';
	   
	    $data['contents'] = 'formRAPPORT_VISITE';

	    $data['praticien'] = $this->model->getPraticien();
	 
		$data['resultListeRapport'] = $this->model->getAllRapport();
		
		
		$data['recupRapport'] = $this->model->getRapport($_SESSION['idV'],$this->input->post('rapport'));
		
		$data['labelModif'] = "Modification du";
		foreach($data['recupRapport'] as $save) {
		$data['numRapport'] = $save->numRapport;
		$data['remplacant'] = $save->remplacant;
		$data['nomPraticien'] = $save->PRA_NOM;
		$data['praticien2'] = $save->PRA_NUM;
		$data['coeff'] = $save->coef;
		$data['dateVisite2'] = substr($save->dateVisite, 5, 2). '/' . substr($save->dateVisite , 8, 2). '/' .substr($save->dateVisite , 0, 4);  
		$data['motif'] = $save->motif;
		$data['bilan'] = $save->bilan;
		$data['date2'] =  substr($save->date, 5, 2). '/' . substr($save->date, 8, 2). '/' .substr($save->date, 0, 4);  

		}
	    $this->load->view('template', $data);
	  
  }
 

 
 
  //CREE UN NOUVEAU RAPPORT
 public function nouveauRapport(){
	 
	 $this->load->model('model');
	 
	  $datevisite = $this->input->post('DATEVISITE');
	 $remplacant = $this->input->post('REMPLACANT');
	 $praticien = $this->input->post('PRATICIEN');
	 $coef = $this->input->post('COEFF');
	 $date = $this->input->post('DATE');
	 $motif = $this->input->post('MOTIF');
	 $bilan= $this->input->post('BILAN');
	 $definitif = $this->input->post('DEFINITIF');
	 
	 $date3 = substr($date, 6, 4). '-' . substr($date, 0, 2). '-' . substr($date, 3, 2);  
	 $datevisite3 = substr($datevisite, 6, 4). '-' . substr($datevisite, 0, 2). '-' . substr($datevisite, 3, 2);  
	 if($definitif == NULL) $definitif = "0";
	 if($bilan == "") $bilan = "Pas de bilan";
	 $data = array(
	
		'VIS_MATRICULE' => $_SESSION['idV'] ,
	   	'dateVisite' => $datevisite3 ,
	   'remplacant' => $remplacant ,
	   'PRA_NUM' => $praticien ,
	   'coef' => $coef ,
	   'date' => $date3 ,
	   'motif' => $motif ,
	   'bilan' => $bilan ,
	   'definitif' => $definitif
	);
	
	$temp = $this->input->post('existe');
	
	if($temp =="")unset($temp); 
	 if(!isset($temp)){
	
		$data['numRapport'] = "NULL";
	
	$this->model->addRapport($data);
	 }
	 else{
		 $num = $temp;
		$this->model->updateRapport($data, $num);
		 
	 }
	 $this->rapport();
 }
 // FONCTION CHANGE DATE FR VERS EN
 function dateFrancaisVersAnglais($maDate){
	@list($jour,$mois,$annee) = explode('-',$maDate);
	return date('Y-m-d',mktime(0,0,0,$mois,$jour,$annee));
}

}
/* End of file controlleur_principal.php */
/* Location: ./application/controllers/controlleur_principal.php */
?>