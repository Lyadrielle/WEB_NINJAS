import React, { Component } from 'react'
import './style.css'

class NinjaBlock extends Component {
  render () {
    const {currentAction} = this.props
    return (
      <div className='ninja-block'>
        <img className = 'ninja-img' alt ={`My ninja ${currentAction}`} src={`./images/ninja/${currentAction}.png`}/>
      </div>
    )
  }
}

export default NinjaBlock