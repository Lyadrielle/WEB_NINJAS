import React, { Component } from 'react'
import DashboardBlock from '../DashBoardBlock'
import Skill from '../../components/Skill'

import './style.css'

class Dashboard extends Component {
  displaySkillsBlock() {
    console.log("dshbd competences")
    return <div><Skill/></div>
  }

  render () {
    return (
      <div className='dashboard-app'>
        <DashboardBlock title="Compétences" content={this.displaySkillsBlock()}/>

      </div>
    )
}
}

export default Dashboard
