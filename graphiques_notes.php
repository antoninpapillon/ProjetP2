<!DOCTYPE html>
<html lang="fr">

	<head>
		
		<meta charset="utf-8" />
		<title>Liste module — Espace de notes IUT Laval</title>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" href="/favicon.png" type="image/png">
        <script src="echarts.js"></script>
	    <style>
	        .red {color:red;}
	    </style>
	</head>
	
	<body>
		<?php	
		$file_json = file_get_contents("./src/data/mcc/mmi1s2.json");
		$json_a = json_decode($file_json, true);
		$k = 0;
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
                					$intitule[$k] = str_replace(',', '.', $value['intitule']);
                					$note[$k] = str_replace(',', '.', $data[4]);
                					$k++;
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
                					$intitule[$k] = str_replace(',', '.', $value['intitule']);
                					$note[$k] = str_replace(',', '.', $data[4]);
                					$k++;
            				    }
            				}
            			}
            			fclose($handle);
            		}
				}
			}
		}
		
		echo "
		<div style='display:flex; justify-content:center;'>
		    <div id='main' style='width: 100%;height:40vw;'></div>
		</div>
	    <script type='text/javascript'>
            // based on prepared DOM, initialize echarts instance
            var myChart = echarts.init(document.getElementById('main'));
    
            // specify chart configuration item and data
            var option = {
                title: {
                    text: 'Moyennes'
                },
                tooltip: {},
                legend: {
                    data: ['Ma moyenne', 'Moyenne de la classe']
                },
                radar: {
                    // shape: 'circle',
                    name: {
                        textStyle: {
                            color: '#fff',
                            backgroundColor: '#263A7A',
                            borderRadius: 3,
                            padding: [3, 5]
                       }
                    },
                    indicator: [
                        ";
                        for($y=0;$y<count($intitule);$y++){
                            echo "{ name: '".addslashes($intitule[$y])."', max: 20},";
                        }
                        echo "
                    ]
                },
                toolbox: {
                    feature: {
                        magicType: {type: ['radar','line', 'bar']},
                        saveAsImage: {}
                    },
                },
                series: [{
                    name: 'Moyennes',
                    type: 'radar',
                    data : [
                        {
                            value : [10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10],
                            name : 'Moyenne de la classe',
                            itemStyle: {
                                normal: {
                                    color: '#263A7A'
                                }
                            },
                        },
                        {
                            value : [";
                            for($y=0;$y<count($note);$y++){
                                echo $note[$y];
                                echo ",";
                            }
                            echo "],
                            name : 'Ma moyenne',
                            itemStyle: {
                                normal: {
                                    color: '#e6007e'
                                }
                            },
                            label: {
                                normal: {
                                    show: true,
                                    position: 'top',
                                    backgroundColor: 'rgba(230, 0, 126,1)',
                                    borderRadius: 5,
                                    color: 'white',
                                    padding: 2,
                                },
                            },
                        },
                    ]
                }]
            };
    
            // use configuration item and data specified to show chart
            myChart.setOption(option);
        </script>
        ";
		?>
		<script src="./src/js/app.js" type="text/javascript"></script>
	</body>

</html>