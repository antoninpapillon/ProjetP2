import React, { Component } from 'react'
import axios from 'axios'

class MccForm extends Component {
    constructor(props) {
        super(props)
        this.state = {
            codeApogee: this.props.mcc.codeApogee
        }
    }
    
    handleInput = (e) => {
        this.setState({[e.target.name]: e.target.value})
    }
    
    handleBlur = () => {
      const mcc = {
        codeApogee: this.state.codeApogee,
      }

      axios.put(
        `http://localhost:3001/api/v1/mcc/${this.props.mcc.codeApogee}`,
        {
          mcc: mcc
        })
      .then(response => {
        console.log(response)
      })
      .catch(error => console.log(error))
    }

    render() {
        return (
          <div className="mcc">
            <form onBlur={this.handleBlur} >
                <label htmlFor="codeApogee">Code Apogée</label>
                <input type="text" name="codeApogee" onChange={this.handleInput}/>
            </form>
          </div>
        );
    }
}

export default MccForm