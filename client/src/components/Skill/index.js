import React, { Component } from 'react'

import './style.css'
import Button from '../Button'
import RadarChart from '../RadarChart'
import api from '../../common/api'

class Skill extends Component {
  throwShurikens = () => {
    this.skill("shuriken")
  }

  readBooks = () => {
    this.skill("reading")
  }

  dissimulation = () => {
    this.skill("hide")  
  }

  bodybuilding = () => {
    this.skill("musculation")  
  }

  juggling = () => {
    this.skill("juggle")  
  }

  skill = async skillLabel => {
    const { endDate, success } = await api.skill(skillLabel)
    if (!success) {
      window.location.reload()
    }
    this.setState({
      startActionDate: Date.now(),
      currentAction: {
        label: 'skill',
        endDate: new Date(endDate),
        title: skillLabel,
      }
    })
    this.props.setStartActionDate(this.state.startActionDate)

  }

  render () {
    const { skills = {}, currentAction } = this.props
    return (
      <div className='skill'>
        <RadarChart strength={skills.strength} 
                    agility={skills.agility} 
                    endurance={skills.endurance} 
                    smartness={skills.smartness} 
                    dissimulation={skills.dissimulation}/>
         <div className="activityButtons">
           <Button title = "Lancer de shurikens" image = "./images/skills/shuriken.png" callBack={this.throwShurikens} disabled={!!currentAction}/>
           <Button title = "Lecture" image = "./images/skills/reading.png" callBack={this.readBooks} disabled={!!currentAction}/>
           <Button title = "Dissimulation" image = "./images/skills/leaf.png" callBack={this.dissimulation} disabled={!!currentAction}/>
           <Button title = "Musculation" image = "./images/skills/bodybuilding.png" callBack={this.bodybuilding} disabled={!!currentAction}/>
           <Button title = "Jonglage" image = "./images/skills/juggling.png" callBack={this.juggling} disabled={!!currentAction}/>
         </div>
      </div>
    )
  }
}

export default Skill
