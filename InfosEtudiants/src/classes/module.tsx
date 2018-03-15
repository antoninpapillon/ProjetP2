import {Control} from "./control";

export class Module extends Control {
	codeUnit:string;
	optional:boolean;
	
	constructor(code:string, coefficient:number, label:string, value:number, codeUnit:string, optional:boolean) {
		super(code, coefficient, label, value);
		this.codeUnit = codeUnit;
		this.optional = optional;
	}
}