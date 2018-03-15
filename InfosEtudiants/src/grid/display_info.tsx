import * as React from "react";

interface DisplayInfoProps {
	row:any;
}

class DisplayInfoState {
	constructor (props:DisplayInfoProps) {
		
	}
}

export class DisplayInfo extends React.Component<DisplayInfoProps, DisplayInfoState> {
	constructor (props:DisplayInfoProps) {
		super(props);
		this.state = new DisplayInfoState(props);
	}
	
	render () {
		// Affichage de la ligne, en convertissant les chiffres en chaîne de caractère pour remplacer les "." par des "," (18,5 au lieu de 18.5)
		return (
			<div className="block">
                <div className="flex"> <div className="flex1"> Code : </div> <div className="flex2"> {this.props.row.code.toString()}</div></div>
                <div className="flex"> <div className="flex1"> Bac : </div> <div className="flex2"> {this.props.row.bac.toString()}</div></div>
                <div className="flex"> <div className="flex1"> Nom : </div> <div className="flex2"> {this.props.row.nom.toString()}</div></div>
                <div className="flex"> <div className="flex1"> Prénom : </div> <div className="flex2"> {this.props.row.prenom.toString()}</div></div>
                <div className="flex"> <div className="flex1"> Option : </div> <div className="flex2"> {this.props.row.option.toString()}</div></div>
                <div className="flex"> <div className="flex1"> Alternant : </div> <div className="flex2"> {this.props.row.alternant.toString()}</div></div>
                <div className="flex"> <div className="flex1"> LV2 : </div> <div className="flex2"> {this.props.row.lv2.toString()}</div></div>
			</div>
		)
	}
}