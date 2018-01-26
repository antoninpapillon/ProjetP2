<?php

/*
 * Récupérer enseignant
 * Vérifier que l'épreuve soit bien celle de l'enseignant connecté
 * Récupérer étudiants classe
 */

setlocale(LC_TIME, "fr_FR");
require_once './listeEpreuve.php';



/*
 *
 * Récupérer profils depuis BDD (en fonction d'une classe)
 *
 */


function getStudents($class) {
	
}


// PHPMailer
require_once './src/phpmailer/class.phpmailer.php';
define('NOTES_RECEIVER_EMAIL', 'pierre.barbaroux.pro@gmail.com');
define('PHPMAILER_SMTP_HOST', 'ssl0.ovh.net');
define('PHPMAILER_SMTP_PORT', '465');
define('PHPMAILER_SMTP_TYPE', 'ssl');
define('PHPMAILER_USERNAME', 'p2@pierrebarbaroux.fr');
define('PHPMAILER_PASSWORD', 'korz123456');
define('PHPMAILER_NAME', 'Projet P2');

if(isset($_GET['epr'])) {
	$epr = getEpreuves($_GET['epr']);
	$epr = $epr[0];
	
	if($epr !== null && $_GET['epr'] != "") {
		if(isset($_POST['submit'])) {
			$anonymous = false;
			$data = [];
			
			if(isset($_POST['anonymous'])) {
				$anonymous = true;
				$numeros = $_POST['anon-numero'];
				$notes = $_POST['anon-note'];
				$absences = $_POST['anon-absence'];
				
				for($i=0; $i<count($numeros); $i++) {
					if($notes[$i] == "") $notes[$i] = false;
					if($absences[$i] == "---") $absences[$i] = false;
					$data[] = array(
						'numero' => $numeros[$i],
						'note' => $notes[$i],
						'absence' => $absences[$i]
					);
				}
			}else{
				$codes = $_POST['code'];
				$noms = $_POST['nom'];
				$notes = $_POST['note'];
				$absences = $_POST['absence'];
				
				for($i=0; $i<count($codes); $i++) {
					if($notes[$i] == "") $notes[$i] = false;
					if($absences[$i] == "---") $absences[$i] = false;
					$data[] = array(
						'code' => $codes[$i],
						'nom' => $noms[$i],
						'note' => $notes[$i],
						'absence' => $absences[$i]
					);
				}
			}
		
			$data = array(
				'anonymous' => $anonymous,
				'codeEpr' => $epr['codeApogee'],
				'notes' => $data
			);
			
			
			/*
			 * Au lieu d'enregistrer le JSON sur le serveur, il faudrait l'envoyer directement par mail
			 * Soit:
			 *   - Le mettre sur le serveur, l'envoyer et le supprimer après (le plus simple avec PHPMailer mais peut-être risqué ?)
			 *   - Trouver un moyen de l'envoyer sans le sauvegarder (possible ?????)
			 */
			$receive_json = './src/data/notes-epr/'.$epr['codeApogee'].'.json';
			if(!is_file($receive_json)) file_put_contents($receive_json, '');
			$fp = fopen($receive_json, 'w');
			if(fwrite($fp, json_encode($data))) {
				
				// Send mail
				$mail = new PHPMailer;
				$mail->SMTPAuth = true;
				$mail->CharSet = 'UTF-8';
				$mail->Host = PHPMAILER_SMTP_HOST;
				$mail->Port = PHPMAILER_SMTP_PORT;
				$mail->Username = PHPMAILER_USERNAME;
				$mail->Password = PHPMAILER_PASSWORD;
				$mail->SMTPSecure = PHPMAILER_SMTP_TYPE;
				$mail->setFrom(PHPMAILER_USERNAME, PHPMAILER_NAME);
				$mail->AddAddress(NOTES_RECEIVER_EMAIL);
				$mail->AddReplyTo(PHPMAILER_USERNAME, PHPMAILER_NAME);
				$mail->WordWrap = 50;
				
				// Attachment
				$json_new_filename = 'NOTES-'.$epr['codeApogee'].'-'.strtoupper(strftime('%d-%B-%Y'));
				$mail->AddAttachment($receive_json, $json_new_filename.'.json');

				// Content
				$mail->IsHTML(true);
				$mail->Subject = 'Des nouvelles notes viennent d\'être envoyées';
				$mail->Body = "Bonjour,<br /><br />
							Des nouvelles notes pour l'épreuve <b>".$epr['intitule']."</b> (code Apogée: ".$epr['codeApogee'].") viennent d'être envoyées par <b>XXX</b>. 
							Vous les trouverez en pièce jointe.<br /><br />
							Merci et bonne journée :-)";
				$mail->AltBody = "Bonjour ! Des nouvelles notes pour l'épreuve <b>".$epr['intitule']."</b> (code Apogée: ".$epr['codeApogee'].") viennent d'être envoyées par <b>XXX</b>. Vous les trouverez en pièce jointe. Merci et bonne journée :-)";

				if(!$mail->Send()) {
				   echo 'Message non envoyé. Erreur: '.$mail->ErrorInfo;
				   exit;
				}

				echo 'Les notes ont bien été envoyées au secrétariat.';
			}
			fclose($fp);
			
		}
	} else exit();
} else exit();

?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<title>Saisie de notes — IUT Laval</title>
		<link rel="stylesheet" href="src/css/app.css" />
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" href="/favicon.png" type="image/png">
	</head>
	
	<body>
		<main style="padding:20px">
			<form action="" method="post">
				<div style="color:red">Cette page, à destination des enseignants, permet de saisir les notes d'une épreuve. Elle va générer un fichier JSON qui sera envoyé par mail au secrétariat qui rentrera les notes sur le logiciel Apogée.</div>
				<h3><?php echo $epr['intitule']; ?> (épreuve <?php echo $epr['codeApogee']; ?>)</h3>
				<p>LP DIWA</p>
				 
				<input type="checkbox" id="anonymous" name="anonymous" /> 
				<label for="anonymous">Notes anonymes</label>
				<br /><br />
				
				
				<table class="normal-form">
					<tr>
						<th>Code étudiant</th>
						<th>Nom étudiant</th>
						<th><span title="Vous devez indiquer une note entre 0 et 20. Vous pouvez insérer jusqu'à deux chiffres après la virgule.">Note</span></th>
						<th><span title="En cas d'absence, indiquez ABJ si l'étudiant dispose d'un justificatif ou ABI s'il n'en possède pas.">Absence</span></th>
					</tr>
					
					<!-- Récupérer la liste des étudiants pour un groupe X -->
					<?php
					$notes = getNotes($epr['codeApogee']);
					foreach($notes as $n) {
					?>
					<tr>
						<td>
							<?php echo $n['code']; ?>
							<input type="hidden" name="code[]" value="<?php echo $n['code']; ?>" required="required" />
						</td>
						<td>
							<?php echo $n['nom']; ?>
							<input type="hidden" name="nom[]" value="<?php echo $n['nom']; ?>" required="required" />
						</td>
						<td>
							<input type="number" min="0" max="20" name="note[]" step="0.01" class="note" />
						</td>
						<td>
							<select class="absence" name="absence[]" required="required">
								<option value="---">---</option>
								<option value="ABJ">ABJ</option>
								<option value="ABI">ABI</option>
							</select>
						</td>
					</tr>
					<?php
					}
					?>
				</table>
				
				<table class="anonymous-form">
					<tr>
						<th>N° d'anonymat</th>
						<th><span title="Vous devez indiquer une note entre 0 et 20. Vous pouvez insérer jusqu'à deux chiffres après la virgule.">Note</span></th>
						<th><span title="En cas d'absence, indiquez ABJ si l'étudiant dispose d'un justificatif ou ABI s'il n'en possède pas.">Absence</span></th>
					</tr>
					
					<tr class="note-form">
						<td>
							<input type="number" min="0" name="anon-numero[]" step="1" class="numero" required="required" />
						</td>
						<td>
							<input type="number" min="0" max="20" name="anon-note[]" step="0.01" class="note" />
						</td>
						<td>
							<select class="absence" name="anon-absence[]" required="required">	
								<option value="---">---</option>
								<option value="ABJ">ABJ</option>
								<option value="ABI">ABI</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><input type="button" class="add-note" value="Ajouter une note" /></td>
					</tr>
				</table>
				
				<div style="margin-top:15px">
					<input type="submit" name="submit" onClick="return confirm('Voulez-vous vraiment envoyer les notes au secrétariat ?');" value="Envoyer les notes" />
				</div>
				
			</form>
		</main>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			(function(){
				$(document).on('change', '.absence', disableNote);
				function disableNote() {
					var note = $(this).closest('tr').find('.note');
					if($(this).val() != "---") note.val("0");
				}
				$('.absence').each(disableNote);
				
				$('.anonymous-form').hide();
				$('#anonymous').on('change', function(){
					var isChecked = $(this).prop("checked");
					if(isChecked == true) {
						$('.normal-form').hide();
						$('.anonymous-form').show();
					} else {
						$('.anonymous-form').hide();
						$('.normal-form').show();
					}
				});
				
				$('.add-note').on('click', function(e){
					e.preventDefault();
					var clone = $('tr.note-form').first().clone();
					clone.insertBefore('table.anonymous-form tr:last-child');
					var last = $('tr.note-form').last();
					last.find('.numero').val("");
					last.find('.note').val("").prop("disabled", null);
					last.find('.absence').val("---");
				});
			})();
		</script>
	</body>
</html>