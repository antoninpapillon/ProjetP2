import "./../index.html";
import * as React from "react";
import * as ReactDom from "react-dom";
import {DisplayGrid} from "./display_grid";
import {DisplayAverage} from "./display_average";
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
	rows:any[] = [];
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
				codeUnit:"ue2",
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
			rows:[this.state.units,this.state.modules,this.state.marks]
		});
	}
	
	render () {
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
								<th>Note</th>
							</tr>
						</thead>
						<tbody>
						{
							this.state.marks && this.state.marks.map((mark)=>{
								// Pour chaque note dans la liste de notes, ajout d'une ligne dans la grille avec les valeurs de la note
								return (
									<DisplayGrid mark={mark} marks={this.state.marks} key={mark.code}/>
								)
							})
						}
						</tbody>
					</table>
					<div className="moy">
						<p>Moyenne générale</p>
						<DisplayAverage marks={this.state.marks} key="average"/>
					</div>
				</div>
			</div>
		)
	}
}

// Intégration de la grille dans la section d'id #grid
ReactDom.render(<Grid/>, document.getElementById("grid"));