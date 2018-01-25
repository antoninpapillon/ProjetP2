import {Control} from "./control";

export class Unit extends Control {
	value:number;
	
	constructor(code:string, coefficient:number, label:string, value:number) {
		super(code, coefficient, label);
		this.value = value;
	}
}