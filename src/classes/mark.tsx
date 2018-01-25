import {Control} from "./control";

export class Mark extends Control {
	codeModule:string;
	optional:boolean;
	teacher:string;
	type:string;
	value:number;
	
	constructor(code:string, coefficient:number, label:string, codeModule:string, optional:boolean, teacher:string, type:string, value:number) {
		super(code, coefficient, label);
		this.codeModule = codeModule;
		this.optional = optional;
		this.teacher = teacher;
		this.type = type;
		this.value = value;
	}
}