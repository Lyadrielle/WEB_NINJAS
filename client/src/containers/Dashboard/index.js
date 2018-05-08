import React, { Component } from 'react'

import DashboardBlock from '../DashBoardBlock'
import Mission from '../../components/Mission'
import './style.css'

import * as missions from './missions.json'

class Dashboard extends Component {
  /*On peut simplifier grâce au Css en passant une classe à mission*/

  displayMissionBlock() {
    console.log("dshbd miss")
    return missions.map((item, i) =>
      <div className="mission"><Mission mission={item} /></div>
    )
  }

  render() {
    return (
      <div className='dashboard-app'>
        <DashboardBlock title="Missions" content={this.displayMissionBlock()} />

      </div>
    )
  }
}

export default Dashboard