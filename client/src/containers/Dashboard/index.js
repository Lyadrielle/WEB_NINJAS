import React, { Component } from 'react'

import Menu from '../../components/Menu'
import DashboardBlock from '../DashBoardBlock'

import Needs from '../../components/Needs'
import NeedBar from '../../components/NeedBar'
import Mission from '../../components/Mission'
import Skill from '../../components/Skill'
import Inventory from '../../components/Inventory'
import Button from '../../components/Button'
import CircularMeasure from '../../components/CircularMeasure'
import NinjaBlock from '../NinjaBlock'
import api from '../../common/api'

import './style.css'

class Dashboard extends Component {
    state = {}
  

  displayNeedBlock = () => {
    const { needs = {}, currentAction } = this.state
    const {
      level,
      experience,
      experienceMax,
      ...needsProps
    } = needs

    const actionsNamingMap = {
      eat: 'manger',
      sleep: 'dormir',
      talk: 'bavarder'
    }

    return (

      <div className='need-block'>
        <div className='level'>
          <h5>{`Niv. ${level}`}</h5>
          <NeedBar percentage={(experience / experienceMax) * 100} color='40D1D8' />
        </div>

        <Needs needs={needsProps} />

        {
          <div className='actions'>
            {Object.entries(needsProps).map(([label, need]) => {
              const { action } = need

              return (
                <Button key={label}
                  disabled={!!currentAction}
                  title={actionsNamingMap[action]}
                  image={`./images/needs/${label}.png`}
                  callBack={() => {this.action(action)}
                  }
                />
              )
            })}
          </div>
        }
      </div>
    )
  }

  action = async actionLabel => {
    const { endDate, success } = await api.action(actionLabel)
    if (!success) {
      window.location.reload()
    }
    this.setState({
      startActionDate: Date.now(),
      currentAction: {
        label: 'action',
        endDate: new Date(endDate),
        title: actionLabel,
        name: actionLabel
      }
    })
  }

  displayMissionBlock = () => {
    const { missions = [], currentAction } = this.state
    return (
      <div className='mission-block'>
        {missions.map((item, i) =>
          <div className="mission" key={i}><Mission mission={item} currentAction={currentAction} /></div>
        )}
      </div>
    )
  }

  displaySkillsBlock = () => {
    const { skills = {}, currentAction } = this.state
    return <React.Fragment>
              <Skill skills={skills} currentAction={currentAction} />
           </React.Fragment>
  }

  displayInventoryBlock = () => {
    const { inventory = [] } = this.state
    return <div className="inventory"><Inventory objects={inventory} /></div>
  }

  displayActionBlock = () => {
    const { currentAction, startActionDate } = this.state

    if (!startActionDate) {
      return this.setState({ startActionDate: Date.now() })
    }

    if (currentAction) {
      const endTime = currentAction.endDate.getTime()
      const elapsedTime = Date.now() - startActionDate
      const totalTime = endTime - startActionDate
      const percent = (elapsedTime / totalTime) * 100

      return (
        <div className='actions'>
          Votre ninja est en train de {currentAction.title}<br />
          <CircularMeasure percent={percent} />
        </div>
      )
    }
    return (
      <div>
        Votre ninja s'ennuie !<br />
        Faites lui faire quelque chose.
      </div>
    )
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
      currentAction,
    } = await api.ninja()

    const currentActionUpdate = currentAction && {
      label: currentAction.label,
      endDate: new Date(currentAction.endDate),
      missionId: currentAction.id,
      title: currentAction.title,
      name: currentAction.name
    }

    this.setState({
      needs: {
        ...needs,
        experience,
        experienceMax,
        level,
      },
      missions,
      skills,
      inventory,
      currentAction: currentActionUpdate
    })
  }

  autoUpdate = () => {
    this.update()
      .then(() => setTimeout(this.autoUpdate, 2000))
      .catch(e => {
        window.location.reload()
      })
  }
  

  componentDidMount = async () => {
    this.autoUpdate()
  }

  render() {
    console.log(this.state)
    const {currentAction} = this.state 
     return (
      <React.Fragment>
        <Menu pseudo="ROBERT" />
        <div className='dashboard-app'>
          <DashboardBlock title="Action" content={this.displayActionBlock()} />
          <DashboardBlock title="Besoins" content={this.displayNeedBlock()} />
          <DashboardBlock title="Missions" content={this.displayMissionBlock()} />
          <DashboardBlock title="Compétences" content={this.displaySkillsBlock()} />
          <DashboardBlock title="Inventaire" content={this.displayInventoryBlock()} />
          {currentAction==null?<NinjaBlock currentAction = "default"/>:<NinjaBlock currentAction = {currentAction.name}/>}
        </div>
      </React.Fragment>
    )
  }
}

export default Dashboard
