import React, { Component } from 'react'

import './style.css'
class CupsMissionsLevel extends Component {
  displayCups = (level) => {
    let cups=[];
    for(let i = 0; i < level; i++) {
      cups[i] = <img key={i} className='trophy' src='./images/trophy.png' alt = 'trophy'/>
    }
    return cups;
  }
  render () {
    const { level } = this.props

    return (
      <div className='cups-container'>
        {this.displayCups(level)}
      </div>
    )
  }
}

export default CupsMissionsLevel