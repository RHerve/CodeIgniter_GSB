<?php
/*-------------------------- Déclaration de la classe -----------------------------*/
class classConnexion extends CI_Model{
/*----------------Propriétés de la classe  -----------------------------------*/

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

function connexion($login, $pass)
 {
	 
   $this ->db-> select('VIS_NOM, VIS_DATEEMBAUCHE');
   $this ->db-> from('visiteur');
   $this ->db-> where('VIS_NOM', $login);
   $this ->db-> where('VIS_DATEEMBAUCHE', $pass); // ajouter MD5($password) pour le crypter (avant crypter sur la BDD
 
   $query = $this -> db -> get();
 
   if($query -> num_rows() == 1)
   {
     return true;
   }
   else
   {
     return false;
   }
 }



}
?>