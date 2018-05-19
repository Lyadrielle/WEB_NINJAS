import React, { Component } from 'react'

import Menu from '../../components/Menu'
import DashboardBlock from '../DashBoardBlock'

import Needs from '../../components/Needs'
import NeedBar from '../../components/NeedBar'
import Mission from '../../components/Mission'
import Skill from '../../components/Skill'
import Inventory from '../../components/Inventory'
import Button from '../../components/Button'

import api from '../../common/api'

import './style.css'

class Dashboard extends Component {
  state = {}

  displayNeedBlock = () => {
    const { needs = {} } = this.state
    const { level, experience, experienceMax, ...needsProps } = needs

    const actionsNamingMap = {
      eat: 'manger',
      sleep: 'dormir',
      talk: 'bavarder'
    }

    return (
      <div className='need-block'>
        <div className='level'>
          <h5>{`Niv. ${level}`}</h5>
          <NeedBar percentage={ (experience/experienceMax) * 100 } color='40D1D8'/>
        </div>

        <Needs needs = {needsProps}/>

        <div className = 'actions'>
          {Object.entries(needsProps).map(([label, need]) => {
            const { action } = need

            return (
              <Button key={label}
                title = {actionsNamingMap[action]}
                image = {`./images/needs/${label}.png`}
                callBack= {() => alert(`Your ninja is ${action}ing`)}
              />
            )
          })}
        </div>
      </div>
    )
  }

  displayMissionBlock = () =>  {
    const { missions = [] } = this.state
    return (
      <div className = 'mission-block'>
        {missions.map((item, i) =>
          <div className="mission" key = {i}><Mission mission={item} /></div>
        )}
      </div>
    )
  }

  displaySkillsBlock = () =>  {
    const { skills = {} } = this.state
    return <React.Fragment><Skill skills={skills} /></React.Fragment>
  }

  displayInventoryBlock = () =>  {
    const { inventory = [] } = this.state
    return <div className="inventory"><Inventory objects={inventory} /></div>
  }

  update = async () => {
    const {
      ninja: {
        needs,
        skills,
        inventory,
        experience,
        experienceMax,
        level,
      },
      missions,
    } = await api.ninja()
    this.setState({
      needs: {
        ...needs,
        experience,
        experienceMax,
        level,
      },
      missions,
      skills,
      inventory
    })
  }

  autoUpdate = () => {
    this.update()
      .then(() => setTimeout(this.autoUpdate, 2000))
      .catch(() => window.location.reload())
  }

  componentDidMount = async () => {
    this.autoUpdate()
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
