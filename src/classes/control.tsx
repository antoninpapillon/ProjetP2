export class Control {
	code:string;
	coefficient:number;
	label:string;
	
	constructor (code:string, coefficient:number, label:string) {
		this.code = code;
		this.coefficient = coefficient;
		this.label = label;
	}
}