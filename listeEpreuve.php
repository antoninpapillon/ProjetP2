<?php

function result($intitule, $codeApogee, $coeff) {
	return array(
		'intitule' => $intitule,
		'codeApogee' => $codeApogee,
		'coeff' => $coeff
	);
}

function getNotes($epr) {
	$file_json = file_get_contents("./src/data/notes-epr/".$epr.".json");
	return json_decode($file_json, true);
}

function getEpreuves($epr = false) {
	
	$file_json = file_get_contents("./src/data/mcc/mmi1s2.json");
	$json_a = json_decode($file_json, true);
	
	$return = [];
	foreach ($json_a['UE'] as $value) {
		if ($value['module']) {
			foreach ($value['module'] as $value) {
				
				// On récupère les options
				if ($value['optionnel']) {
					if($epr) {
						// Si on désire une épreuve en particulier, on la récupère
						if($value['codeApogee'] == $epr) {
							$return[] = result($value['intitule'], $value['codeApogee'], $value['coeff']);
						}
					} else {
						// Sinon on récupère toutes les épreuves 
						$return[] = array(
							'intitule' => $value['intitule'],
							'codeApogee' => $value['codeApogee'],
							'coeff' => $value['coeff']
						);
					}
				}
				
				// On récupère les épreuves dans les sous-modules
				if ($value['sous-module']) {
					foreach ($value['sous-module'] as $value) {
						if ($value['epreuve']){
							foreach($value['epreuve'] as $value) {
								if($epr) {
									// Si on désire une épreuve en particulier, on la récupère
									if($value['codeApogee'] == $epr) {
										$return[] = result($value['intitule'], $value['codeApogee'], $value['coeff']);
									}
								} else {
									// Sinon on récupère toutes les épreuves 
									$return[] = result($value['intitule'], $value['codeApogee'], $value['coeff']);
								}
							}
						}
					} 
				}
				
				// On récupère les autres épreuves
				if ($value['epreuve']) {
					foreach ($value['epreuve'] as $value) {
						if($epr) {
							// Si on désire une épreuve en particulier, on la récupère
							if($value['codeApogee'] == $epr) {
								$return[] = result($value['intitule'], $value['codeApogee'], $value['coeff']);
							}
						} else {
							// Sinon on récupère toutes les épreuves 
							$return[] = result($value['intitule'], $value['codeApogee'], $value['coeff']);
						}
					}
				}
			}
		}
	}
	return $return;
}