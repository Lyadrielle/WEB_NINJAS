import React, { Component } from 'react'

import './style.css'
import CupsMissionsLevel from '../CupsMissionsLevel'
import CircularMeasure from '../CircularMeasure'
import Button from '../Button'
import api from '../../common/api'

class Mission extends Component {
  constructor(props) {
    super(props)
    this.state = {

    }
  }

  acceptMission = async missionLabel => {
    const { endDate, success } = await api.mission(missionLabel)
    if (!success) {
      window.location.reload()
    }
    this.setState({
      startActionDate: Date.now(),
      currentMission: {
        label: 'mission',
        endDate: new Date(endDate),
        title: missionLabel,
      }
    })
  }

  render () {

    const { mission: { status, title, description, level, id }, currentAction } = this.props;
    let endTime = 0
    let elapsedTime = 0
    let totalTime = 0
    let percent = 0
    if (status === "1") {
      endTime = this.props.currentAction.endDate.getTime()
      elapsedTime = Date.now() - this.state.startActionDate
      totalTime = endTime - this.state.startActionDate
      percent = (elapsedTime / totalTime) * 100
    }
    
    return (
      <div className='mission'>
        <CupsMissionsLevel level = {level} />
         <div>
           <h5>{ title }</h5>
           <p className='mission-description'>{ description }</p>
         </div>
          { status === "1" ?
              <CircularMeasure percent = {percent} callBackEnd = { this.callBackEndOfMission } />
             : <Button callBack = {() => { this.acceptMission(id) }} title = "ACCEPTER" disabled={!!currentAction}/>
          }
      </div>
    )
  }
}

export default Mission
