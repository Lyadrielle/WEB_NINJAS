import React, { Component } from 'react'

import './style.css'
import CupsMissionsLevel from '../CupsMissionsLevel'
import CircularMeasure from '../CircularMeasure'
import Button from '../Button'

class Mission extends Component {
  constructor(props) {
    super(props)
    this.acceptMission = this.acceptMission.bind(this)
    this.callBackEndOfMission = this.callBackEndOfMission.bind(this)
  }

  acceptMission() {
    console.log("Hello bro I accept the mission")
    /* Faire un call API pour passer la mission à Pending */
  }

  callBackEndOfMission() {
    /*Fonction pas forcément utile vu que c'est le back qui change les status des missions */
  }

  render () {
    const { status, title, description, level } = this.props.mission;
    return (
      <div className='mission'>
        <CupsMissionsLevel level = {level} />
         <div>
           <h4>{ title }</h4>
           <p className='mission-description'>{ description }</p>
         </div>
         {status? <CircularMeasure callBackEnd = { this.callBackEndOfMission } /> : <Button callBack = {this.acceptMission} title = "ACCEPTER"/>}
      </div>
    )
  }
}

export default Mission
