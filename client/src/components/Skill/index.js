import React, { Component } from 'react'

import './style.css'
import Button from '../Button'
import RadarChart from '../RadarChart'

class Skill extends Component {
  constructor(props) {
    super(props)
  }

  throwShurikens(){
    console.log("throwShurikens")
  }

  readBooks(){
    console.log("readBooks")
  }

  dissimulation(){
    console.log("dissimulation")
  }

  bodybuilding(){
    console.log("bodybuilding")
  }

  juggling(){
    console.log("juggling")
  }


  render () {
    return (
      <div className='skill'>
        <RadarChart/>
         <div class="activityButtons">
           <Button title = "Lancer de shurikens" image = "./images/shuriken.png" callBack={this.throwShurikens}/>
           <Button title = "Lecture" image = "./images/reading.png" callBack={this.readBooks}/>
           <Button title = "Dissimulation" image = "./images/leaf.png" callBack={this.dissimulation}/>
           <Button title = "Musculation" image = "./images/bodybuilding.png" callBack={this.bodybuilding}/>
           <Button title = "Jonglage" image = "./images/juggling.png" callBack={this.juggling}/>
         </div>
      </div>
    )
  }
}

export default Skill
