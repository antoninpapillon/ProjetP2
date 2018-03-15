export class Info {
	code:string;
	bac:string;
	nom:string;
	prenom:string;
    option:string;
	alternant:boolean;
	lv2:string;
	constructor (code:string, bac:string, nom:string, prenom:string, option:string, alternant: boolean, lv2:string) {
		this.code = code;
		this.bac = bac;
		this.nom = nom;
		this.prenom = prenom;
        this.option = option;
        this.alternant = alternant;
        this.lv2 = lv2;
	}
}