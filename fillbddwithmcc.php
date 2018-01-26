<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
		<?php
		$file_json = file_get_contents('./src/data/mcc/mmi1s1.json');
		$json_a = json_decode($file_json, true);
		
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
		
		/*
		//
		// ------------ UE
		//
		*/ 
		
		foreach ($json_a['UE'] as $value) {
			$data_apogee = $value['codeApogee'];
			$data_coeff = $value['coeff'];
			$data_colonnerecap = $value['colonneRecap'];
			$data_optionnel = $value['optionnel'];
			$data_intitule = $value['intitule'];
			
			$req_UE = $DB->prepare('SELECT * FROM UE WHERE code_apogee=:code_apogee');
			$req_UE->bindValue(':code_apogee', $data_apogee, PDO::PARAM_STR);
			$req_UE->execute();
			if($req_UE->rowCount() > 0) {
				echo "L'UE $data_apogee existe déjà.<br />";
			} else {
				// Ajout de l'UE dans la base de données
				echo "Ajout de l'UE : <b>$data_apogee</b><br />";
				try {
					$req_insert = $DB->prepare('INSERT INTO UE (id, code_apogee, coeff, colonne_recap, optionnel, intitule) VALUES (:identifiant, :code_apogee, :coeff, :colonne_recap, :optionnel, :intitule)');
					$req_insert->bindValue(':identifiant', $data_identifiant, PDO::PARAM_INT);
					$req_insert->bindValue(':code_apogee', $data_apogee, PDO::PARAM_STR);
					$req_insert->bindValue(':coeff', $data_coeff, PDO::PARAM_INT);
					$req_insert->bindValue(':colonne_recap', $data_colonnerecap, PDO::PARAM_STR);
					$req_insert->bindValue(':optionnel', $data_optionnel, PDO::PARAM_STR);
					$req_insert->bindValue(':intitule', $data_intitule, PDO::PARAM_STR);
					$req_insert->execute();
				}
				catch (PDOException $e) {
					die($e->getMessage());
				}
				$req_insert->closeCursor();
			}
			$req_UE->closeCursor();
		}
		
		/*
		//
		// ------------ Module
		//
		*/ 
		foreach ($json_a['UE'] as $value) {
			$codeApogeeUE = $value['codeApogee'];
			if ($value['module'])
			{
				foreach ($value['module'] as $value)
				{
					$data_apogee = $value['codeApogee'];
					$data_coeff = $value['coeff'];
					$data_colonnerecap = $value['colonneRecap'];
					$data_optionnel = $value['optionnel'];
					$data_intitule = $value['intitule'];
					$data_UE = $codeApogeeUE;
					
					$req_module = $DB->prepare('SELECT * FROM Module WHERE code_apogee=:code_apogee');
					$req_module->bindValue(':code_apogee', $data_apogee, PDO::PARAM_STR);
					$req_module->execute();
					if($req_module->rowCount() > 0) {
						echo "Le module $data_apogee existe déjà.<br />";
					} else {
						// Ajout du module dans la base de données
						echo "Ajout du module : <b>$data_apogee</b><br />";
						try {
							$req_insert = $DB->prepare('INSERT INTO Module (code_apogee, coeff, colonne_recap, optionnel, intitule, code_apogee_UE) VALUES (:code_apogee, :coeff, :colonne_recap, :optionnel, :intitule, :code_apogee_UE)');
							$req_insert->bindValue(':code_apogee', $data_apogee, PDO::PARAM_STR);
							$req_insert->bindValue(':coeff', $data_coeff, PDO::PARAM_INT);
							$req_insert->bindValue(':colonne_recap', $data_colonnerecap, PDO::PARAM_STR);
							$req_insert->bindValue(':optionnel', $data_optionnel, PDO::PARAM_STR);
							$req_insert->bindValue(':intitule', $data_intitule, PDO::PARAM_STR);
							$req_insert->bindValue(':code_apogee_UE', $data_UE, PDO::PARAM_STR);
							$req_insert->execute();
						}
						catch (PDOException $e) {
							die($e->getMessage());
						}
						$req_insert->closeCursor();
					}
					$req_module->closeCursor();
				}
			}
		}
		
		/*
		//
		// ------------ Sous Module
		//
		*/ 
		foreach ($json_a['UE'] as $value) {
			$codeApogeeUE = $value['codeApogee'];
			if ($value['module'])
			{
				foreach ($value['module'] as $value)
				{
					$data_apogee = $value['codeApogee'];
					$data_coeff = $value['coeff'];
					$data_colonnerecap = $value['colonneRecap'];
					$data_optionnel = $value['optionnel'];
					$data_intitule = $value['intitule'];
					$data_UE = $codeApogeeUE;
					
					$req_module = $DB->prepare('SELECT * FROM Module WHERE code_apogee=:code_apogee');
					$req_module->bindValue(':code_apogee', $data_apogee, PDO::PARAM_STR);
					$req_module->execute();
					if($req_module->rowCount() > 0) {
						echo "Le module $data_apogee existe déjà.<br />";
					} else {
						// Ajout du module dans la base de données
						echo "Ajout du module : <b>$data_apogee</b><br />";
						try {
							$req_insert = $DB->prepare('INSERT INTO Module (code_apogee, coeff, colonne_recap, optionnel, intitule, code_apogee_UE) VALUES (:code_apogee, :coeff, :colonne_recap, :optionnel, :intitule, :code_apogee_UE)');
							$req_insert->bindValue(':code_apogee', $data_apogee, PDO::PARAM_STR);
							$req_insert->bindValue(':coeff', $data_coeff, PDO::PARAM_INT);
							$req_insert->bindValue(':colonne_recap', $data_colonnerecap, PDO::PARAM_STR);
							$req_insert->bindValue(':optionnel', $data_optionnel, PDO::PARAM_STR);
							$req_insert->bindValue(':intitule', $data_intitule, PDO::PARAM_STR);
							$req_insert->bindValue(':code_apogee_UE', $data_UE, PDO::PARAM_STR);
							$req_insert->execute();
						}
						catch (PDOException $e) {
							die($e->getMessage());
						}
						$req_insert->closeCursor();
					}
					$req_module->closeCursor();
				}
			}
		}
		
		/*
		//
		// ------------ Epreuve
		//
		*/ 
		foreach ($json_a['UE'] as $value) {
			$codeApogeeUE = $value['codeApogee'];
			foreach ($value['module'] as $value)
			{
				$codeApogeeModule = $value['codeApogee'];
				if ($value['epreuve'])
				{
					foreach ($value['epreuve'] as $value)
					{
						$data_apogee = $value['codeApogee'];
						$data_coeff = $value['coeff'];
						$data_type = $value['type'];
						$data_optionnel = $value['optionnel'];
						$data_intitule = $value['intitule'];
						$data_enseignant = $value['enseignant'];
						$data_module = $codeApogeeModule;
						
						$req_UE = $DB->prepare('SELECT * FROM Epreuve WHERE code_apogee=:code_apogee');
						$req_UE->bindValue(':code_apogee', $data_apogee, PDO::PARAM_STR);
						$req_UE->execute();
						if($req_UE->rowCount() > 0) {
							echo "L'épreuve $data_apogee existe déjà.<br />";
						} else {
							// Ajout de l'épreuve dans la base de données
							echo "Ajout de l'épreuve : <b>$data_apogee</b><br />";
							try {
								$req_insert = $DB->prepare('INSERT INTO Epreuve (code_apogee, coeff, type, optionnel, intitule, code_apogee_module, enseignant) VALUES (:code_apogee, :coeff, :type, :optionnel, :intitule, :code_apogee_module, :enseignant)');
								$req_insert->bindValue(':code_apogee', $data_apogee, PDO::PARAM_STR);
								$req_insert->bindValue(':coeff', $data_coeff, PDO::PARAM_STR);
								$req_insert->bindValue(':type', $data_type, PDO::PARAM_STR);
								$req_insert->bindValue(':optionnel', $data_optionnel, PDO::PARAM_STR);
								$req_insert->bindValue(':intitule', $data_intitule, PDO::PARAM_STR);
								$req_insert->bindValue(':code_apogee_module', $data_module, PDO::PARAM_STR);
								$req_insert->bindValue(':enseignant', $data_enseignant, PDO::PARAM_STR);
								$req_insert->execute();
							}
							catch (PDOException $e) {
								die($e->getMessage());
							}
							$req_insert->closeCursor();
						}
						$req_UE->closeCursor();
					}
				}
			}
		}
					
					
		
		// UE
		foreach ($json_a['UE'] as $value) {
			$codeApogeeUE = $value['codeApogee'];
			echo "UE : $codeApogeeUE<br />";
		}
		
		// Module
		foreach ($json_a['UE'] as $value) {
			$codeApogeeUE = $value['codeApogee'];
			if ($value['module'])
			{
				foreach ($value['module'] as $value)
				{
					$codeApogeeModule = $value['codeApogee'];
					echo "-- Le module $codeApogeeModule est dans l'UE : $codeApogeeUE<br />";
				}
			}
		}
		
		// Epreuve
		foreach ($json_a['UE'] as $value) {
			$codeApogeeUE = $value['codeApogee'];
			foreach ($value['module'] as $value)
			{
				$codeApogeeModule = $value['codeApogee'];
				if ($value['epreuve'])
				{
					foreach ($value['epreuve'] as $value)
					{
						$codeApogeeEpreuve = $value['codeApogee'];
						echo "---- L'épreuve $codeApogeeEpreuve est dans le module : $codeApogeeModule qui est dans l'UE : $codeApogeeUE<br />";
					}
				}
			}
		}
		
		//Epreuve sous-module
		foreach ($json_a['UE'] as $value) {
			$codeApogeeUE = $value['codeApogee'];
			foreach ($value['module'] as $value)
			{
				$codeApogeeModule = $value['codeApogee'];
				if ($value['sous-module']){
					foreach ($value['sous-module'] as $value)
					{
						$codeApogeeSousModule = $value['codeApogee'];
						if ($value['epreuve'])
						{
							foreach ($value['epreuve'] as $value)
							{
								$codeApogeeEpreuve = $value['codeApogee'];
								echo "---- L'épreuve $codeApogeeEpreuve est dans le module : $codeApogeeModule dans le sous-module : $codeApogeeSousModule qui est dans l'UE : $codeApogeeUE<br />";
							}
						}
					}
				}
			}
		}
		?>
		
	</body>
</html>