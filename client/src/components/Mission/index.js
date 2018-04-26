import React, { Component } from 'react'

import './style.css'
import CupsMissionsLevel from '../CupsMissionsLevel'
import CircularMeasure from '../CircularMeasure'
import Button from '../Button'

class Mission extends Component {
  constructor(props) {
    super(props)
    this.state = {
      status:props.mission.status,
      title: props.mission.title,
      description: props.mission.description,
      level: props.mission.level,
      measure: props.mission.measure,
    }
  }
  render () {
    return (
      <div>
         <CupsMissionsLevel level={this.state.level}/>
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