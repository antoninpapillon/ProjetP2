import * as React from "react";
import {Mark} from "./../classes/mark";
import {DisplayAverage} from "./display_average";

interface DisplayGridProps {
	mark:Mark;
	marks:Mark[];
}

class DisplayGridState {
	constructor (props:DisplayGridProps) {
		
	}
}

export class DisplayGrid extends React.Component<DisplayGridProps, DisplayGridState> {
	constructor (props:DisplayGridProps) {
		super(props);
		this.state = new DisplayGridState(props);
	}
	
	// Change la classe de la ligne dans le tableau selon qu'elle contient un module ou une épreuve
	assignClassName (mark:Mark) {
		// Syntaxe : (condition) ? (réponse si condition bonne) : (réponse si condition fausse)
		return this.isModule(mark) ? "module" : "test";
	}
	
	// Différent retour selon la nature de la ligne (module => moyenne || épreuve => note)
	displayMark (mark:Mark, marks:Mark[]) {
		var displayed = this.isModule(mark) ? marks.filter(m => m.module == mark.label) : [mark];
		return (
			<DisplayAverage marks={displayed} key={mark.code}/>
		)
	}
	
	// Retourne true si mark.module est vide ou non défini, false sinon
	isModule (mark:Mark) {
		return mark.module == "" || !mark.module;
	}
	
	// Affiche le code si c'est un module
	labelDisplay (mark:Mark) {
		return this.isModule(mark) ? mark.code + " - " + mark.label : mark.label;
	}
	
	render () {
		// Affichage de la ligne, en convertissant les chiffres en chaîne de caractère pour remplacer les "." par des "," (18,5 au lieu de 18.5)
		return (
			<tr className={this.assignClassName(this.props.mark)}>
				<td>{this.labelDisplay(this.props.mark)}</td>
				<td>{this.props.mark.coefficient.toString().replace(".", ",")}</td>
				<td>{this.displayMark(this.props.mark,this.props.marks)}</td>
			</tr>
		)
	}
}