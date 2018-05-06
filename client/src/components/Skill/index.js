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
           <Button title = "Lancé de shurikens" callBack={this.throwShurikens}/>
           <Button title = "Lecture" callBack={this.readBooks}/>
           <Button title = "Dissimulation" callBack={this.dissimulation}/>
           <Button title = "Musculation" callBack={this.bodybuilding}/>
           <Button title = "Jonglage" callBack={this.juggling}/>
         </div>
      </div>
    )
  }
}

export default Skill
