<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8"/>
		<title></title>
		<link rel="stylesheet" type="text/css" href="./src/css/reset.css"/>
		<link rel="stylesheet" type="text/css" href="./src/css/main.css"/>
		<link rel="stylesheet" type="text/css" href="./src/css/templates.css"/>
		<script src="echarts.js"></script>
		<link rel="shortcut icon" type="image/png" href=""/>
	</head>
	<body>
		<header>
			<div>
				<img src="./src/pics/layout/logo_head.svg" alt="Université du Maine"/>
				<p>Prénom N.</p>
			</div>
			<nav>
				<ul class="desktop">
					<li><a href="">Visualiser</a></li>
					<li><a href="">Saisir</a></li>
				</ul>
				<ul class="small">
					<li><a href="">V</a></li>
					<li><a href="">S</a></li>
				</ul>
			</nav>
		</header>
		<main>
			<h1>Le grand titre</h1>
			<div>
				<section>
					<div>
						<img src="https://image.flaticon.com/icons/svg/148/148971.svg" alt="bulletin-note"/>
						<h2>Mon bulletin</h2>
					</div>
					<div>
						<table>
							<thead>
								<tr>
									<th>Nom</th>
									<th>Note</th>
								</tr>
							</thead>
							<tbody>
								<?php	
								include 'functions.php';
								
								AfficherBulletin('mmi1s1.json', '20160001', 'mmi1s2elp-2.csv', 'csv2.csv');
								AfficherBulletin('mmi1s2.json', '20160001', 'mmi1s2elp-2.csv', 'csv2.csv');
								
								?>
							</tbody>
						</table>
						<div class="moy">
							<p>Moyenne générale</p>
							<p>10,66</p>
						</div>
					</div>
				</section>
				<section>
					<div>
						<img src="https://image.flaticon.com/icons/svg/178/178151.svg" alt="graphic">
						<h2>Note en graphique</h2>
					</div>
					<div>
						<?php	
						$file_json = file_get_contents("mmi1s2.json");
						$json_a = json_decode($file_json, true);
						$k = 0;
						foreach ($json_a['UE'] as $value) {
							if ($value['module']){
								foreach ($value['module'] as $value) {
								    
								    //afficher note module
									$row = 1;
				            		if (($handle = fopen("mmi1s2elp-2.csv", "r")) !== FALSE) {
				            			while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
				            				$num = count($data);
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
				                            echo "{ name: '".addslashes(substr($intitule[$y], 0, 5))."', max: 20},";
				                        }
				                        echo "
				                    ]
				                },
				                toolbox: {
				                    feature: {
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
					</div>
				</section>
			</div>
		</main>
		<footer>
			<ul>
				<li>IUT de Laval</li>
				<li>Le Mans<br/>Université</li>
			</ul>
			<ul>
				<li><a href=""><img src="" alt=""/>Déconnexion</a></li>
				<li><a href="#">Retour en haut</a></li>
				<li><a href="http://ent.univ-lemans.fr" target="_blank"><span>ENT</span>Environnement Numérique de Travail</a></li>
			</ul>
			<ul>
				<li>52, rue des Docteurs Calmette et Guérin</li>
				<li>BP 2045</li>
				<li>53000 Laval Cedex 09</li>
				<li><a href="http://www.iut-laval.univ-lemans.fr" target="_blank">www.iut-laval.univ-lemans.fr</a></li>
			</ul>
		</footer>
		<script src="./src/js/main-min-height.js"></script>
		<script src="./src/js/select_line.js"></script>
	</body>
</html>