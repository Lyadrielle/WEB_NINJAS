import React, { Component } from 'react'

import Menu from '../../components/Menu'
import DashboardBlock from '../DashBoardBlock'

import Needs from '../../components/Needs'
import NeedBar from '../../components/NeedBar'
import Mission from '../../components/Mission'
import Skill from '../../components/Skill'
import Inventory from '../../components/Inventory'

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
  displayNeedBlock() {
    const { level, experience } = levelMock

    return (
      <div className='need-block'>
        <div className='level'>
          <h5>{`Niv. ${level}`}</h5>
          <NeedBar percentage={experience} color='40D1D8'/>
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

  displayMissionBlock() {
    return (
      <div className = 'mission-block'>
        {missions.map((item, i) =>
          <div className="mission" key = {i}><Mission mission={item} /></div>
        )}
      </div>
    )
  }

  displaySkillsBlock() {
    return <React.Fragment><Skill/></React.Fragment>
  }

  displayInventoryBlock() {
    return <div className="inventory"><Inventory objects={data.ninja.inventory} /></div>
  }

  render() {
    return (
      <React.Fragment>
        <Menu pseudo="ROBERT"/>
        <div className='dashboard-app'>
          <DashboardBlock title="Besoins" content={this.displayNeedBlock()}/>
          <DashboardBlock title="Missions" content={this.displayMissionBlock()} />
          <DashboardBlock title="Compétences" content={this.displaySkillsBlock()}/>
          <DashboardBlock title="Inventaire" content={this.displayInventoryBlock()}/>
        </div>
      </React.Fragment>
    )
}
}

export default Dashboard
