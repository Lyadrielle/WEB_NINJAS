import React, { Component } from 'react'

import './style.css'
import CupsMissionsLevel from '../CupsMissionsLevel'
import CircularMeasure from '../CircularMeasure'
import Button from '../Button'

class Mission extends Component {
  constructor(props) {
    super(props)
    this.acceptMission = this.acceptMission.bind(this)
    this.state = {
      status:this.props.mission.status,
      title: this.props.mission.title,
      description: this.props.mission.description,
      level: this.props.mission.level,
      measure: this.props.mission.measure,
    }
  }

  acceptMission() {
    console.log("Hello bro I accept the mission")
    this.setState({status: true})
  }

  render () {
    return (
      <div className='mission'>
        <CupsMissionsLevel level = {this.state.level} />
         <div>
           <h4>{ this.state.title }</h4>
           <p className='mission-description'>{ this.state.description }</p>
         </div>
         {this.state.status? <p>Jauge</p> : <Button callBack = {this.acceptMission} title = "ACCEPTER"/>}
      </div>
    )
  }
}

export default Mission