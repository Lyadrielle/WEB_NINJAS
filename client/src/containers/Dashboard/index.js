import React, { Component } from 'react'
import DashboardBlock from '../DashBoardBlock'
import Menu from '../Menu'
import Skill from '../../components/Skill'
import Mission from '../../components/Mission'
import Inventory from '../../components/Inventory'
import Needs from '../../components/Needs'
import NeedBar from '../../components/NeedBar'
import Button from '../../components/Button'

import './style.css'
import * as missions from './missions.json'
import * as data from '../../data.json'
const needsMock = {
  "hunger": {
    value: 5,
    action: "eat",
  },
  "energy": {
    value: 100,
    action: "sleep",
  },
  "social": {
    value: 75,
    action: "talk",
  },
}

const levelMock = {
  "level": 999,
  "experience": 37,
}

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

  displayNeedBlock() {
    const { level, experience } = levelMock

    return (
      <div className='need-block'>
        <div className='level'>
          <h5>{`level ${level}`}</h5>
          <NeedBar percentage={experience} color='8e8e8e'/>
        </div>

        <Needs needs = {needsMock}/>

        <div className = 'actions'>
          {Object.entries(needsMock).map(([label, need]) => {
            const { action } = need

            return (
              <Button
                title = {action}
                image = {`./images/needs/${label}.png`}
                callback={() => {
                  alert(`Your ninja is ${action}ing`)
                }}
              />
            )
          })}
        </div>
      </div>
    )
  }

  render() {
    return (
      <React.Fragment>
        <Menu pseudo="ROBERT"/>
        <div className='dashboard-app'>
        <DashboardBlock title="needs" content={this.displayNeedBlock()}/>
          <DashboardBlock title="Missions" content={this.displayMissionBlock()} />
          <DashboardBlock title="Compétences" content={this.displaySkillsBlock()}/>
        <DashboardBlock title="Inventaire" content={this.displayInventoryBlock()}/>
        </div>
      </React.Fragment>
    )
}
}

export default Dashboard
