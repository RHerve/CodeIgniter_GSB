<?php 
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
	class model extends CI_Model {
		//initialisation du constructeur
		function __construct() {
			parent::__construct();
		}
// recuperation visiteurs
		public function getVisiteur(){
			$query = $this->db->get('visiteur');
			return $query->result();
		}
// recuperation visiteurs par id
		public function getVisiteur_id($nom, $pw){
			$this->db->select('VIS_MATRICULE');
			$this->db->from('visiteur');
			$this->db->where('VIS_NOM',$nom);
			$this->db->where('VIS_DATEEMBAUCHE',$pw);

			return $this->db->get()->result();

		}
// recuperation visiteurs par noms
		public function getVisiteur_nom($data){

            $this->db->select('VIS_NOM, VIS_PRENOM');
			$this->db->from('visiteur');
            $this->db->where('VIS_MATRICULE',$data);
            
            return $this->db->get()->result();
        }
			// recuperation visiteurs toutes les données
        public function getVisiteur_data($data){

            $this->db->select('VIS_NOM, Vis_PRENOM, VIS_ADRESSE, VIS_CP, VIS_VILLE, VIS_DATEEMBAUCHE, labo.LAB_NOM AS LAB_NOM, SEC_CODE');
			$this->db->from('visiteur', 'labo', 'secteur');
            $this->db->where('VIS_MATRICULE',$data);
            $this->db->join('labo', 'visiteur.LAB_CODE = labo.LAB_CODE');
  			
            return $this->db->get()->result();
           
        }

        // Récap des visites
        public function getVisites_data($idVis){

        	$this->db->select('PRA_NOM, PRA_PRENOM, dateVisite, remplacant, coef, date, bilan, motif');
			$this->db->from('rapport', 'praticien');
            $this->db->where('rapport.VIS_MATRICULE',$idVis);
			$this->db->join('praticien', 'praticien.PRA_NUM = rapport.PRA_NUM');
			
        	return $this->db->get()->result();
        }

// recuperation particiens
		public function getPraticien(){
			 $query = $this->db->get('praticien');
			return $query->result();
		}
		// recuperation particiens
		public function getPraticien_data($data){
			
            $this->db->select('PRA_NUM, PRA_NOM, PRA_PRENOM, PRA_ADRESSE, PRA_CP, PRA_VILLE, PRA_COEFNOTORIETE, engine_praticien.TYP_LIBELLE AS LIBELLE ');
            $this->db->join('engine_praticien', 'praticien.TYP_CODE = engine_praticien.TYP_CODE');
            $this->db->from('praticien', 'engine_praticien');
            $this->db->where('PRA_NUM',$data);

            $result = $this->db->get()->result();
            return $result;
        }
		
// recuperation médicaments
		public function getMedicament(){
			$query = $this->db->get('medicament');
			return $query->result();
		}
		
		public function getMedicament_data($data){
			
            $this->db->select('MED_DEPOTLEGAL,MED_NOMCOMMERCIAL, famille.FAM_LIBELLE AS LIBELLE, MED_COMPOSITION, MED_EFFETS, MED_CONTREINDIC, MED_PRIXECHANTILLON ');
            $this->db->join('famille', 'medicament.FAM_CODE = famille.FAM_CODE');
            $this->db->from('medicament', 'famille');
            $this->db->where('MED_DEPOTLEGAL',$data);

            $result = $this->db->get()->result();
            return $result;
        }
		
		
		public function addRapport($data){
			
		$this->db->insert('rapport',$data);
		}
		// recuperation rapports
		
		public function getAllRapport(){
		
			$this->db->select('numRapport, rapport.PRA_NUM, praticien.PRA_NOM AS PRA_NOM, dateVisite');
			$this->db->from('rapport', 'praticien');
			$this->db->where('definitif','0');
			$this->db->join('praticien', 'praticien.PRA_NUM = rapport.PRA_NUM');
			$result = $this->db->get()->result();
			return $result;
        }
			// recuperation rapports
		public function getRapport($createur,$rapport){
		
			$this->db->select('numRapport, dateVisite, remplacant, rapport.PRA_NUM, praticien.PRA_NOM AS PRA_NOM, coef, date, motif, bilan, definitif, VIS_MATRICULE');
			$this->db->where('VIS_MATRICULE',$createur);
			$this->db->from('rapport','praticien');
			$this->db->where('numRapport',$rapport);

			$this->db->join('praticien', 'praticien.PRA_NUM = rapport.PRA_NUM');
			$result = $this->db->get()->result();
			return $result;
        }
		
		
			// modifications rapports
		public function updateRapport($data, $num){
			$this->db->where('numRapport', $num);
			$this->db->update('rapport', $data);
		}
	}
?>

