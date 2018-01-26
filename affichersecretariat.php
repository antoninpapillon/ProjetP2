<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title></title>
    <link rel="stylesheet" type="text/css" href="./src/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="./src/css/main.new.css" />
    <link rel="stylesheet" type="text/css" href="./src/css/templates.new.css" />
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="shortcut icon" type="image/png" href="" />
</head>

<body>
    <header>
        <div>
            <a href=""><img src="./src/pics/layout/logo_head.svg" alt="Université du Maine"/></a>
            <p>Prénom N.</p>
        </div>
        <nav>
            <ul class="desktop">
            </ul>
        </nav>
    </header>
    <main>
        <h1>Afficher les notes reçues par mail</h1>
        <div>
            <section>
                <div>
                    <h2>Glissez/Déposez votre fichier de note</h2>
                </div>
                <div>
                    <form method="post" enctype="multipart/form-data">
                        <div>
                            <label for="file">Sélectionner le fichier à envoyer</label>
                            <input type="file" id="file" name="file">
                        </div>
                    </form>
                    <br>
                    <div>
                        <a href="#" id="visualiser_btn" class="btn">
							<span>
								<i class="fa fa-pie-chart" aria-hidden="true"></i> 
								Visualiser mes notes
							</span>
						</a>
                    </div>
                </div>
            </section>
					
            <section id="notes">
                <div>
                    <h2>Affichage des notes</h2>
                </div>
                <div>
					<h3></h3>
                    <table>
                        <thead>
                            <tr>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
	<script src="./src/js/main-min-height.js"></script>
    <script src="./src/js/select_line.js"></script>
    <script type="text/javascript" src="./echarts.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $('#visualiser_btn').on('click', function() {
            var input = $('#file');
            var output = $('section#notes tbody');
			var txt = new FileReader();
           
			txt.onload = function() {
                var obj = JSON.parse(txt.result), th;
                output.html('');
				
				// Title
				$('h3').html('Epreuve '+obj.codeEpr+'</h2>');
				
				// Format of table body
				if(obj.anonymous === true) {
					th = '<th>Numéro d\'anonymat</th>\
							<th>Note</th>\
							<th>Absence</th>';
				} else {
					th = '<th>Nom</th>\
							<th>Code</th>\
							<th>Note</th>\
							<th>Absence</th>';
				}
				$('section#notes thead>tr').html(th);
				
				// Data
                var module = "";
                for(var i in obj['notes']) {
                    module += '<tr class="module">';
					if(obj.anonymous === true) {
                    	module += '<td>' + obj['notes'][i].numero + '</td>';
					}else{
						module += '<td>' + obj['notes'][i].nom + '</td>';
						module += '<td>' + obj['notes'][i].code + '</td>';
					}
					module += '<td>' + obj['notes'][i].note + '</td>';
					var color = obj["notes"][i].absence==="ABJ" ? "green" : "red";
					var absence = obj['notes'][i].absence===false?'':obj['notes'][i].absence;
					module += '<td style="color:'+color+'">'+absence+'</td>';
                    module += '</tr>';
                }
                output.html(module);
            };
			
            txt.readAsText(input.prop('files')[0]);
        });
    </script>
</body>

</html>