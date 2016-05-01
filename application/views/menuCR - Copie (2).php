<?php
if (isset($_POST['connexion']) && $_POST['connexion'] == 'connexion') 
		{
			
			if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['mdp']) && !empty($_POST['mdp']))) 
			{
				mysql_connect("127.0.0.1", "root","");
				mysql_select_db("site_com");
				
				$sql = 'SELECT count(*) FROM inscris WHERE login="'.($_POST['login']).'" AND mdp="'.md5($_POST['mdp']).'"';
				$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
				$data = mysql_fetch_array($req);
				mysql_free_result($req);
				mysql_close();

				if ($data[0] == 1 ) 
				{
					if($_POST['login'] == 'admin' AND $_POST['mdp'] == 'admin')
					{
						session_start();
						$_SESSION['login'] = $_POST['login'];
						$res = "Connection Reussi !" ;	
					}
					else
					{
						session_start();
						$_SESSION['login'] = $_POST['login'];
						$res = "Connection Reussi !" ;	
						$redirect = "<meta http-equiv='refresh' content='1;membre.php' />";
					}
				}

				else
				{
					$res = 'Compte non reconnu.';
					echo $res;
				}
				
			}
				
		}
	?>