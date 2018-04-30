import React, { Component } from 'react'

import DashboardBlock from '../DashBoardBlock'
import Mission from '../../components/Mission'
import './style.css'

import * as missions from './missions.json'

class Dashboard extends Component {
  displayMissionBlock() {

    console.log("dshbd miss")
    return  missions.map((item,i) => {
      return <Mission mission = { item }/>
    })
  }

  render () {
    return (
      <div className='dashboard-app'>
        <DashboardBlock title="Mes missions" content={this.displayMissionBlock()}/>
      </div>
    )
  }
}

export default Dashboard