<!DOCTYPE html>
<html lang="fr">

	<head>
		
		<meta charset="utf-8" />
		<title>Visualisation notes — Espace de notes IUT Laval</title>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" href="/favicon.png" type="image/png">
	
	</head>
	
	<body>
		<?php
		
		$compteur=0;
		$profs= array (
			array($prof, $code1, $code2)
			);

		//$codes=[];
		// $codeEleve;
					
		$file_json = file_get_contents("mmi1s2.json");
		$json_a = json_decode($file_json, true);
		
		foreach ($json_a['UE'] as $value) {
			if ($value['module']){
				foreach ($value['module'] as $value) {
					if ($value['epreuve']){
						foreach ($value['epreuve'] as $value) {
							$profs[$value['enseignant']] = null;
						}
					}
				}
			}
		}
		
		$result = count($profs);
		// echo 'Les profs présents : <br/>';
		
		// for ($a=1; $a <= $result ; $a++) {
		// 	echo '<br/>'.$profs[$a]; 
		// 	 echo '<br/>code Apogée : '.$codes[$a].'<br/>';
		// }		
		
							
		echo '<pre>';
		print_r($profs);
		echo '</pre>';

		?>
		<script src="./src/js/app.js" type="text/javascript"></script>
	</body>

</html>