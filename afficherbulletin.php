<!DOCTYPE html>
<html lang="fr">

	<head>
		
		<meta charset="utf-8" />
		<title>Liste module — Espace de notes IUT Laval</title>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" href="/favicon.png" type="image/png">
	    
	    <style>
	        .red {color:red;}
	    </style>
	</head>
	
	<body>
		<?php	
		$file_json = file_get_contents("mmi1s2.json");
		$json_a = json_decode($file_json, true);
		
		foreach ($json_a['UE'] as $value) {
			if ($value['module']){
				foreach ($value['module'] as $value) {
				    
				    //afficher note module
					//echo $value['intitule'].' - <b>'.$value['codeApogee'].' | '.$value['coeff'].'</b><br />';
					$row = 1;
            		if (($handle = fopen("mmi1s2elp-2.csv", "r")) !== FALSE) {
            			while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            				$num = count($data);
            				//echo "<p> $num champs à la ligne $row: <br /></p>\n";
            				
            				$row++;
            				if ($data[0] == '20160001')
            				{
            				    if ($data[3] == $value['codeApogee'])
            				    {
                					for ($c=0; $c < $num; $c++) {
                						echo $data[$c] . " | \n";
                					}
                					echo $value['intitule'].' - <b>'.$value['codeApogee'].' | '.$value['coeff'].'</b><br />';
            				    }
            				}
            			}
            			fclose($handle);
            		}
            		$row = 1;
            		if (($handle = fopen("csv2.csv", "r")) !== FALSE) {
            			while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            				$num = count($data);
            				//echo "<p> $num champs à la ligne $row: <br /></p>\n";
            				
            				$row++;
            				if ($data[0] == '20160001')
            				{
            				    if ($data[3] == $value['codeApogee'])
            				    {
                					for ($c=0; $c < $num; $c++) {
                						echo $data[$c] . " | \n";
                					}
                					echo $value['intitule'].' - <b>'.$value['codeApogee'].' | '.$value['coeff'].'</b><br />';
            				    }
            				}
            			}
            			fclose($handle);
            		}
            		
            		//afficher epreuve par module
            		if ($value['epreuve']) {
    					foreach ($value['epreuve'] as $value) {
    						//echo $value['intitule'].' - <b>'.$value['codeApogee'].' | '.$value['coeff'].'</b><br />';
    						$row = 1;
                    		if (($handle = fopen("mmi1s2elp-2.csv", "r")) !== FALSE) {
                    			while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                    				$num = count($data);
                    				//echo "<p> $num champs à la ligne $row: <br /></p>\n";
                    				
                    				$row++;
                    				if ($data[0] == '20160001')
                    				{
                    				    if ($data[3] == $value['codeApogee'])
                    				    {
                    				        echo '<div class="red"> &nbsp &nbsp &nbsp';
                        					for ($c=0; $c < $num; $c++) {
                        						echo $data[$c] . " | \n";
                        					}
                        					echo $value['intitule'].' - <b>'.$value['codeApogee'].' | '.$value['coeff'].'</b><br /></div>';
                    				    }
                    				}
                    			}
                    			fclose($handle);
                    		}
                    		$row = 1;
                    		if (($handle = fopen("csv2.csv", "r")) !== FALSE) {
                    			while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                    				$num = count($data);
                    				//echo "<p> $num champs à la ligne $row: <br /></p>\n";
                    				
                    				$row++;
                    				if ($data[0] == '20160001')
                    				{
                    				    if ($data[3] == $value['codeApogee'])
                    				    {
                    				        echo '<div class="red"> &nbsp &nbsp &nbsp';
                        					for ($c=0; $c < $num; $c++) {
                        						echo $data[$c] . " | \n";
                        					}
                        					echo $value['intitule'].' - <b>'.$value['codeApogee'].' | '.$value['coeff'].'</b></div>';
                    				    }
                    				}
                    			}
                    			fclose($handle);
                    		}
            		    }
        			}
				}
			}
		}
		
		
		?>
		<script src="./src/js/app.js" type="text/javascript"></script>
	</body>

</html>