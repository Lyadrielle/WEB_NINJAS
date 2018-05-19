import React, { Component } from 'react'
import './style.css'

class NinjaBlock extends Component {
  render () {
    const {currentActionImg} = this.props
    return (
      <div className='ninja-block'>
        <img className = 'ninja-img' alt ={`My ninja ${currentActionImg}`} src={`./images/ninja/${currentActionImg}.png`}/>
        <h3>NOM DU NINJA</h3>
      </div>
    )
  }
}

export default NinjaBlock