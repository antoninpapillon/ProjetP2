import {Control} from "./control";

export class Unit extends Control {
	constructor(code:string, coefficient:number, label:string, value:number) {
		super(code, coefficient, label, value);
	}
}