import "./../index.html";
import * as React from "react";
import * as ReactDom from "react-dom";
import {DisplayGrid} from "./display_grid";
import {Mark} from "./../classes/mark";
import {Module} from "./../classes/module";
import {Unit} from "./../classes/unit";

interface GridProps {
	
}

class GridState {
	constructor (props:GridProps) {
		
	}
	units:Unit[] = [];
	modules:Module[] = [];
	marks:Mark[] = [];
	average:number = undefined;
}

export class Grid extends React.Component<GridProps, GridState> {
	constructor (props:GridProps) {
		super(props);
		this.state = new GridState(props);
	}
	
	// Chargement des données en dur pour le moment, les données JSON seront importées d'ici ultérieurement
	componentDidMount () {
		this.setState({
			units:[({
				code:"ue1",
				coefficient:12,
				label:"Technologies web",
				value:0
			}),({
				code:"ue2",
				coefficient:15,
				label:"Outils de communication",
				value:0
			})],
			modules:[({
				code:"module1",
				coefficient:6,
				label:"Programmation",
				codeUnit:"ue1",
				optional:false,
				value:0
			}),({
				code:"module2",
				coefficient:5,
				label:"Web design",
				codeUnit:"ue1",
				optional:false,
				value:0
			}),({
				code:"module3",
				coefficient:5,
				label:"UX design",
				codeUnit:"module2",
				optional:false,
				value:0
			})],
			marks:[({
				code:"mark1",
				coefficient:2,
				label:"PHP Symfony",
				codeModule:"module1",
				optional:false,
				teacher:"Jérémie Libeau",
				type:"Pratique",
				value:8
			}),({
				code:"mark2",
				coefficient:4,
				label:"Ruby On Rails",
				codeModule:"module1",
				optional:false,
				teacher:"Martino Bettucci",
				type:"Pratique",
				value:10
			}),({
				code:"mark3",
				coefficient:2,
				label:"Maquettage",
				codeModule:"module2",
				optional:true,
				teacher:"Jean-Christophe Habault",
				type:"Pratique",
				value:12
			}),({
				code:"mark4",
				coefficient:5,
				label:"Programmation client",
				codeModule:"module2",
				optional:false,
				teacher:"Anne-Marie Puizilliout",
				type:"Pratique",
				value:19.5
			}),({
				code:"mark5",
				coefficient:1.5,
				label:"Interfaces Homme-Machine",
				codeModule:"module3",
				optional:false,
				teacher:"Vincent Bettenfeld",
				type:"Théorique",
				value:5.5
			})],
			average:15
		});
	}
	
	// Ajout des UE suivies des modules associés, eux-mêmes suivis des épreuves associées
	// Cependant les épreuves ne sont pas triées au sein des modules, et les modules ne sont pas triés au sein des UE, elles-mêmes non triées
	// (Les lignes s'ajoutent dans l'ordre où elles arrivent)
	// Exemple : ue1 module3 epreuve3 epreuve2 module2 epreuve1 ue3 ... (mais les épreuves au sein des modules sont bien celles du module et les modules au sein des UE appartiennent bien à l'UE)
	buildRows (units:Unit[], modules:Module[], marks:Mark[]) {
		var j = 0, rows = [];
		for (var u = 0; u < units.length; u++) {
			rows[j] = new Unit(units[u].code, units[u].coefficient, units[u].label, units[u].value);
			j++;
			for (var m = 0; m < modules.length; m++) {
				if (modules[m].codeUnit == units[u].code) {
					rows[j] = new Module(modules[m].code, modules[m].coefficient, modules[m].label, modules[m].value, modules[m].codeUnit, modules[m].optional);
					j++;
					for (var c = 0; c < marks.length; c++) {
						if (marks[c].codeModule == modules[m].code) {
							rows[j] = new Mark(marks[c].code, marks[c].coefficient, marks[c].label, marks[c].value, marks[c].codeModule, marks[c].optional, marks[c].teacher, marks[c].type);
							j++;
						}
					}
				}
				// Cas d'un sous-module
				else {
					for (var n = 0; n < modules.length; n++) {
						if (modules[n].codeUnit == modules[m].code) {
							rows[j] = new Module(modules[n].code, modules[n].coefficient, modules[n].label, modules[n].value, modules[n].codeUnit, modules[n].optional);
							j++;
							for (var c = 0; c < marks.length; c++) {
								if (marks[c].codeModule == modules[n].code) {
									rows[j] = new Mark(marks[c].code, marks[c].coefficient, marks[c].label, marks[c].value, marks[c].codeModule, marks[c].optional, marks[c].teacher, marks[c].type);
									j++;
								}
							}
						}
					}
				}
			}
		}
		return rows;
	}
	
	render () {
		var rows = this.buildRows(this.state.units, this.state.modules, this.state.marks);
		return (
			<div>
				<div>
					<img src="" alt=""/>
					<h2>Mes résultats</h2>
				</div>
				<div>
					<table>
						<thead>
							<tr>
								<th>Intitulé</th>
								<th>Coefficient</th>
								<th className="nosp">Min.</th>
								<th className="nosp">Moy. classe</th>
								<th className="nosp">Max.</th>
								<th>Note</th>
								<th className="nosp">Rank</th>
							</tr>
						</thead>
						<tbody>
						{
							rows && rows.map((row)=>{
								// Pour chaque note dans la liste de notes, ajout d'une ligne dans la grille avec les valeurs de la note
								return (
									<DisplayGrid row={row} key={row.code}/>
								)
							})
						}
						</tbody>
					</table>
					<div className="moy">
						<p>Moyenne générale</p>
						<p>{this.state.average}</p>
					</div>
				</div>
			</div>
		)
	}
}

// Intégration de la grille dans la section d'id #grid
ReactDom.render(<Grid/>, document.getElementById("grid"));