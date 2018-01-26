<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8"/>
		<title></title>
		<link rel="stylesheet" type="text/css" href="./src/css/reset.css"/>
		<link rel="stylesheet" type="text/css" href="./src/css/main.new.css"/>
		<link rel="stylesheet" type="text/css" href="./src/css/templates.new.css"/>
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
		<script src="./echarts.js"></script>
		<link rel="shortcut icon" type="image/png" href=""/>
	</head>
	<body>
		<header>
			<div>
				<a href=""><img src="./src/pics/layout/logo_head.svg" alt="Université du Maine"/></a>
				<p>Prénom N.</p>
			</div>
			<nav>
				<ul class="desktop">
					<li>
						<a href="#" class="btn">
							<span>
								<i class="fa fa-pie-chart" aria-hidden="true"></i> 
								Visualiser mes notes
							</span>
						</a>
					</li>
					<li>
						<a href="#" class="btn">
							<span>
								<i class="fa fa-pencil-square-o" aria-hidden="true"></i> 
								Saisir des notes
							</span>
						</a>
					</li>
					<li>
						<a href="#logout" class="btn">
							<span>
								<i class="fa fa-sign-out" aria-hidden="true"></i>
							</span>
						</a>
					</li>
				</ul>
				<ul class="small">
					<li>
						<a href="#" class="btn">
							<span>
								<i class="fa fa-pie-chart" aria-hidden="true"></i>
							</span>
						</a>
					</li>
					<li>
						<a href="#" class="btn">
							<span>
								<i class="fa fa-pencil-square-o" aria-hidden="true"></i> 
							</span>
						</a>
					</li>
					<li>
						<a href="#logout" class="btn">
							<span>
								<i class="fa fa-sign-out" aria-hidden="true"></i>
							</span>
						</a>
					</li>
				</ul>
			</nav>
		</header>
		<main>
			<h1>Visualiser mes notes</h1>
			<div>
				<section>
					<div>
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
						<h2>Notes en graphique</h2>
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
						<div style='width: 100%;overflow: auto;'>
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
				                            echo "{ name: '".addslashes(substr($intitule[$y], 5, 9))."', max: 20},";
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
				<li>IUT de Laval — Le Mans Université</li>
				<li>52, rue des Docteurs Calmette et Guérin BP 2045 53000 Laval Cedex 09</li>
				<li><a href="http://www.iut-laval.univ-lemans.fr" target="_blank">www.iut-laval.univ-lemans.fr</a></li>
			</ul>
			<ul>
			</ul>
		</footer>
		<!--<script src="./src/js/main-min-height.js"></script>-->
		<script src="./src/js/select_line.js"></script>
	</body>
</html>