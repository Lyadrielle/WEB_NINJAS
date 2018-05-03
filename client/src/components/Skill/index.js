import React, { Component } from 'react'

import './style.css'
import Button from '../Button'
import RadarChart from '../RadarChart'

class Skill extends Component {
  constructor(props) {
    super(props)
    this.throwShurikens = this.throwShurikens.bind(this)
    this.state = {
      shurikens:false,
      dissimulation:false,
      reading:false,
      bodybuilding:false,
      juggling:false
    }
  }

  throwShurikens(){
    this.setState({shurikens: true})
    setTimeout(function(){
      if(this.state.shurikens === true){
        setTimeout(function(){this.setState({shurikens:false})}.bind(this), 3000)
    }}.bind(this), 400) // pour laisser le temps à setState de mettre à jour --> Asynchrone
  }


  render () {
    return (
      <div className='skill'>
         <Button title = "Lancé de shurikens" disabled = {this.state.shurikens} callBack={this.throwShurikens}/>
         <Button title = "Lecture" disabled = {this.state.reading} callBack={this.throwShurikens}/>
         <Button title = "Dissimulation" disabled = {this.state.dissimulation} callBack={this.throwShurikens}/>
         <Button title = "Musculation" disabled = {this.state.bodybuilding} callBack={this.throwShurikens}/>
         <Button title = "Jonglage" disabled = {this.state.juggling} callBack={this.throwShurikens}/>
      </div>
    )
  }
}

export default Skill
