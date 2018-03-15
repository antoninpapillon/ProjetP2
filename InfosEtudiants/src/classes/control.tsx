export class Control {
	code:string;
	coefficient:number;
	label:string;
	value:number;
	
	constructor (code:string, coefficient:number, label:string, value:number) {
		this.code = code;
		this.coefficient = coefficient;
		this.label = label;
		this.value = value;
	}
}