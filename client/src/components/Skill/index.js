import React, { Component } from 'react'

import './style.css'
import Button from '../Button'
import RadarChart from '../RadarChart'

class Skill extends Component {
  throwShurikens = () => {
    console.log("throwShurikens")
  }

  readBooks = () => {
    console.log("readBooks")
  }

  dissimulation = () => {
    console.log("dissimulation")
  }

  bodybuilding = () => {
    console.log("bodybuilding")
  }

  juggling = () => {
    console.log("juggling")
  }

  render () {
    const { skills = {} } = this.props
    const {
      strength = 0,
      agility = 0,
      endurance = 0,
      smartness = 0,
      dissimulation = 0
    } = skills
    return (
      <div className='skill'>
        <RadarChart strength={strength} agility={agility} endurance={endurance} smartness={smartness} dissimulation={dissimulation}/>
         <div className="activityButtons">
           <Button title = "Lancer de shurikens" image = "./images/skills/shuriken.png" callBack={this.throwShurikens}/>
           <Button title = "Lecture" image = "./images/skills/reading.png" callBack={this.readBooks}/>
           <Button title = "Dissimulation" image = "./images/skills/leaf.png" callBack={this.dissimulation}/>
           <Button title = "Musculation" image = "./images/skills/bodybuilding.png" callBack={this.bodybuilding}/>
           <Button title = "Jonglage" image = "./images/skills/juggling.png" callBack={this.juggling}/>
         </div>
      </div>
    )
  }
}

export default Skill
