import "./../index.html";
import * as React from "react";
import * as ReactDom from "react-dom";
import {DisplayGrid} from "./display_grid";
import {DisplayInfo} from "./display_info";
import {Info} from "./../classes/info";

interface InfoProps {
	
}

class InfoState {
	constructor (props:InfoProps) {
		
	}
	infos:Info[] = [];
}

export class InfoEleves extends React.Component<InfoProps, InfoState> {
	constructor (props:InfoProps) {
		super(props);
		this.state = new InfoState(props);
	}
	
	// Chargement des données en dur pour le moment, les données JSON seront importées d'ici ultérieurement
	componentDidMount () {
		this.setState({
			infos:[({
				code:"056558",
				bac:"S",
				nom:"Dupont",
				prenom:"Jean",
				option:"Sport",
				alternant:false,
                lv2:"Espagnol"
			})],
		});
	}
	
	// Ajout des UE suivies des modules associés, eux-mêmes suivis des épreuves associées
	// Cependant les épreuves ne sont pas triées au sein des modules, et les modules ne sont pas triés au sein des UE, elles-mêmes non triées
	// (Les lignes s'ajoutent dans l'ordre où elles arrivent)
	// Exemple : ue1 module3 epreuve3 epreuve2 module2 epreuve1 ue3 ... (mais les épreuves au sein des modules sont bien celles du module et les modules au sein des UE appartiennent bien à l'UE)
	buildRows (infos:Info[]) {
		var j = 0, rows = [];
		for (var u = 0; u < infos.length; u++) {
			rows[j] = new Info(infos[u].code, infos[u].bac, infos[u].nom, infos[u].prenom, infos[u].option, infos[u].alternant, infos[u].lv2);
			j++;
		}
		return rows;
	}	
	render () {
		var rows = this.buildRows(this.state.infos);
		return (
				<div>
					<div>
					<img src="" alt=""/>
					<h2>Informations</h2>
				</div>              
						{
							rows && rows.map((row)=>{
								// Pour chaque note dans la liste de notes, ajout d'une ligne dans la grille avec les valeurs de la note
								return (
									<DisplayInfo row={row} key={row.code}/>
								)
							})
						}
				</div>
		)
	}
}

ReactDom.render(<InfoEleves/>, document.getElementById("infos"));