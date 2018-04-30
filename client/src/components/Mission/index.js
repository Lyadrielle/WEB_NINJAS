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
      <div className='mission'>
        <CupsMissionsLevel level = {this.state.level} />
         <div>
           <h4>{ this.state.title }</h4>
           <p className='mission-description'>{ this.state.description }</p>
         </div>
         {this.state.status? <CircularMeasure color="orange" measure ={this.state.measure}/> : <Button title = "ACCEPTER"/>}
      </div>
    )
  }
}

export default Mission