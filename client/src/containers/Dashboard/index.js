import React, { Component } from 'react'

import DashboardBlock from '../DashBoardBlock'
import Mission from '../../components/Mission'
import './style.css'

import * as missions from './missions.json'

class Dashboard extends Component {
  displayMissionBlock() {
    console.log("dshbd miss")
    return  missions.map((item,i) => {
      if(i === missions.length - 1) {
        return <div><Mission mission = { item }/></div>
      }
      else {
        return <div style = {
          {borderBottom:'solid', borderColor:'#f26c4f'}
        }><Mission mission = { item }/></div>
      }
    })
  }

  render () {
    return (
      <div className='dashboard-app'>
        <DashboardBlock title="Missions" content={this.displayMissionBlock()}/>
        
      </div>
    )
  }
}

export default Dashboard