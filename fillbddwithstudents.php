<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
		<?php
			require_once './functions.php';
			
			fillDatabaseWithStudents('./src/data/profils/MMI1.csv');
			fillDatabaseWithStudents('./src/data/profils/MMI2.csv');
			fillDatabaseWithStudents('./src/data/profils/LPDIWA.csv');
		?>
	</body>
</html>