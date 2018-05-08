import React, { Component } from 'react'
import DashboardBlock from '../DashBoardBlock'
import Menu from '../Menu'
import Skill from '../../components/Skill'
import Mission from '../../components/Mission'

import './style.css'
import * as missions from './missions.json'

class Dashboard extends Component {



  displaySkillsBlock() {
    console.log("dshbd competences")
    return <div><Skill/></div>
  }

  displayMissionBlock() {
    console.log("dshbd miss")
    return missions.map((item, i) =>
      <div className="mission"><Mission mission={item} /></div>
    )
  }

  render() {
    return (
      <React.Fragment>
        <Menu pseudo="ROBERT"/>
        <div className='dashboard-app'>
          <DashboardBlock title="Missions" content={this.displayMissionBlock()} />
          <DashboardBlock title="Compétences" content={this.displaySkillsBlock()}/>
        </div>
      </React.Fragment>
    )
}
}

export default Dashboard
