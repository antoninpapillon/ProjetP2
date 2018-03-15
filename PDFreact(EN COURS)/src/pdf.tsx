import "./index.html";
import * as React from "react";
import * as ReactDom from "react-dom";
import { Document, Page } from 'react-pdf';
import * as PDFDocument from 'pdfkit';
interface PdfAppProps {
    
}

class PdfAppState{
    constructor(props:PdfAppProps){
        
    }
    
    
}

export class PdfApp extends React.Component<BoatAppProps,BoatAppState>{
 constructor(props:PdfAppProps){
        //appel constructeur parent
        super(props);
        //création d'un nouvel état
        this.state = new PdfAppState(props);
     }
    
    genererPDf(){
     var doc = new PDFDocument();
     //doc.write 'output.pdf';    

     doc.end();
        
    }
    
    render(){
        return (
            <div>
               <button onClick={()=>this.genererPDf()}>Générer PDF</button>
            </div>
         )
     }
}

ReactDom.render(<PdfApp/>, document.getElementById("app"));

