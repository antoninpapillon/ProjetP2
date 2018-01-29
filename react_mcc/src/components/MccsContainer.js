import React, { Component } from 'react'
import axios from 'axios'
import update from 'immutability-helper'
import MccForm from './MccForm'

class MccsContainer extends Component {
    
    constructor(props) {
        super(props)
        this.state = {
            mccs: [],
            editingMCC: null
        }
    }
    
    componentDidMount() {
      axios.get('http://localhost:3001/api/v1/mcc.json')
      .then(response => {
        console.log(response)
        this.setState({mccs: response.data})
      })
      .catch(error => console.log(error))
    }
    
    addNewMCC = () => {
      axios.post(
        'http://localhost:3001/api/v1/mcc',
          {
            nomPromo: '',
            codeApogee: '',
            semestre: '',
            coeff: '',
            urlNotes: ''
          }
      )
      .then(response => {
        console.log(response)
        const mccs = update(this.state.mccs, {
          $splice: [[0, 0, response.data]]
        })
        this.setState({
            mccs: mccs,
            editingMCC: response.data.codeApogee
        })
      })
      .catch(error => console.log(error))
        
           
    }
    
    render() {
        return (
          <div>
            <button className="newMccButton" onClick={this.addNewMCC} >
                    Ajouter MCC
            </button>
            {
                this.state.mccs.map((mcc) => {
                    
                    if(this.state.editingMCC === mcc.codeApogee) {
                        return(
                            <MccForm mcc={mcc} key={mcc.codeApogee} />
                        )
                    } else {
                    
                        return(
                            <div className="mcc" mcc={mcc} key={mcc.codeApogee}>
                                <p>Nom de la promo :{ mcc.nomPromo }</p>
                                <p>Code Apogée : { mcc.codeApogee }</p>
                                <p>Semestre : { mcc.semestre }</p>
                                <p>Coefficient : { mcc.coeff }</p>
                                <p>Url des notes : { mcc.urlNotes }</p>
                            </div>
                            
                        )
                    }
                    
                })
            }
          </div>
        )
    }
}

export default MccsContainer