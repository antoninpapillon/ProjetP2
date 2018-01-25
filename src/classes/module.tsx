import {Control} from "./control";

export class Module extends Control {
	codeUnit:string;
	optional:boolean;
	value:number;
	
	constructor(code:string, coefficient:number, label:string, codeUnit:string, optional:boolean, value:number) {
		super(code, coefficient, label);
		this.codeUnit = codeUnit;
		this.optional = optional;
		this.value = value;
	}
}