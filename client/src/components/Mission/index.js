import React, { Component } from 'react'

import './style.css'
import CupsMissionsLevel from '../CupsMissionsLevel'
import CircularMeasure from '../CircularMeasure'
import Button from '../Button'

class Mission extends Component {
  constructor(props) {
    super(props)
    this.state = {
      status:this.props.mission.status,
      title: this.props.mission.title,
      description: this.props.mission.description,
      level: this.props.mission.level,
      measure: this.props.mission.measure,
    }
  }
  render () {
    
    return (
      <div>
         <div>
           <h5>{ this.state.title }</h5>
           <p>{ this.state.description }</p>
         </div>
         {this.state.status? <CircularMeasure color="orange" measure ={this.state.measure}/> : <Button title = "Accepter"/>}
      </div>
    )
  }
}

export default Mission