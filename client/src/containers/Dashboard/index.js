import React, { Component } from 'react'
import DashboardBlock from '../DashBoardBlock'
import Skill from '../../components/Skill'
import Mission from '../../components/Mission'
import Inventory from '../../components/Inventory'

import './style.css'
import * as missions from './missions.json'
import * as data from '../../data.json'
class Dashboard extends Component {
  displaySkillsBlock() {
    return <div><Skill/></div>
  }

  displayMissionBlock() {
    return missions.map((item, i) =>
      <div className="mission" key = {i}><Mission mission={item} /></div>
    )
  }

  displayInventoryBlock() {
    console.log("dshbd Inventory")
    return <div className="inventory"><Inventory objects={data.ninja.inventory} /></div>
  }

  render() {
    return (
      <div className='dashboard-app'>
        <DashboardBlock title="Missions" content={this.displayMissionBlock()} />
        <DashboardBlock title="Compétences" content={this.displaySkillsBlock()}/>
        <DashboardBlock title="Inventaire" content={this.displayInventoryBlock()}/>

      </div>
    )
}
}

export default Dashboard
