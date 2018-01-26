<?php 

function AfficherNote($element, $fichiercsvelement, $numetudiantelement, $valuejson)
{
    $row = 1;
	if (($handle = fopen($fichiercsvelement, "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
			$num = count($data);
			$row++;
			if ($data[0] == $numetudiantelement)
			{
			    if ($data[3] == $valuejson['codeApogee'])
			    {
					echo'<tr class='.$element.'>
						<td>'.$valuejson["intitule"].'</td>
						<td>'.$data[4].'</td>
					</tr>';
			    }
			}
		}
		fclose($handle);
	}
}
function AfficherBulletin($fichierjson, $numetudiant, $fichiercsv, $fichiercsv2)
{
    //SEMESTRE 2
	$file_json = file_get_contents($fichierjson);
	$json_a = json_decode($file_json, true);
	
	foreach ($json_a['UE'] as $value) {
	    
	    AfficherNote("unit", $fichiercsv, $numetudiant, $value);
	    AfficherNote("unit", $fichiercsv2, $numetudiant, $value);
		
		if ($value['module']){
			foreach ($value['module'] as $value) {
			    //afficher note module
				AfficherNote("module", $fichiercsv, $numetudiant, $value);
				AfficherNote("module", $fichiercsv2, $numetudiant, $value);
        		
        		//afficher epreuve par module
        		if ($value['epreuve']) {
					foreach ($value['epreuve'] as $value) {
						AfficherNote("test", $fichiercsv, $numetudiant, $value);
				        AfficherNote("test", $fichiercsv2, $numetudiant, $value);
        		    }
    			}
			}
		}
	}
}


function fillDatabaseWithStudents($fileCSV) {
	$DB_HOST = 'localhost';
	$DB_USERNAME = 'root';
	$DB_PASSWORD = '';
	$DB_DBNAME = 'projetp2';
	try {
		$DB = new PDO('mysql:host='.$DB_HOST.';dbname='.$DB_DBNAME, $DB_USERNAME, $DB_PASSWORD);
		$DB->query('SET NAMES utf8');
		$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $e) {
		die($e->getMessage());
	}
	
	$row = 1;
	if (($handle = fopen($fileCSV, "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
			
			$data_apogee = $data[0];
			$data_identifiant = $data[1];
			$data_nom = $data[2];
			$data_prenom = $data[3];
			$data_promotion = $data[4];
			$data_groupe = $data[5];
			$data_lv2 = $data[6];
			$data_alternant = $data[7];
			$data_options = $data[8];
			
			$num = count($data);
			if (($row > 1) && ($data[0]!=null)) {
				
				// On récupère tous les étudiants
				$req_eleve = $DB->prepare('SELECT * FROM Etudiant WHERE identifiant=:identifiant AND code_apogee=:code_apogee');
				$req_eleve->bindValue(':identifiant', $data_identifiant, PDO::PARAM_STR);
				$req_eleve->bindValue(':code_apogee', $data_apogee, PDO::PARAM_STR);
				$req_eleve->execute();
				if($req_eleve->rowCount() > 0) {
					echo "L'étudiant $data_apogee existe déjà.<br />";
				} else {
					// Ajout de l'étudiant dans la base de données
					echo "Ajout de l'étudiant : <b>$data_apogee</b><br />";
					try {
						$req_insert = $DB->prepare('INSERT INTO Etudiant (identifiant, nom, prenom, code_apogee, promotion, groupe, options, lv2, alternant) VALUES (:identifiant, :nom, :prenom, :code_apogee, :promotion, :groupe, :options, :lv2, :alternant)');
						$req_insert->bindValue(':identifiant', $data_identifiant, PDO::PARAM_STR);
						$req_insert->bindValue(':nom', $data_nom, PDO::PARAM_STR);
						$req_insert->bindValue(':prenom', $data_prenom, PDO::PARAM_STR);
						$req_insert->bindValue(':code_apogee', $data_apogee, PDO::PARAM_STR);
						$req_insert->bindValue(':promotion', $data_promotion, PDO::PARAM_STR);
						$req_insert->bindValue(':groupe', $data_groupe, PDO::PARAM_STR);
						$req_insert->bindValue(':options', $data_options, PDO::PARAM_STR);
						$req_insert->bindValue(':lv2', $data_lv2, PDO::PARAM_STR);
						$req_insert->bindValue(':alternant', $data_alternant, PDO::PARAM_STR);
						$req_insert->execute();
					}
					catch (PDOException $e) {
						die($e->getMessage());
					}
					$req_insert->closeCursor();
				}
				$req_eleve->closeCursor();
			}
			$row++;
			$exist=0;
		}
		fclose($handle);
	}
}
?>