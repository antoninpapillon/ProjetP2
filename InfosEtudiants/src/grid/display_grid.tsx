import * as React from "react";

interface DisplayGridProps {
	row:any;
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
	
	// Affiche le code si c'est un module ou une UE
	labelDisplay (row:any) {
		var type = this.rowType(row);
		if (type == "mark") return row.label;
		else return row.code + " - " + row.label;
	}
	
	// Assigne la classe de la ligne en fonction du type de donnée
	rowType (row:any) {
		if (row.hasOwnProperty('codeModule')) return "mark";
		else if (row.hasOwnProperty('codeUnit')) return "module";
		else return "unit";
	}
	
	render () {
		// Affichage de la ligne, en convertissant les chiffres en chaîne de caractère pour remplacer les "." par des "," (18,5 au lieu de 18.5)
		return (
			<tr className={this.rowType(this.props.row)}>
				<td>{this.labelDisplay(this.props.row)}</td>
				<td>{this.props.row.coefficient.toString().replace(".", ",")}</td>
				<td className="nosp"></td>
				<td className="nosp"></td>
				<td className="nosp"></td>
				<td>{this.props.row.value}</td>
				<td className="nosp"></td>
			</tr>
		)
	}
}