// import * as React from "react";
// import {Mark} from "./../classes/mark";

// interface DisplayAverageProps {
	// marks:Mark[];
// }

// class DisplayAverageState {
	// constructor (props:DisplayAverageProps) {
		
	// }
// }

// export class DisplayAverage extends React.Component<DisplayAverageProps, DisplayAverageState> {
	// constructor (props:DisplayAverageProps) {
		// super(props);
		// this.state = new DisplayAverageState(props);
	// }
	
	// // Calcul de la moyenne selon le tableau de notes récupéré (depuis grid.tsx ou display_grid.tsx)
	// calculMoy () {
		// var marks = this.props.marks,
			// average = 0,
			// coefficients = 0;
		// for (var i = 0; i < marks.length; i++) {
			// // Si la ligne traitée n'est pas un module, on calcule la moyenne générale en prenant en compte les coefficients
			// if (marks[i].module != "" || marks[i].module) {
				// // Récupération du coefficient du module associé à la note et intégration dans le coefficient total
				// var relatedModule = marks.filter(m => m.label == marks[i].module),
					// additionalCoefficent = relatedModule[0] ? relatedModule[0].coefficient : 1,
					// value = marks[i].value * marks[i].coefficient * additionalCoefficent;
				// average += value;
				// coefficients += marks[i].coefficient * additionalCoefficent;
			// }
		// }
		// // Remplacement des "." par des "," (afficher 18,5 au lieu de 18.5) et suppression du dernier 0 si le résultat est de type xx,x0 (18,5 au lieu de 18,50)
		// var moy = (average /= coefficients).toString().replace(".", ","),
			// displayed = moy.substring(0, moy.indexOf(",") + 3);
		// return displayed.substring(displayed.length - 1) == "0" ? displayed.substring(0, displayed.length - 1) : displayed;
	// }
	
	// render () {
		// var average = this.calculMoy();
		// return (
			// <p>{average}</p>
		// )
	// }
// }