import React, { Component } from 'react'

import './style.css'
import Button from '../Button'
import RadarChart from '../RadarChart'

class Skill extends Component {
  constructor(props) {
    super(props)
    this.throwShurikens = this.throwShurikens.bind(this)
    this.state = {
      strength:false,
      dissimulation:false,
      wisdom:false,
      agility:false,
      stamina:false
    }
  }

  throwShurikens(){
    this.setState({strength: true})
    setTimeout(function(){
      if(this.state.strength === true){
        setTimeout(function(){this.setState({strength:false})}.bind(this), 3000)
    }}.bind(this), 400) // pour laisser le temps à setState de mettre à jour --> Asynchrone




  }
  render () {
    return (
      <div className='skill'>
         <Button title = "Lancé de shurikens" disabled = {this.state.strength} callBack={this.throwShurikens}/>
      </div>
    )
  }
}

export default Skill
