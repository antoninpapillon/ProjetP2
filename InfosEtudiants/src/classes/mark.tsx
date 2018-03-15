import {Control} from "./control";

export class Mark extends Control {
	codeModule:string;
	optional:boolean;
	teacher:string;
	type:string;
	
	constructor(code:string, coefficient:number, label:string, value:number, codeModule:string, optional:boolean, teacher:string, type:string) {
		super(code, coefficient, label, value);
		this.codeModule = codeModule;
		this.optional = optional;
		this.teacher = teacher;
		this.type = type;
	}
}