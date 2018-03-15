<?php
session_start();
require __DIR__.'/vendor/autoload.php';

$content = "<table style=\"color: #263a7a; font-size:16px; border: 2px solid #263a7a; border-radius:25px; padding: 12px; \">
						<thead>
							<tr>
								<th style=\"background: #e6007e;color: #fcfdff; font-family: \"Verdana\";\">Matière</th>
								<th style=\"background: #e6007e;color: #fcfdff; font-family: \"Verdana\";\">Coefficient </th>
								<th style=\"background: #e6007e;color: #fcfdff; font-family: \"Verdana\";\">Note </th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td></td>
								<td></td>
							</tr> ";
							
$file_json = file_get_contents("mmi1s2.json");
		$json_a = json_decode($file_json, true);
		
		foreach ($json_a['UE'] as $value) {
			if ($value['module']){
				foreach ($value['module'] as $value) {
					$content.= "<tr>";
						$content.= '<td>' . $value['intitule'] .' </td> <td> '.$value['coeff']. '</td>';
						$row = 1;
                		if (($handle = fopen("mmi1s2elp-2.csv", "r")) !== FALSE) {
                			while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                				$num = count($data);
                				$row++;
                				if ($data[0] == '20160001')
                				{
                				    if ($data[3] == $value['codeApogee'])
                				    {
															$content.= '<td>' . $data[4] . " </td>";
                    				
                				    }
                				}
                			}
                			fclose($handle);
                		}
					$content .= "</tr>";
				}
			}
		}

$content.= "</tbody>
					</table>";
	
use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf();
$html2pdf->writeHTML('
  <div style="border-bottom: 2px solid #e6007e; color: #263a7a; ">
    <h1 style="text-align=center;">Bulletin du 04/12/2017</h1>
    <h2>Nom Prénom</h2>
  </div>
  <br/>
');
$html2pdf->writeHTML($content);

$html2pdf->writeHTML('

');
$html2pdf->writeHTML('<div style="text-align: center; padding-top: 20px; color: #263a7a;">
							Avertissement : ce document n\'a aucun caractère officiel, il vous est fourni seulement à titre informatif.
					</div>');

$html2pdf->output();

exit();

?>
